<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '../database/error.txt');

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

include '../includes/functions.php';
include '../includes/config.php';

function get_avatar($user)
{
	
	$userid = $user->id;
	$avatar = $user->avatar;
	if($avatar=='None') return "https://cdn.discordapp.com/embed/avatars/0.png";
	$url = "https://cdn.discordapp.com/avatars/".$userid."/".$avatar;
	$ext = substr($avatar, 0, 2);
	if ($ext == "a_")
	{
		return $url.".gif";
	}
	else
	{
		return $url.".png";
	}
	//
}




$status = ''; 


if(get('code')){
	$token = apiRequest("https://discord.com/api/oauth2/token", array(
		"grant_type" => "authorization_code",
		'client_id' => $ClientId,
		'client_secret' => $ClientSecret,
		'redirect_uri' => $RedirectURI,
		'code' => get('code')
	));
	if(isset($token->access_token)&&isset($token->refresh_token))
	{
		$_SESSION['access_token'] = $token->access_token;
		$_SESSION['refresh_token'] = $token->refresh_token;
		$user  = apiRequest("https://discord.com/api/v10/users/@me");
		mysqli_query($link, "REPLACE INTO `members` (`id`,`access_token`, `refresh_token`,`ip`) VALUES ('" . $user->id . "', '" . $_SESSION['access_token'] . "', '" . $_SESSION['refresh_token'] . "','" . $_SERVER['REMOTE_ADDR']."')");
		$status = 'authed';
	}else{
		$status = 'noauthed';
	}			
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="！？">
    <title>NICO-Verify</title>
	<link rel="stylesheet" href="./verify.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
  	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>
	<div class="container">
		<?php 
		switch ($status) {
			case 'authed':
				$url = get_avatar(session('user'));
				echo "<h1 class='isauthed' id='$status'>認証が完了しました</h1><img src='$url'>";
				break;
			case 'noauthed':
				echo "<h1 class='isauthed' id='$status'>認証をやり直してください</h1><img src='./assets/hsgw.gif'>";
				break;
			case '':
				echo "<h1 class='isauthed' id='$status'>認証をやり直してください</h1><img src='./assets/krsw.png'>";
				break;
			}
		?>
    	<div class="notifications"></div>
      		<button id="support" class="spt">Support Server</button>
	</div>
	<script src='./verify.js'></script>
</body>
</html>
