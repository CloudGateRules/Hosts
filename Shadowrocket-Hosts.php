<?php

header("cache-control:no-cache,must-revalidate");
header("Content-Type:text/html;charset=UTF-8");

//ini_set("display_errors", "On");//PHP调试参数
//error_reporting(E_ALL | E_STRICT);//PHP调试参数

$HOSTSURL = "https://coding.net/u/scaffrey/p/hosts/git/raw/master/hosts";//HOSTS网址
$CURLRUN = curl_init();
curl_setopt($CURLRUN,CURLOPT_RETURNTRANSFER,true);
curl_setopt($CURLRUN,CURLOPT_URL,"$HOSTSURL");
$HOSTSC = curl_exec($CURLRUN);
curl_close($CURLRUN);

$A = preg_replace('/127.0.0.1/','# 127.0.0.1',$HOSTSC);//第20次替换
$B = preg_replace('/::1/','# ::1',$A);//第21次替换
$HOSTS = preg_replace('/([ \t]+)/',' = ',$B);//第22次替换

$HOSTSF = fopen("../../Static/Hosts/Shadowrocket-Hosts.txt", "w+");
echo fwrite($HOSTSF, $HOSTS);    //HOSTS
fclose($HOSTSF);
?>