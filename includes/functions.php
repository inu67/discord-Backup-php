<?php 
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

include './config.php';


function get($key, $default = NULL) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}

function session($key, $default = NULL)
{
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}


function apiRequest($url, $post = FALSE, $headers=array()) {
  
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  
    $response = curl_exec($ch);
  
  
    if($post)
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  
    $headers[] = 'Accept: application/json';
 
    if(session('access_token'))
      $headers[] = 'Authorization: Bearer ' . session('access_token'); 

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  
    $response = curl_exec($ch);
    return json_decode($response);
}



function give_role($guildid, $roleid)
{
    $data = json_encode(array("roles" => array("$roleid")));
    $url = $GLOBALS['base_url'] . "/api/guilds/$guildid/members/" . $user->id . "/roles/$roleid";
    $headers = array('Content-Type: application/json', 'Authorization: Bot ' . $GLOBALS['bot_token']);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);
    $results = json_decode($response, true);
    return $results;
}


function join_guild($access_token,$guildid)
{
    $data = json_encode(array("access_token" => $access_token));
    $url = "https://discord.com/api/v10/guilds/$guildid/members/" . $_SESSION['user_id'];
    $headers = array('Content-Type: application/json', 'Authorization: Bot ' . $GLOBALS['bot_token']);
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($curl);
    curl_close($curl);
    $results = json_decode($response, true);
    return $results;
}

?>