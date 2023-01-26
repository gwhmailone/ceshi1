<?php
#注册插件
RegisterPlugin("encryptLogin","ActivePlugin_encryptLogin");

function ActivePlugin_encryptLogin() {
    Add_Filter_Plugin('Filter_Plugin_Login_Header','encryptLogin_Login_Header');
}
function InstallPlugin_encryptLogin() {
    global $zbp;
    if(!$zbp->HasConfig('encryptLogin')){
        $zbp->Config('encryptLogin')->isuse = 0;
        $zbp->Config('encryptLogin')->ask = 'wenti';
        $zbp->Config('encryptLogin')->answer = 'daan';
        $zbp->SaveConfig('encryptLogin');
    }
}
function UninstallPlugin_encryptLogin() {}
function encryptLogin_Login_Header(){
    global $zbp;
    $wen=$zbp->Config('encryptLogin')->ask;
    $da=$zbp->Config('encryptLogin')->answer;
    if(isset($_GET[''.$wen.''])){
        if($_GET[''.$wen.''] !== ''.$da.'') {
            Redirect($zbp->host);
            die();
          //如输入错误，返回首页，终止一切代码
        }
    }else{
        Redirect($zbp->host);
        die();
    }
}