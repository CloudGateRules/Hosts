<?php

/*
 * License: MIT
 *    Time: 2017-01-20 11:12:05
 *    Name: Hosts.php
 *    Note: CloudGate Hosts Basic Rule
 *  Author: Eval,BurpSuite
 */

# 触发下载
header('Content-Disposition: attachment; filename='.'Hosts.Conf');

# ClouGate控制器
require_once "../Controller/Controller.php";

# Cloud配置信息
echo '#!MANAGED-CONFIG '.$Host.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' interval=86400'."\r\n";
echo "[General]\r\n";
echo "bypass-system = true\r\n";
echo "skip-proxy = {$SKIP}\r\n";
echo "bypass-tun = {$Bypass}\r\n";
echo "dns-server = 8.8.8.8, 8.8.4.4\r\n";
echo "loglevel = notify\r\n";
echo "replica = false\r\n";
echo "ipv6 = false\r\n";
echo "#  \r\n";
echo "# Hosts Config File [CloudGate]\r\n";
echo "# Download Time: " . date("Y-m-d H:i:s") . "\r\n";
echo "# \r\n";

# CloudGate模块
echo "[Rule]\r\n";
echo "# REJECT\r\n".Hosts_Replace(CURL(true,$RuleList['REJECT']).$CURLContent,true).$Hosts_REJECT;
echo "# KEYWORD\r\n".Hosts_Replace(CURL(true,$RuleList['KEYWORD']).$CURLContent,true).$Hosts_KEYWORD;
echo "# IP-CIDR\r\n".Hosts_Replace(CURL(true,$RuleList['IPCIDR']).$CURLContent,true).$Hosts_IPCIDR;
echo "# Other\r\n".Hosts_Replace(CURL(true,$RuleList['Other']).$CURLContent,true).$Hosts_Other;
echo "[Host]\r\n";
echo "# Hosts\r\n".Hosts_Replace(CURL(true,$RuleList['Hosts']).$CURLContent,true).$Hosts_Format_Replace;
echo "# YouTube\r\n".Hosts_Replace(CURL(true,$RuleList['YouTube']).$CURLContent,true,$HostsFix).$Hosts_YouTube;
echo "[URL Rewrite]\r\n";
echo "# Rewrite\r\n".Hosts_Replace(CURL(true,$RuleList['Rewrite']).$CURLContent,true).$Hosts_Rewrite;

?>