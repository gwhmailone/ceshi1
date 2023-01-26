<?php
RegisterPlugin("baiduziyuan","ActivePlugin_baiduziyuan");

function ActivePlugin_baiduziyuan() {
    Add_Filter_Plugin('Filter_Plugin_PostArticle_Core','baiduziyuan_PostArticle_Core');
    Add_Filter_Plugin('Filter_Plugin_PostArticle_Succeed','baiduziyuan_PostArticle_Succeed');
    Add_Filter_Plugin('Filter_Plugin_DelArticle_Succeed','baiduziyuan_DelArticle_Succeed');
    Add_Filter_Plugin('Filter_Plugin_PostPage_Core','baiduziyuan_PostArticle_Core');
    Add_Filter_Plugin('Filter_Plugin_PostPage_Succeed','baiduziyuan_PostArticle_Succeed');
    Add_Filter_Plugin('Filter_Plugin_Edit_Response3','baiduziyuan_Edit_Response3');
    Add_Filter_Plugin('Filter_Plugin_Zbp_MakeTemplatetags','baiduziyuan_Zbp_MakeTemplatetags');
}

function baiduziyuan_Zbp_MakeTemplatetags() {
	global $zbp;
    if($zbp->Config('baiduziyuan')->isjs){
        $s = <<<js
<script>(function(){var bp=document.createElement('script');var curProtocol=window.location.protocol.split(':')[0];if(curProtocol==='https'){bp.src='https://zz.bdstatic.com/linksubmit/push.js'}else{bp.src='http://push.zhanzhang.baidu.com/push.js'}var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(bp,s)})()</script>
js;
        $zbp->footer .=  $s."\r\n";
    }
}


function baiduziyuan_Edit_Response3(){
    global $zbp,$article;
    echo '<div id="original" class="editmod">
    <label for="edtoriginal" class="editinputname">百度链接提交默认是多条</label></div>';
    echo '<div id="original" class="editmod">
    <label for="edtoriginal" class="editinputname">百度链接提交（单条）</label>
    <input id="edtoriginal" name="meta_baidulinks" style="" type="text" value="'.(int) $article->Metas->baidulinks.'" class="checkbox"/>
    </div>';

    echo '<div id="original" class="editmod">
    <label for="edtoriginal" class="editinputname">快速收录</label>
    <input id="edtoriginal" name="meta_dailysubmit" style="" type="text" value="'.(int) $article->Metas->dailysubmit.'" class="checkbox"/>
    </div>';

    if($zbp->Config('baiduziyuan')->isbatch){
        echo '<div id="original" class="editmod">
        <label for="edtoriginal" class="editinputname">原创提交</label>
        <input id="edtoriginal" name="meta_original" style="" type="text" value="'.(int) $article->Metas->original.'" class="checkbox"/>
        </div>';
        if($article->ID==0){
        echo '<div id="edtbatch" class="editmod">
        <label for="edtbatch" class="editinputname">熊掌提交</label>
        <input id="edtbatch" name="meta_realtime" style="" type="text" value="'.(int) $article->Metas->realtime.'" class="checkbox"/>
        </div>';
        }else{
        echo '<div id="edtbatch" class="editmod">
        <label for="edtbatch" class="editinputname">更新熊掌提交</label>
        <input id="edtbatch" name="meta_batch" style="" type="text" value="'.(int) $article->Metas->batch.'" class="checkbox"/>
        </div>';
        }
    }
}

function baiduziyuan_DelArticle_Succeed($article){
    global $zbp;
    baiduziyuan_Post($article,'del');
}

function baiduziyuan_PostArticle_Core($article){
    global $zbp;
    if($article->Status)  return ;
    $zbp->Config('baiduziyuan')->is = 1;
    if($article->ID){
        $zbp->Config('baiduziyuan')->is = 0;
        baiduziyuan_Post($article,'update');
    }
    $zbp->SaveConfig('baiduziyuan');
}

function baiduziyuan_PostArticle_Succeed($article){
    global $zbp;
    if($article->Status)  return ;
    if($zbp->Config('baiduziyuan')->is){
        baiduziyuan_Post($article);
    }
    if((int) $article->Metas->dailysubmit==1){
        baiduziyuan_Post($article,'urls','original');
    }
}

function InstallPlugin_baiduziyuan(){
	global $zbp;
}

function baiduziyuan_Post($article,$state='urls',$type=null){
    global $zbp;
    $weburl=$zbp->host;
	$weburl=str_replace('http://','',$weburl);
	$weburl=str_replace('https://','',$weburl);
	$weburl=str_replace('/','',$weburl);

    $urls=[];
    $urls[]=$article->Url;
    if($state!='del'){
        if($article->Metas->baidulinks==0){
            if($article->Type==0){
                $urls[]=$article->Category->Url;
                foreach($article->Tags as $tag){
                    $urls[]=$tag->Url;
                }
            }
            $urls[]=$article->Author->Url;
        }
    }
    $api = 'http://data.zz.baidu.com/'.$state.'?site='.$weburl.'&token='.$zbp->Config('baiduziyuan')->token;
    if($type=='original'){
        $api = 'http://data.zz.baidu.com/urls?site='.$weburl.'&token='.$zbp->Config('baiduziyuan')->token."&type=daily";
        $urls=[];
        $urls[]=$article->Url;
    }

    $ajax = Network::Create();
	if (!$ajax) {
		throw new Exception('主机没有开启网络功能');
	}
	$ajax->open('POST', $api);
	$ajax->setRequestHeader('Content-Type', 'text/plain');
	$ajax->send(implode("\n", $urls));
	$result = str_replace('\\','',json_encode($ajax->responseText));
	$zbp->SetHint('good','百度推送：'.$result);
}

function baiduziyuan_submenu($action) {
    $array = array(
        array(
            'action' => 'main',
            'url' => 'main.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '主动推送(实时)',
        ),
        array(
            'action' => 'js',
            'url' => 'js.php',
            'target' => '_self',
            'float' => 'left',
            'title' => '自动推送',
        ),
        array(
            'action' => 'sitemap',
            'url' => 'sitemap.php',
            'target' => '_self',
            'float' => 'left',
            'title' => 'sitemap',
        ),
        array(
            'action' => 'regex_test',
            'url' => 'https://www.ytecn.com/2017/10/771.html',
            'target' => '_blank',
            'float' => 'right',
            'title' => '帮助',
        ),
    );
    $str = '';
    $template = '<a href="$url" target="$target"><span class="m-$float$light">$title</span></a>';
    for ($i = 0; $i < count($array); $i++) {
        $str .= $template;
        $str = str_replace('$url', $array[$i]['url'], $str);
        $str = str_replace('$target', $array[$i]['target'], $str);
        $str = str_replace('$float', $array[$i]['float'], $str);
        $str = str_replace('$title', $array[$i]['title'], $str);
        $str = str_replace('$light', ($action == $array[$i]['action'] ? ' m-now' : ''), $str);
    }
    return $str;
}

?>