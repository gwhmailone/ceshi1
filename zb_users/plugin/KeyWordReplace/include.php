<?php
#注册插件
RegisterPlugin("KeyWordReplace","ActivePlugin_KeyWordReplace");

function ActivePlugin_KeyWordReplace() {
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template','KeyWordReplace_TagsLink');
}

function KeyWordReplace_TagsLink(&$template) {
	global $zbp;
	$article = $template->GetTags('article');
	$article->Content = KeyWordReplace_Mian($article);
	$template->SetTags('article',$article);
}

function KeyWordReplace_Mian($article) {
	global $zbp;
	$content = $article->Content;
	$array = $article->Tags;
    $array2  = array();
	foreach($array as $t){
		$array2[$t->Name] = $t->Url;
	}
    $array3  = array();
    $array4 = array_unique(explode(',', str_replace("\r\n",",",trim($zbp->Config('KeyWordReplace')->tags))));
    foreach ($array4 as $t) {
        if($t) {
            list($name, $turl) = explode('$$$', $t);
            $array3[$name] = $turl;
        }
	}
	$tags= array();
	foreach(array_merge($array2,$array3) as $k=>$t) {
		$tags[] = array('name'=>$k,'url'=>$t);
	}
	$target = $zbp->Config('KeyWordReplace')->target == '' ? '' : ' target="_blank"';
	$color = '';
	if ($zbp->Config('KeyWordReplace')->colorOn == '1') {
		$color = $zbp->Config('KeyWordReplace')->color == '' ? '' : ' style="color: #'.$zbp->Config('KeyWordReplace')->color.';"';
	}
	$class = $zbp->Config('KeyWordReplace')->class == '' ? '' : ' class="'.$zbp->Config('KeyWordReplace')->class.'"';
	$id = $zbp->Config('KeyWordReplace')->ID == '' ? '' : ' id="'.$zbp->Config('KeyWordReplace')->ID.'"';
	if(is_array($tags)) {
		$threshold = $zbp->Config('KeyWordReplace')->threshold == '' ? '5' : $zbp->Config('KeyWordReplace')->threshold;
		$n = 0;
        preg_match_all("/<pre([^<>]*?)>([\s\S]*?)<\/pre>/", $content, $pat_array);
        //pre标签包含有关键词问题
        $prearr = array();
        foreach ($pat_array[2] as $key=>$val) {
        	$content = str_replace($val, "%&&&&&%".$key, $content);
        	$prearr[] = $val;
        }
	    foreach($tags as $v) {
		    $link = $v['url'];
            $keyword = $v['name'];
            $cleankeyword = stripslashes($keyword);
            $url = "<a href=\"$link\" title=\"".addcslashes($cleankeyword, '$')."\"";
            $url .= $class.$id.$target.$color;
            $url .= ">".addcslashes($cleankeyword, '$')."</a>";
            //v1.1加入图片中被替换问题
            //$content = preg_replace( '|(<img)(.*?)('.$cleankeyword.')(.*?)(>)|U', '$1$2%&&&&&%$4$5', $content);
            $limit = 1; //基于用户反馈链接过多限制为1，不在选择替换次数 限制为1次
            $count = 0; //v1.3 加入统计替换次数 避免设置关键词太多而导致内链太多问题
            $cleankeyword = preg_quote($cleankeyword,'\'');
            $regEx = '\'(?!((<.*?)|(<a.*?)))('.KeyWordReplace_preg($cleankeyword).')(?!(([^<>]*?)>)|([^>]*?<\/a>))\'s';
            $content = preg_replace($regEx,$url,$content,$limit,$count);
            //$content = str_replace( '%&&&&&%', KeyWordReplace_preg($cleankeyword), $content);
            if( $count > 0 ) $n++;
            if( $n >= $threshold ) break;
	    }
        foreach ($pat_array[2] as $key=>$val) {
        	$content = str_replace("%&&&&&%".$key, $prearr[$key], $content);
        }
	}
	return $content;
}

function KeyWordReplace_preg($str) {
	$str = strtolower(trim($str));
	$replace = array('\\','+','*','?','[','^',']','$','(',')','{','}','=','!','<','>','|',':','-',';','\'','\"','/','%','&','_','`');
    return str_replace($replace,"",$str);
}

function InstallPlugin_KeyWordReplace() {
	global $zbp;
	if(!$zbp->Config('KeyWordReplace')->HasKey('Version')){
		$array = array(
			'Version'   => '1.0',
			'target'    => 0,
			'colorOn'   => 0,
			'color'     => '4382FF',
			'class'     =>'',
			'ID'        =>'',
			'threshold' =>'',
		);
		foreach($array as $key => $val){
		   $zbp->Config('KeyWordReplace')->$key = $val;
		}
	}
	$zbp->Config('KeyWordReplace')->Version = '1.3.1';
	$zbp->SaveConfig('KeyWordReplace');
	
}