<?php
# Uplist erx@qq.com https://app.zblogcn.com/?auth=3ec7ee20-80f2-498a-a5dd-fda19b198194
RegisterPlugin("Uplist","ActivePlugin_Uplist");
function ActivePlugin_Uplist() {
	Add_Filter_Plugin('Filter_Plugin_Admin_Header','Uplist_Plus');
}
function Uplist_Plus() {
	global $zbp;
	$action = GetVars('act', 'GET');
	if($action=='UploadMng'){
		echo '<link href="'. $zbp->host .'zb_users/plugin/Uplist/style.css?v=1.3.1" rel="stylesheet">' . "\r\n";
		echo '<script src="'. $zbp->host .'zb_users/plugin/Uplist/main.js?v=1.3.1"></script>' . "\r\n";
	}
}