<?php
#注册插件
RegisterPlugin("zharry_imgalt","ActivePlugin_zharry_imgalt");

function ActivePlugin_zharry_imgalt() {
	Add_Filter_Plugin('Filter_Plugin_ViewPost_Template', 'zharry_imgalt_main');
	Add_Filter_Plugin('Filter_Plugin_Edit_Response5','zharry_imgalt_alt');
	}

function zharry_imgalt_alt(){
    global $zbp,$article;
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt_kg=='1'){
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='3'){
		echo '<div class="editmod"><label for="meta_zharry_imgaltbq" class="editinputname">自定义图片ALT标签</label><input type="text" name="meta_zharry_imgaltbq" value="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'" style="width:50%;"/>&nbsp;&nbsp;此处不填写，前台不显示自定义ALT标签<br/></div>';
}}}

function zharry_imgalt_main( &$template ){
        global $zbp,$altURL;
		$article = $template->GetTags('article');	
	//图片ALT参数
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt_kg=='1'){
	//排除分类ID,文章ID不开启图片ALT参数
	$fenl_cate=explode(',',$zbp->Config('zharry_imgalt')->zharry_fl_id);    	
	$wzid_cate=explode(',',$zbp->Config('zharry_imgalt')->zharry_wz_id);  
	 
	if(in_array($article->ID,$wzid_cate)){
	if(in_array($article->Category->ID,$fenl_cate)){
	//文章ID开分类ID开,不开启图片ALT参数
	$template->SetTags('article', $article);
	}else{
	//文章ID开分类ID不开,不开启图片ALT参数
	$template->SetTags('article', $article);
	}
	}else{ 
	if(in_array($article->Category->ID,$fenl_cate)){
	//文章ID不开分类ID开,不开启图片ALT参数
	$template->SetTags('article', $article);
	}else{
	//文章ID不开分类ID不开,开启图片ALT参数
        $imgtitle = $article->Title;
	//强制清除图片title参数值
		preg_match_all('/title="(.*?)"/',$article->Content,$matches); 
		if($matches){ foreach($matches[1] as $val){
		 $article->Content = str_replace('title="' . $val . '"', '', $article->Content); 
		 }
	//强制清除图片ALT参数值
		preg_match_all('/alt="(.*?)"/',$article->Content,$matches); 
		if($matches){ foreach($matches[1] as $val){
		 $article->Content = str_replace('alt="' . $val . '"', '', $article->Content); 
		 }
		// 1始 显示文章标题
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='1'){
	$pattern = "/<img(.*?)src=('|\")([^>]*).(bmp|gif|jpeg|jpg|png|swf)('|\")(.*?)>/i";
	$replacement = '<img alt="'.$article->Title.'" title="'.$article->Title.'" src=$2$3.$4$5/>';
	$content = preg_replace($pattern, $replacement, $article->Content);
	$article->Content = $content;
	$template->SetTags('article', $article);
}
		//1完 2始 显示文章标题+第几张图片+站点名
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='2'){
        $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$imgUrl/siU",$article->Content,$matches,PREG_SET_ORDER)){
                if( !empty($matches) ){
                        for ($i=0; $i < count($matches); $i++){
                                $tag = $url = $matches[$i][0];
								$j=$i+1;
                                $altURL = ' alt="'.$imgtitle.'-第'.$j.'张图片-'.$zbp->name.'" title="'.$imgtitle.'-第'.$j.'张图片-'.$zbp->name.'" ';
                                $url = rtrim($url,'>');
                                $url .= $altURL.'>';
								$content = str_replace($tag,$url,$article->Content);
								$article->Content = $content;
								$template->SetTags('article', $article);	   
                        }
                }
        }}
		//2完 3始（自定义项）
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='3'){
        $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$imgUrl/siU",$article->Content,$matches,PREG_SET_ORDER)){
                if( !empty($matches) ){
                        for ($i=0; $i < count($matches); $i++){
                                $tag = $url = $matches[$i][0];
								$j=$i+1;
								if( !empty($article->Metas->zharry_imgaltbq) ){
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='4'){
                                $altURL = ' alt="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'-'.$imgtitle.'" title="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'-'.$imgtitle.'" ';}
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='3'){
                                $altURL = ' alt="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'-'.$imgtitle.'-第'.$j.'张图片-'.$zbp->name.'" title="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'-'.$imgtitle.'-第'.$j.'张图片-'.$zbp->name.'" ';}
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='2'){
                                $altURL = ' alt="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'-'.$imgtitle.'-'.$zbp->name.'" title="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'-'.$imgtitle.'-'.$zbp->name.'" ';}
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='1'){
                                $altURL = ' alt="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'" title="'.htmlspecialchars($article->Metas->zharry_imgaltbq).'" ';}
								}
                                $url = rtrim($url,'>');
                                $url .= $altURL.'>';
								$content = str_replace($tag,$url,$article->Content);
								$article->Content = $content;
								$template->SetTags('article', $article);	   
                        }
                }
        } }
		//3完 4始 显示文章标题+第几张图片
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='4'){
        $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$imgUrl/siU",$article->Content,$matches,PREG_SET_ORDER)){
                if( !empty($matches) ){
                        for ($i=0; $i < count($matches); $i++){
                                $tag = $url = $matches[$i][0];
								$j=$i+1;
                                $altURL = ' alt="'.$imgtitle.'-第'.$j.'张图片" title="'.$imgtitle.'-第'.$j.'张图片" ';
                                $url = rtrim($url,'>');
                                $url .= $altURL.'>';
								$content = str_replace($tag,$url,$article->Content);
								$article->Content = $content;
								$template->SetTags('article', $article);	   
                        }
                }
        }}
		//4完 5始 显示文章标题+站点名
	if ($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='5'){
        $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
        if(preg_match_all("/$imgUrl/siU",$article->Content,$matches,PREG_SET_ORDER)){
                if( !empty($matches) ){
                        for ($i=0; $i < count($matches); $i++){
                                $tag = $url = $matches[$i][0];
								$j=$i+1;
                                $altURL = ' alt="'.$imgtitle.'-'.$zbp->name.'" title="'.$imgtitle.'-'.$zbp->name.'" ';
                                $url = rtrim($url,'>');
                                $url .= $altURL.'>';
								$content = str_replace($tag,$url,$article->Content);
								$article->Content = $content;
								$template->SetTags('article', $article);	   
                        }
                }
        }}
		//5完
	}
	
	}
}	}
}
}

function InstallPlugin_zharry_imgalt() {
	global $zbp;
	$zbp->Config('zharry_imgalt')->zharry_imgalt_alt_kg='1';
	$zbp->Config('zharry_imgalt')->zharry_imgalt_alt='1';
	}
function UninstallPlugin_zharry_imgalt() {}