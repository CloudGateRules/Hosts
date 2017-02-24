<?php

/*
 * License: MIT
 *    Time: 2017-02-12 00:20:32
 *    Name: Hosts.php
 *    Note: CloudGate Hosts Basic Rule
 *  Author: Eval,BurpSuite
 */

# 触发下载
header('Content-Disposition: attachment; filename='.'Hosts.Conf');

# ClouGate控制器
require_once "../../Controller/Controller.php";

# Cloud配置信息
echo '#!MANAGED-CONFIG '.$Host.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].' interval=86400'."\r\n";
echo "[General]\r\n";
echo CURL($RuleList['General']).$CURLContent."\r\n";
echo "dns-server = 8.8.8.8, 8.8.4.4\r\n";
echo "#  \r\n";
echo "# Hosts Config File [CloudGate]\r\n";
echo "# Download Time: " . date("Y-m-d H:i:s") . "\r\n";
echo "# \r\n";

# CloudGate模块
echo "[Rule]\r\n";
echo Hosts_Replace(CURL($RuleList['REJECT']).$CURLContent).$Hosts_REJECT;
echo Hosts_Replace(CURL($RuleList['KEYWORD']).$CURLContent).$Hosts_KEYWORD;
echo Hosts_Replace(CURL($RuleList['IPCIDR']).$CURLContent).$Hosts_IPCIDR;
echo Hosts_Replace(CURL($RuleList['Other']).$CURLContent).$Hosts_Other;
echo "[Host]\r\n";
echo Hosts_Replace(CURL($RuleList['Hosts']).$CURLContent).$Hosts_Format_Replace;
echo Hosts_Replace(CURL($RuleList['Host']).$CURLContent).$Hosts_Host;
echo Hosts_Replace(CURL($RuleList['YouTube']).$CURLContent,$HostsFix).$Hosts_YouTube;
echo "[URL Rewrite]\r\n";
echo Hosts_Replace(CURL($RuleList['Rewrite']).$CURLContent).$Hosts_Rewrite;

?>