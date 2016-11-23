<?php

# 页面禁止缓存 | UTF-8编码 | 触发下载
header("cache-control:no-cache,must-revalidate");
header("Content-Type:text/html;charset=UTF-8");
header('Content-Disposition: attachment; filename='.'Surge.Conf');

# 默认模块API托管在Github[GithubUserContent] | 模块数组 | 请求模块禁止缓存
$ModuleAPI    = "https://raw.githubusercontent.com/BurpSuite/CloudGate-RuleList/master/Rule/";
$HostsAPI     = "https://raw.githubusercontent.com/racaljk/hosts/master/hosts";
$ModuleArray  = array("Advanced","Basic","DIRECT","Default","HostsFix","IPCIDR","KEYWORD","REJECT","Rewrite","YouTube","Other","USERAGENT");
$Cache        = '?Cache='.sha1(mt_rand()).'&TimeStamp='.time();

# 设定参数默认值
$Module       = "https://raw.githubusercontent.com/BurpSuite/CloudGate-RuleList/master/Module/Module";
$HostsFixIP   = "202.171.253.103";
$YouTubeIP    = "219.76.4.3";

# 接收GET请求参数
$Fix = $_GET['Fix'];

# 检测GET接收参数
if(empty($Fix)){$Fix="false";}elseif($Fix=="true"){$Fix="true";}else{$Fix="false";}

# 参数组合一起就是完整的模块地址
$AdvancedFile  = $ModuleAPI.$ModuleArray[0].$Cache;
$BasicFile     = $ModuleAPI.$ModuleArray[1].$Cache;
$DIRECTFile    = $ModuleAPI.$ModuleArray[2].$Cache;
$DefaultFile   = $ModuleAPI.$ModuleArray[3].$Cache;
$HostsFixFile  = $ModuleAPI.$ModuleArray[4].$Cache;
$IPCIDRFile    = $ModuleAPI.$ModuleArray[5].$Cache;
$KEYWORDFile   = $ModuleAPI.$ModuleArray[6].$Cache;
$REJECTFile    = $ModuleAPI.$ModuleArray[7].$Cache;
$RewriteFile   = $ModuleAPI.$ModuleArray[8].$Cache;
$YouTubeFile   = $ModuleAPI.$ModuleArray[9].$Cache;
$OtherFile     = $ModuleAPI.$ModuleArray[10].$Cache;
$USERAGENTFile = $ModuleAPI.$ModuleArray[11].$Cache;

# 现在暂时还是单线程,后续可能会改成循环请求或多线程请求
$HostsModuleCURL    = curl_init();
if($Fix=="true"){curl_setopt($HostsModuleCURL,CURLOPT_URL,"$HostsFixFile");}
elseif($Fix=="false"){curl_setopt($HostsModuleCURL,CURLOPT_URL,"$HostsAPI");}
curl_setopt($HostsModuleCURL,CURLOPT_RETURNTRANSFER,true);
$HostsCURLF         = curl_exec($HostsModuleCURL);
curl_close($HostsModuleCURL);
$YouTubeModuleCURL  = curl_init();
curl_setopt($YouTubeModuleCURL,CURLOPT_URL,"$YouTubeFile");
curl_setopt($YouTubeModuleCURL,CURLOPT_RETURNTRANSFER,true);
$YouTubeCURLF       = curl_exec($YouTubeModuleCURL);
curl_close($YouTubeModuleCURL);
$DefaultModuleCURL  = curl_init();
curl_setopt($DefaultModuleCURL,CURLOPT_URL,"$DefaultFile");
curl_setopt($DefaultModuleCURL,CURLOPT_RETURNTRANSFER,true);
$DefaultCURLF       = curl_exec($DefaultModuleCURL);
curl_close($DefaultModuleCURL);
$REJECTModuleCURL   = curl_init();
curl_setopt($REJECTModuleCURL,CURLOPT_URL,"$REJECTFile");
curl_setopt($REJECTModuleCURL,CURLOPT_RETURNTRANSFER,true);
$REJECTCURLF        = curl_exec($REJECTModuleCURL);
curl_close($REJECTModuleCURL);
$KEYWORDModuleCURL  = curl_init();
curl_setopt($KEYWORDModuleCURL,CURLOPT_URL,"$KEYWORDFile");
curl_setopt($KEYWORDModuleCURL,CURLOPT_RETURNTRANSFER,true);
$KEYWORDCURLF       = curl_exec($KEYWORDModuleCURL);
curl_close($KEYWORDModuleCURL);
$IPCIDRModuleCURL   = curl_init();
curl_setopt($IPCIDRModuleCURL,CURLOPT_URL,"$IPCIDRFile");
curl_setopt($IPCIDRModuleCURL,CURLOPT_RETURNTRANSFER,true);
$IPCIDRCURLF        = curl_exec($IPCIDRModuleCURL);
curl_close($IPCIDRModuleCURL);
$RewriteModuleCURL  = curl_init();
curl_setopt($RewriteModuleCURL,CURLOPT_URL,"$RewriteFile");
curl_setopt($RewriteModuleCURL,CURLOPT_RETURNTRANSFER,true);
$RewriteCURLF       = curl_exec($RewriteModuleCURL);
curl_close($RewriteModuleCURL);
$OtherModuleCURL    = curl_init();
curl_setopt($OtherModuleCURL,CURLOPT_URL,"$OtherFile");
curl_setopt($OtherModuleCURL,CURLOPT_RETURNTRANSFER,true);
$OtherCURLF         = curl_exec($OtherModuleCURL);
curl_close($OtherModuleCURL);

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
if($Fix=="true"){$YouTube = str_replace(".com",".com = $HostsFixIP",$YouTubeCURLF);}
elseif($Fix=="false"){$YouTube = str_replace(".com",".com = $YouTubeIP",$YouTubeCURLF);}
$Default  = preg_replace('/([^])([ \s]+)/','$1,DIRECT$2',$DefaultCURLF."\r\n");
$REJECT   = preg_replace('/([^])([ \s]+)/','$1,REJECT$2',$REJECTCURLF."\r\n");
$KEYWORDF = preg_replace('/([^])([ \s]+)/','DOMAIN-KEYWORD,$1$2,force-remote-dns',$KEYWORDCURLF."\r\n");
$KEYWORD  = preg_replace('/Proxy/','DIRECT',$KEYWORDF."\r\n");
$IPCIDRF  = preg_replace('/([^])([ \s]+)/','IP-CIDR,$1$2,no-resolve',$IPCIDRCURLF."\r\n");
$IPCIDR   = preg_replace('/Proxy/','DIRECT',$IPCIDRF."\r\n");
$Rewrite  = preg_replace('/([^])([ \s]+)/','$1$2',$RewriteCURLF."\r\n");
$OtherF   = preg_replace('/([^])([ \s]+)/','$1$2',$OtherCURLF."\r\n");
$Other    = preg_replace('/Proxy/','DIRECT',$OtherF."\r\n");

# Surge[General]规则模板
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