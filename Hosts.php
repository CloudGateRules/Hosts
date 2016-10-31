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
$A = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\-\w+\-\w+\.\w+\.\w+)/','$3 = $1',$HOSTSC);//第1次替换
$B = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\-\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$A);//第2次替换
$C = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\-\w+\.\w+\.\w+)/','$3 = $1',$B);//第3次替换
$D = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$C);//第4次替换
$E = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\.\w+\.\w+\.\w+)/','$3 = $1',$D);//第5次替换
$F = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\.\w+\.\w+)/','$3 = $1',$E);//第6次替换
$G = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\.\w+\.\w+\.\w+)/','$3 = $1',$F);//第7次替换
$H = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\.\w+\.\w+)/','$3 = $1',$G);//第8次替换
$I = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\.\w+)/','$3 = $1',$H);//第9次替换
$J = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\--\w+\--\w+\--\w+\.\w+\.\w+\.\w+)/','$3 = $1',$I);//第10次替换
$K = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\--\w+\--\w+\.\w+\.\w+\.\w+)/','$3 = $1',$J);//第11次替换
$L = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\-\w+\-\w+\-\w+\.\w+\.\w+\.\w+)/','$3 = $1',$K);//第12次替换
$M = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$L);//第13次替换
$N = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$M);//第14次替换
$O = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\-\w+\.\w+\.\w+)/','$3 = $1',$N);//第15次替换
$P = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\-\w+\.\w+)/','$3 = $1',$O);//第16次替换
$Q = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+\.\w+)/','$3 = $1',$P);//第17次替换
$R = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+)/','$3 = $1',$Q);//第18次替换
$S = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+)/','$3 = $1',$R);//第19次替换
$T = preg_replace('/127.0.0.1/','# 127.0.0.1',$S);//第20次替换
$HOSTS = preg_replace('/::1/','# ::1',$T);//第21次替换

$HOSTSF = fopen("../../Static/Hosts/Hosts.txt", "w+");
echo fwrite($HOSTSF, $HOSTS);    //HOSTS
fclose($HOSTSF);
?>