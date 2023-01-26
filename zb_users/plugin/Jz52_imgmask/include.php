<?php
#注册插件
RegisterPlugin("Jz52_imgmask","ActivePlugin_Jz52_imgmask");

function ActivePlugin_Jz52_imgmask() {
	global $zbp;
	Add_Filter_Plugin('Filter_Plugin_Index_Begin','Jz52_imgmask_Main');
}

function Jz52_imgmask_Main(){  
	global $zbp;
	 if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE' && stripos($zbp->currenturl,'/Jz52_imgmask.html')===0) {
        Jz52_imgmask_page();
        die();
    }elseif (isset($_GET['Jz52_imgmask'])) {
        Jz52_imgmask_page();
        die();
    }
}
function Jz52_imgmask_page(){	
	global $zbp;
	$article = new Post;
	$article->Title=$zbp->Config('Jz52_imgmask')->title;
	$article->IsLock=true;
	$article->Type=ZC_POST_TYPE_PAGE;
	$article->Content .=Jz52_imgmask_pagec();
	$zbp->template->SetTags('title',$article->Title);
	$zbp->template->SetTags('article',$article);
	$zbp->template->SetTemplate($article->Template);
	$zbp->template->SetTags('comments',array());
	$zbp->template->Display(); 
}	
function Jz52_imgmask_pagec(){	
	global $zbp;
	$stra='<link href="'. $zbp->host.'zb_users/plugin/Jz52_imgmask/boxim/boxim.css" rel="stylesheet" type="text/css">';
	$stra.='<style>'.$zbp->Config('Jz52_imgmask')->css.'</style>';
	$stra.='<p>'.$zbp->Config('Jz52_imgmask')->readme.'</p>';
	$stra.='<div class="Jz52_imgmask">
  <h3 class="Jz52_imgmaskh3">选择隐写载体</h3>
  <img id="preview" class="preview hide" /> <a href="javascript:;" class="file">选择一张图片
  <input type="file" name="" id="file">
  </a>
  <h3 class="Jz52_imgmaskh3">隐藏文字</h3>
  <p id="aa"></p>
  <p id="bb"></p>
  <div class="Jz52_imgmask-textarea">
    <textarea id="message" rows="7" placeholder="此处输入要隐写的内容或显示读取后的内容" onchange="document.getElementById(\'bb\').innerHTML=\'已输入文字的长度: \'+ this.value.length"></textarea>
  </div>
  <div class="Jz52_imgmask-submit">
    <input type="submit" id="encode" value="隐藏文字">
    <input type="submit" id="decode" value="读取文字">
    <label>
      <input type="checkbox" id="debug" />
      调试模式</label>
  </div>
  <h3 class="Jz52_imgmaskh3">隐藏文件</h3>
  <a href="javascript:;" class="file" id="file2a">
  <input type="file" name="" id="file2">
  <span class="tip">选择任意文件</span> </a>
  <div class="Jz52_imgmask-submit">
    <input type="submit" id="encode2" value="隐藏文件">
    <input type="submit" id="decode2" value="读取文件">
  </div>
  <h3 class="Jz52_imgmaskh3">生成的文件</h3>
  <p id="files"></p>
  <canvas id="canvas" style="display:none;"></canvas>
  <img id="output" /> </div>
';
	$stra.='<script type="text/javascript" src="'. $zbp->host.'zb_users/plugin/Jz52_imgmask/boxim/imagemask.js"></script> ';
	$stra.='<script type="text/javascript" src="'. $zbp->host.'zb_users/plugin/Jz52_imgmask/boxim/boxim.js"></script> ';
	return $stra;
}

function InstallPlugin_Jz52_imgmask() {
	global $zbp;
		if(!$zbp->Config('Jz52_imgmask')->HasKey('Version')){
		$zbp->Config('Jz52_imgmask')->Version = '1.0';
		$zbp->Config('Jz52_imgmask')->title = '图片隐写术';
		$zbp->Config('Jz52_imgmask')->readme = '把文本或文件隐藏到一张图片中，很好玩的工具。';
		$zbp->Config('Jz52_imgmask')->css = '@charset "utf-8";/* CSS Document */';
		$zbp->Config('Jz52_imgmask')->clearSetting = '0';
		$zbp->SaveConfig('Jz52_imgmask');
		}
}
function UninstallPlugin_Jz52_imgmask() {
	global $zbp;
	if ( $zbp->Config('Jz52_imgmask')->clearSetting ) {
		$zbp->DelConfig('Jz52_imgmask');
	}
}