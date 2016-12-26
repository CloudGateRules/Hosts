<?php

# 触发下载
header('Content-Disposition: attachment; filename='.'Hosts.Conf');

# 设置开启哪些模块
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

# 检测GET接收参数
if(empty($Fix)){$Fix="false";}elseif($Fix=="true"){$Fix="true";}else{$Fix="false";}

# 判断GET参数
if($Fix=="true"){$HostsCURLF=$HostsFixCURLF;}elseif($Fix=="false"){$HostsCURLF = $HostsCURLF;}
if($HTTPSURL=="true"){$Host="https";}else{$Host="http";}

# 正则表达式替换Hosts格式
if($Fix=="true"){$Hosts = str_replace(" = "," = $HostsFixIP",$HostsCURLF);}
elseif($Fix=="false"){$Hosts = $Hosts_Format_Replace;}

# 正则表达式替换规则格式
if($Fix=="true"){$YouTube = str_replace(".com",".com = $HostsFixIP",$YouTubeCURLF."\r\n");}
elseif($Fix=="false"){$YouTube = str_replace(".com",".com = $YouTubeIP",$YouTubeCURLF."\r\n");}
$KEYWORD  = preg_replace('/(Proxy)/','DIRECT',$Surge_KEYWORD);
$IPCIDR   = preg_replace('/(Proxy)/','DIRECT',$Surge_IPCIDR);
$Other    = preg_replace('/(Proxy)/','DIRECT',$Surge_Other);

# Hosts[General]规则模板
echo "#!MANAGED-CONFIG $Host://".$_SERVER['SERVER_NAME']."/Rule/General/Hosts.php?Fix=$Fix interval=86400\r\n";
echo "[General]\r\n";
echo "bypass-system = true\r\n";
echo "skip-proxy = 10.0.0.0/8, 17.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16, localhost, *.local, *.crashlytics.com\r\n";
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
echo "# REJECT\r\n".$Surge_REJECT;
echo "# KEYWORD\r\n".$KEYWORD;
echo "# IP-CIDR\r\n".$IPCIDR;
echo "# Other\r\n".$Other;
echo "[Host]\r\n";
echo "# Hosts\r\n".$Hosts;
echo "# YouTube\r\n".$YouTube;
echo "[URL Rewrite]\r\n";
echo "# Rewrite\r\n".$Surge_Rewrite;