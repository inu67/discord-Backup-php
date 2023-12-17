<?php

$link = mysqli_connect("localhost", "cf619105_zyozai", "cf619105", "cf619105_database");

$TOKEN = '';


$ClientId = '1119408359582482542';
$ClientSecret='B2usYAtDuse42o1zPvmwgYIQwAamUjnD';

$RedirectURI = 'https://cf619105.cloudfree.jp/verify';
$Endpoint = 'https://discord.com/api/oauth2/authorize?client_id=1119408359582482542&permissions=8&response_type=code&redirect_uri=https%3A%2F%2Fcf619105.cloudfree.jp%2Fverify&scope=bot+identify+guilds.join';

$NICOKey = 'ilventodoro';


?>
