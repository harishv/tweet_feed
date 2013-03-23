<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <script type="text/javascript"src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
           <!--<script type="text/javascript" src="https://api.twitter.com/1/statuses/user_timeline/HarishVarada.json?callback=twitterCallback2&count=1"></script>-->
        <script>
            $('document').ready(function() {
    
   load_tweet();
   $('#refresh').click(function(){
load_tweet();
   });


});

  function load_tweet(){
     data={"user_name":'HarishVarada'};
    url="http://localhost/twitter_db/tweet_insert.php"
    $.ajax({

          url: url,
          type: "POST",
          data: data,     
          success: function(result) {
            $('#tweets').html(result);
          }
      });
  }
      
        </script>
    </head>
    <body>
      <input type="button" id="refresh" name="refresh" value="refresh"/>
        <ul id="tweets"></ul>
    </body>
    </html>