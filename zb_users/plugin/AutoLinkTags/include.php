<?php
RegisterPlugin("AutoLinkTags","ActivePlugin_AutoLinkTags");

function ActivePlugin_AutoLinkTags(){
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','AutoLinkTags_TagsLink');
}

function AutoLinkTags_SubMenu($id){
	$arySubMenu = array(
		0 => array('基本设置', 'base', 'left', false),
		1 => array('说明', 'help', 'left', false)
	);
	foreach($arySubMenu as $k => $v){
		echo '<li><a href="?act='.$v[1].'" '.($v[3]==true?'target="_blank"':'').' class="'.($id==$v[1]?'on':'').'">'.$v[0].'</a></li>';
	}
}

function AutoLinkTags_TagsLink(&$tag){
	global $zbp;
	if($zbp->Config('AutoLinkTags')->PLUGINON){
		$article=$tag->GetTags('article');
		$content=$article->Content;
		$array=$zbp->GetTagList(null, null, array('LENGTH(tag_Name)' => 'DESC'), null, null);
		foreach($array as $tags){
			$pattern = array('(',')','|','[','<','^','\\');
			$check = false;
			foreach($pattern as $error){
				if(strpos($tags->Name, $error)){
					$check = true;
					break;
				}
			}
			if($check == true){
				continue;
			}
			if($zbp->Config('AutoLinkTags')->CLASSON){
				$class = 'class="'.$zbp->Config('AutoLinkTags')->CLASS.'"';
			}else{
				$class = '';
			}
			if($zbp->Config('AutoLinkTags')->COLORON){
				$color = 'style="color:#'.$zbp->Config('AutoLinkTags')->COLOR.'"';
			}else{
				$color = '';
			}
			$content=preg_replace('/(?!((<.*?)|(<a.*?)))('.$tags->Name.')(?!(([^<>]*?)>)|([^>]*?<\/a>))/i','<a target="_blank" href="'.$tags->Url.'"'.$class.$color.'>'.$tags->Name.'</a>',$content,$zbp->Config('AutoLinkTags')->TAGSNUM);
		}
		$article->Content = $content;
		$tag->SetTags('article',$article);
	}
}

function InstallPlugin_AutoLinkTags(){
	global $zbp;
	if(!$zbp->Config('AutoLinkTags')->HasKey('Version')){
		$array = array(
			'Version' => '1.1',
			'PLUGINON' => '1',
			'TAGSNUM' => '1',
			'CLASSON' => '0',
			'CLASS' => 'tagslink',
			'COLORON' => '0',
			'COLOR' => '004C98',
			'SAVECONFIG' => '1'
		);
		foreach($array as $key => $val){
		   $zbp->Config('AutoLinkTags')->$key = $val;
		}
	}
	$zbp->Config('AutoLinkTags')->Version = '1.1';
	$zbp->SaveConfig('AutoLinkTags');
}

function UninstallPlugin_AutoLinkTags(){
	global $zbp;
	if($zbp->Config('AutoLinkTags')->SAVECONFIG == 0){
		$zbp->DelConfig('AutoLinkTags');
	}
}