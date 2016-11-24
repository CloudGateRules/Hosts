<?php

# 关闭所有 Notice | Warning 级别的错误
error_reporting(E_ALL^E_NOTICE^E_WARNING);

# 页面禁止缓存 | UTF-8编码 | 触发下载
header("cache-control:no-cache,must-revalidate");
header("Content-Type:text/html;charset=UTF-8");
header('Content-Disposition: attachment; filename='.'Hosts.Conf');

# 检测GET接收参数
if(empty($Fix)){$Fix="false";}elseif($Fix=="true"){$Fix="true";}else{$Fix="false";}

# 判断GET参数
if($Fix=="true"){$HostsCURLF=$HostsFixCURLF;}elseif($Fix=="false"){$HostsCURLF = $HostsCURLF;}

# 设置开启哪些模块 | 必须放置在最前面
$DefaultModule  = "true";
$REJECTModule   = "true";
$KEYWORDModule  = "true";
$IPCIDRModule   = "true";
$OtherModule    = "true";
$RewriteModule  = "true";
$YouTubeModule  = "true";
$HostsFixModule = "true";
$HostsModule    = "true";

# 引用Controller控制器模块
require '../Controller/Controller.php';

# 正则表达式替换Hosts格式
if($Fix=="true"){$Hosts = str_replace(" = "," = $HostsFixIP",$HostsCURLF);}
elseif($Fix=="false"){
$A     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\-\w+\-\w+\.\w+\.\w+)/','$3 = $1',$HostsCURLF);
$B     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\-\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$A);
$C     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\-\w+\.\w+\.\w+)/','$3 = $1',$B);
$D     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$C);
$E     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\.\w+\.\w+\.\w+)/','$3 = $1',$D);
$F     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\-\w+\.\w+\.\w+)/','$3 = $1',$E);
$G     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\.\w+\.\w+\.\w+)/','$3 = $1',$F);
$H     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\.\w+\.\w+)/','$3 = $1',$G);
$I     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\-\w+\.\w+)/','$3 = $1',$H);
$J     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\--\w+\--\w+\--\w+\.\w+\.\w+\.\w+)/','$3 = $1',$I);
$K     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\--\w+\--\w+\.\w+\.\w+\.\w+)/','$3 = $1',$J);
$L     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\-\w+\-\w+\-\w+\.\w+\.\w+\.\w+)/','$3 = $1',$K);
$M     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$L);
$N     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+\.\w+\.\w+)/','$3 = $1',$M);
$O     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\-\w+\.\w+\.\w+)/','$3 = $1',$N);
$P     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\-\w+\.\w+)/','$3 = $1',$O);
$Q     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+\.\w+)/','$3 = $1',$P);
$R     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+\.\w+)/','$3 = $1',$Q);
$S     = preg_replace('/(\d+\.\d+\.\d+\.\d+)([ \t]+)(\w+\.\w+)/','$3 = $1',$R);
$T     = preg_replace('/127.0.0.1/','# 127.0.0.1',$S);
$Hosts = preg_replace('/::1/','# ::1',$T);}

# 正则表达式替换规则格式
if($Fix=="true"){$YouTube = str_replace(".com",".com = $HostsFixIP",$YouTubeCURLF."\r\n");}
elseif($Fix=="false"){$YouTube = str_replace(".com",".com = $YouTubeIP",$YouTubeCURLF."\r\n");}
$Default  = preg_replace('/([^])([ \s]+)/','$1,DIRECT$2',$DefaultCURLF."\r\n");
$REJECT   = preg_replace('/([^])([ \s]+)/','$1,REJECT$2',$REJECTCURLF."\r\n");
$KEYWORDF = preg_replace('/([^])([ \s]+)/','DOMAIN-KEYWORD,$1$2,force-remote-dns',$KEYWORDCURLF."\r\n");
$KEYWORD  = preg_replace('/Proxy/','DIRECT',$KEYWORDF."\r\n");
$IPCIDRF  = preg_replace('/([^])([ \s]+)/','IP-CIDR,$1$2,no-resolve',$IPCIDRCURLF."\r\n");
$IPCIDR   = preg_replace('/Proxy/','DIRECT',$IPCIDRF."\r\n");
$Rewrite  = preg_replace('/([^])([ \s]+)/','$1$2',$RewriteCURLF."\r\n");
$OtherF   = preg_replace('/([^])([ \s]+)/','$1$2',$OtherCURLF."\r\n");
$Other    = preg_replace('/Proxy/','DIRECT',$OtherF."\r\n");

# Hosts[General]规则模板
echo "#!MANAGED-CONFIG http://".$_SERVER['SERVER_NAME']."/Rule/General/Hosts.php?Fix=$Fix interval=86400\r\n";
echo "[General]\r\n";
echo "bypass-system = true\r\n";
echo "skip-proxy = 10.0.0.0/8, 17.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16, localhost, *.local, ::ffff:0:0:0:0/1, ::ffff:128:0:0:0/1, *.crashlytics.com\r\n";
echo "bypass-tun = 10.0.0.0/8, 127.0.0.0/24, 172.0.0.0/8, 192.168.0.0/16\r\n";
echo "dns-server = 8.8.8.8, 8.8.4.4\r\n";
echo "loglevel = notify\r\n";
echo "replica = false\r\n";
echo "ipv6 = false\r\n";
echo "#  \r\n";
echo "# Hosts Config File [CloudGate]\r\n";
echo "# Download Time: " . date("Y-m-d H:i:s") . "\r\n";
echo "# \r\n";

# 最后模块内容输出
echo "[Rule]\r\n";
echo "# Default\r\n".$Default;
echo "# REJECT\r\n".$REJECT;
echo "# KEYWORD\r\n".$KEYWORD;
echo "# IP-CIDR\r\n".$IPCIDR;
echo "# Other\r\n".$Other;
echo "[Host]\r\n";
echo "# Hosts\r\n".$Hosts;
echo "# YouTube\r\n".$YouTube;
echo "[URL Rewrite]\r\n";
echo "# Rewrite\r\n".$Rewrite;
