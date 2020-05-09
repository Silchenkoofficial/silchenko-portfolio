<?php include "config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Авторизация через ВКонтакте</title>

   <link rel="stylesheet" href="style.css">

</head>
<body>
   <a class="oauth-btn" href="javascript://">Авторизоваться</a>

   <script>
      function getCookie(name) {
         var matches = document.cookie.match(new RegExp('(?:^|\s)' + name + '=(.*?)(?:;|$)'));
         return matches[1];
      }

      if (getCookie('logged_in') == 'yes') {
         location.href = 'https://oauth.vk.com/authorize?client_id=<?=ID?>&display=popup&redirect_uri=<?=URL?>&scope=friends&response_type=code&v=5.52';
      }

      if (document.querySelector('.oauth-btn')) {
         document.addEventListener('click', function (e) {
            if (e.target.className == 'oauth-btn') {
               document.cookie = "logged_in=yes";
               location.href = 'https://oauth.vk.com/authorize?client_id=<?=ID?>&display=popup&redirect_uri=<?=URL?>&scope=friends&response_type=code&v=5.52';
            }
         });
      }
   </script>
</body>
</html>
