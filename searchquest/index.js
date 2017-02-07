function vidFunc(e,t){
    res=e;
    for(var n=0;n<t.length;n++){
        res=res.replace(/\{\{(.*?)\}\}/g,function(e,r){
            return t[n][r]})}return res
}

$(document).ready(function () {
    $('#getposts_form').submit(function(event) {
        event.preventDefault();

        $('#errors').empty();
        $('#output').empty();
        $('#results').empty();
        
        var search = $('#search').val();
        var errorMessages = '';
        var emptyStringPattern = /^$/;

        if (emptyStringPattern.test(search)) {
            errorMessages += 'You must enter a search term.';
        }

        if (errorMessages.length > 0) {
           $('#errors').append(errorMessages); 
           return false;
        }

        $("#ajaxIndicator").modal('show');

        //TWITTER API
        $.ajax({
            url: '/api/index.php/TwitterAppOnly/search/tweets.json',
            type: 'GET',
            dataType: 'JSON',
            data: {
                q: search,
                count: 35
            },
            
            success: function(serverResponse) {
                console.log(serverResponse);
                var tweet;
                var userID;
                var outputHTML = '';
                
                for(var count = 0; count < serverResponse.statuses.length; count++){
                    console.log(count);
                    tweet = serverResponse.statuses[count].text;
                    userID = serverResponse.statuses[count].user.screen_name;
                    console.log(userID);
                    outputHTML +='<li class="tweet list-group-item">' +
                            '<span class="user">' + userID +'</span>' +
                            '- <span class="body">'+ tweet +'</span>' +
                        '</li>';
                }
                
                $('#output').append(outputHTML);
                
                //YOUTUBE API
                $.ajax({
                url: 'https://www.googleapis.com/youtube/v3/search',
                type: 'GET',
                datatype: 'JSON',
                data: {
                    part: 'snippet',
                    key: 'AIzaSyCMCCgliIH6psk5dZ2rri1Ci5U7ZtMeO5k',
                    type: 'video',
                    q: search
                },
                
                success: function(serverResponse){
                    //console.log(serverResponse);  //TEST
                    var search = $('#search').val();
                    var result = serverResponse.items;
                    $.each(result, function(index, item){
                        //console.log(item);
                        $.get('video.html', function(data){
                            $("#results").append(vidFunc(data, [{"title":item.snippet.title, "videoid":item.id.videoId}]));
                        });
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#errors').append('Error ' + errorThrown);
                },
                complete: function() {
                    // remove the "let user know something is happening" thing, since the request is done
                    // (hide spinning circle modal)
                    //$("#ajaxIndicator").modal('hide');
                }
            });
            },
            
            error: function(jqXHR, textStatus, errorThrown) {
               $('#errors').append('Error: ' + errorThrown);
            },
            
            complete: function() {
                // remove the "let user know something is happening" thing, since the request is done
                // (hide spinning circle modal)
                $("#ajaxIndicator").modal('hide');
            }
        });
    });
});
