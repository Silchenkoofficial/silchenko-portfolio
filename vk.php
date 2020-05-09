<?php
      if (!$_GET['code']) {
         exit('Error code!');
      }
      include "config.php";
      $token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code'].'&v=5.52'), true);
      if(!$token) {
         $token = json_decode(file_get_contents('https://oauth.vk.com/authorize?client_id='.ID.'&redirect_uri='.URL.'&client_secret='.SECRET.'&code='.$_GET['code'].'&v=5.52'), true);
      }
      $data = json_decode(file_get_contents('https://api.vk.com/method/users.get?user_id='.$token['user_id'].'&access_token='.$token['access_token'].'&fields=uid,first_name,last_name,photo_big,bdate&v=5.52'), true);
      $friends = json_decode(file_get_contents('https://api.vk.com/method/friends.get?access_token='.$token['access_token'].'&order=random&count=5&fields=photo_200_orig&v=5.52'), true);
      if(!$data) {
         exit('Error data');
      }
      if (!$friends) {
         exit('Error friends');
      }
      $data = $data['response'][0];
      $friends = $friends['response']['items'];
   ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Добро пожаловать!</title>

   <link rel="stylesheet" href="vk.css">
</head>
<body>

   <main>
      <div class="container">
         <div class="vk__main main">
            <div class="vk--block">
               <img src="<?php echo $data['photo_big']; ?>" alt="Аватарка" class="main__avatar">
            </div>
            <div class="main__title vk--block">
               <div class="main__fio">
                  <h1><?php echo $data['first_name']; ?> <?php echo $data['last_name']; ?></h1>
                  <a href="index.php" class="vk-exit" onclick="document.cookie = 'logged_in=no'">Выйти</a>
               </div>
            </div>
         </div>
         <div class="vk__friends vk--block">
            <h2>Друзья <span><?php echo count($friends); ?></span></h2>
            <div class="vk__user user">
               <?php for ($i=0; $i < count($friends); $i++) { ?>
                  <a href="https://vk.com/id<?php echo $friends[$i]['id']; ?>" target="_blank" class="user__link">
                     <img src="<?php echo $friends[$i]['photo_200_orig']; ?>" alt="Друг">
                     <div class="user__name"><?php echo $friends[$i]['first_name']; ?> <?php echo $friends[$i]['last_name']; ?></div>
                  </a>
               <?php } ?>
            </div>
         </div>
      </div>
   </main>

</body>
</html>