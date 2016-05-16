<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '233033577036564'; //Facebook App ID
$appSecret = 'a5349e0cce38cfcf21ccf152913bb367'; // Facebook App Secret
$homeurl = 'http://trumsi.vn/facebookphp/';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>