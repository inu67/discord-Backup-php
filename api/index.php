<?php
include '../includes/config.php';


if($_SERVER['REQUEST_METHOD'] === 'POST'&&strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false){
    $ACK = 'X-accessKey-NICO';
    if(isset(getallheaders()[$ACK])&&getallheaders()[$ACK]==$NICOkey){
        header('Content-Type: application/json');
        switch(getallheaders()['active']){
            case 'joinserver':
            case 'GetPoint':
            case 'GetMembersInfo':
            case 'GetMembersCount':
            case 'CreateServer':
                $res = json_encode(['status' => '準備中']);
                echo $res;
                break;
            default:
                die('nao');
        }
    }else{
        die('faild header');
    }
}else{
    die('fuck you');
}


?>