    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
<?php 
$SEOON = $zbp->Config('tpure')->SEOON;
$SEODIVIDE = $zbp->Config('tpure')->SEODIVIDE ? $zbp->Config('tpure')->SEODIVIDE : ' - ';
$SEOTITLE = $zbp->Config('tpure')->SEOTITLE;
$SEOKEYWORDS = $zbp->Config('tpure')->SEOKEYWORDS;
$SEODESCRIPTION = $zbp->Config('tpure')->SEODESCRIPTION;
$SEORETITLEON = $zbp->Config('tpure')->SEORETITLEON;
$SEODESCRIPTIONDATA = $zbp->Config('tpure')->SEODESCRIPTIONDATA;
$SEODESCRIPTIONNUM = $zbp->Config('tpure')->SEODESCRIPTIONNUM;
$SEOTITLENOCODEON = $zbp->Config('tpure')->SEOTITLENOCODEON;
if(isset($SEOON) && $SEOON == '1'){
    if($type == 'index'){
        if($page == '1'){
            if(isset($SEOTITLE) && !empty($SEOTITLE)){
                $ThisTitle = $SEOTITLE;
            }else{
                $ThisTitle = $zbp->name.$SEODIVIDE.$zbp->subname;
            }
        }else{
            $ThisTitle = $SEORETITLEON == '1' ? $zbp->name.$SEODIVIDE.'第'.$page.'页' : '第'.$page.'页'.$SEODIVIDE.$zbp->name;
        }
        if(isset($SEOKEYWORDS)){
            $keywords = $SEOKEYWORDS;
        }else{
            $keywords = '';
        }
        if(isset($SEODESCRIPTION)){
            $description = $SEODESCRIPTION;
        }else{
            $description = '';
        }
    }elseif($type == 'category'){
        $catalog_array = array(
            'catalog' => $zbp->title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $catalog_info = json_decode($zbp->Config('tpure')->SEOCATALOGINFO,true);
        $catalogTitle = '';
        if(count((array)$catalog_info)){
            foreach($catalog_info as $key => $info){
                if($info == 1) $catalog_newinfo[] = $catalog_array[$key];
            }
            $catalogTitle .= implode($SEODIVIDE, $catalog_newinfo);
        }else{
            $catalogTitle .= $zbp->title.$SEODIVIDE.$zbp->name;
        }

        if($category->Metas->catetitle){
            if ($page=='1') {
                $ThisTitle = $category->Metas->catetitle;
            }else{
                $ThisTitle = $SEORETITLEON == '1' ? $category->Metas->catetitle.$SEODIVIDE.$zbp->title : $zbp->title.$SEODIVIDE.$category->Metas->catetitle;
            }
        }else{
            if ($page == '1') {
                $ThisTitle = $catalogTitle;
            }else{
                $ThisTitle = $SEORETITLEON == '1' ? $zbp->name.$SEODIVIDE.$zbp->title : $zbp->title.$SEODIVIDE.$zbp->name;
            }
        }
        if($category->Metas->catekeywords){
            $keywords = $category->Metas->catekeywords;
        }else{
            $keywords = $category->Name;
        }
        if($category->Metas->catedescription){
            $description = $category->Metas->catedescription;
        }else{
            $description = $category->Intro;
        }
    }elseif($type == 'tag'){
        $tag_array = array(
            'tag' => $zbp->title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $tag_info = json_decode($zbp->Config('tpure')->SEOTAGINFO,true);
        $tagTitle = '';
        if(count((array)$tag_info)){
            foreach($tag_info as $key => $info){
                if($info == 1) $tag_newinfo[] = $tag_array[$key];
            }
            $tagTitle .= implode($SEODIVIDE, $tag_newinfo);
        }else{
            $tagTitle .= $zbp->title.$SEODIVIDE.$zbp->name;
        }
        if($tag->Metas->tagtitle){
            if ($page=='1') {
                $ThisTitle = $tag->Metas->tagtitle;
            }else{
                $ThisTitle = $SEORETITLEON == '1' ? $tag->Metas->tagtitle.$SEODIVIDE.$zbp->title : $zbp->title.$SEODIVIDE.$tag->Metas->tagtitle;
            }
        }else{
            if ($page=='1') {
                $ThisTitle = $tagTitle;
            }else{
                $ThisTitle = $SEORETITLEON == '1' ? $zbp->name.$SEODIVIDE.$zbp->title : $zbp->title.$SEODIVIDE.$zbp->name;
            }
        }
        if($tag->Metas->tagkeywords){
            $keywords = $tag->Metas->tagkeywords;
        }else{
            $keywords = $tag->Name;
        }
        if($tag->Metas->tagdescription){
            $description = $tag->Metas->tagdescription;
        }else{
            $description = $tag->Intro;
        }
    }elseif($type == 'article'){
        $article_array = array(
            'article' => $article->Title,
            'catalog' => $article->Category->Name,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $article_info = json_decode($zbp->Config('tpure')->SEOARTICLEINFO,true);
        $articleTitle = '';
        if(count((array)$article_info)){
            foreach($article_info as $key => $info){
                if($info == 1) $article_newinfo[] = $article_array[$key];
            }
            $articleTitle .= implode($SEODIVIDE, $article_newinfo);
        }else{
            $articleTitle .= $zbp->title.$SEODIVIDE.$zbp->name;
        }
        if($article->Metas->singletitle){
            $ThisTitle = $article->Metas->singletitle;
        }else{
            $ThisTitle = $articleTitle;
        }   
        if($article->Metas->singlekeywords){
            $keywords = $article->Metas->singlekeywords;
        }else{
            $aryTags = array();
            foreach($article->Tags as $key){
                $aryTags[] = $key->Name;
            }
            if(count($aryTags)>0){
                $keywords = implode(',',$aryTags);
            }else{
                $keywords = '';
            }
        }
        if($article->Metas->singledescription){
            $description = $article->Metas->singledescription;
        }else{
            $SEODESCRIPTIONDATA == '0' ? $DescriptionData = $article->Content : $DescriptionData = $article->Intro;
            if($SEODESCRIPTIONNUM){
                $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML(str_replace('&nbsp;','',$DescriptionData),'[nohtml]'),$SEODESCRIPTIONNUM)).'...');
            }else{
                $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML(str_replace('&nbsp;','',$DescriptionData),'[nohtml]'),200)).'...');
            }
        }
    }elseif($type == 'page'){
        $page_array = array(
            'page' => $article->Title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $page_info = json_decode($zbp->Config('tpure')->SEOPAGEINFO,true);
        $pageTitle = '';
        if(count((array)$page_info)){
            foreach($page_info as $key => $info){
                if($info == 1) $page_newinfo[] = $page_array[$key];
            }
            $pageTitle .= implode($SEODIVIDE, $page_newinfo);
        }else{
            $pageTitle .= $zbp->title.$SEODIVIDE.$zbp->name;
        }
        if($article->Metas->singletitle){
            $ThisTitle = $article->Metas->singletitle;
        }else{
            $ThisTitle = $pageTitle;
        }
        if($article->Metas->singlekeywords){
            $keywords = $article->Metas->singlekeywords;
        }else{
            $keywords = '';
        }
        if($article->Metas->singledescription){
            $description = $article->Metas->singledescription;
        }else{
            if($SEODESCRIPTIONNUM){
                $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML(str_replace('&nbsp;','',$article->Content),'[nohtml]'),$SEODESCRIPTIONNUM)).'...');
            }else{
                $description = preg_replace('/[\r\n\s]+/', '', trim(SubStrUTF8(TransferHTML(str_replace('&nbsp;','',$article->Content),'[nohtml]'),200)).'...');
            }
        }
    }elseif($type == 'author'){
        $user_array = array(
            'user' => $title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $user_info = json_decode($zbp->Config('tpure')->SEOUSERINFO,true);
        $userTitle = '';
        if(count((array)$user_info)){
            foreach($user_info as $key => $info){
                if($info == 1) $user_newinfo[] = $user_array[$key];
            }
            $userTitle .= implode($SEODIVIDE, $user_newinfo);
        }else{
            $userTitle .= $zbp->title.$SEODIVIDE.$zbp->name;
        }
        $ThisTitle = $userTitle;
        if(isset($SEOKEYWORDS)){
            $keywords = $SEOKEYWORDS;
        }else{
            $keywords = '';
        }
        if(isset($SEODESCRIPTION)){
            $description = $SEODESCRIPTION;
        }else{
            $description = '';
        }
    }elseif($type == 'date'){
        $date_array = array(
            'date' => $title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $date_info = json_decode($zbp->Config('tpure')->SEODATEINFO,true);
        $dateTitle = '';
        if(count((array)$date_info)){
            foreach($date_info as $key => $info){
                if($info == 1) $date_newinfo[] = $date_array[$key];
            }
            $dateTitle .= implode($SEODIVIDE, $date_newinfo);
        }else{
            $dateTitle .= $zbp->title.$SEODIVIDE.$zbp->name;
        }
        $ThisTitle = $dateTitle;
        if(isset($SEOKEYWORDS)){
            $keywords = $SEOKEYWORDS;
        }else{
            $keywords = '';
        }
        if(isset($SEODESCRIPTION)){
            $description = $SEODESCRIPTION;
        }else{
            $description = '';
        }
    }elseif($type == 'search'){
        $search_array = array(
            'search' => $title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $search_info = json_decode($zbp->Config('tpure')->SEOSEARCHINFO,true);
        $searchTitle = '';
        if(count((array)$search_info)){
            foreach($search_info as $key => $info){
                if($info == 1) $search_newinfo[] = $search_array[$key];
            }
            $searchTitle .= implode($SEODIVIDE, $search_newinfo);
        }else{
            $searchTitle .= $zbp->title . $SEODIVIDE . $zbp->name;
        }
        $ThisTitle = $searchTitle;
        if(isset($SEOKEYWORDS)){
            $keywords = $SEOKEYWORDS;
        }else{
            $keywords = '';
        }
        if(isset($SEODESCRIPTION)){
            $description = $SEODESCRIPTION;
        }else{
            $description = '';
        }
    }else {
        $other_array = array(
            'other' => $title,
            'title' => $zbp->name,
            'subtitle' => $zbp->subname,
        );
        $other_info = json_decode($zbp->Config('tpure')->SEOOTHERINFO,true);
        $otherTitle = '';
        if(count((array)$other_info)){
            foreach($other_info as $key => $info){
                if($info == 1) $other_newinfo[] = $other_array[$key];
            }
            $otherTitle .= implode($SEODIVIDE, $other_newinfo);
        }else{
            $otherTitle .= $zbp->title . $SEODIVIDE . $zbp->name;
        }
        if($page > '1'){
            $ThisTitle = $SEORETITLEON == '1' ? $zbp->name . $SEODIVIDE . $zbp->title : $zbp->title . $SEODIVIDE . $zbp->name;
        }else{
            $ThisTitle = $otherTitle;
        }
        if(isset($SEOKEYWORDS)){
            $keywords = $SEOKEYWORDS;
        }else{
            $keywords = '';
        }
        if(isset($SEODESCRIPTION)){
            $description = $SEODESCRIPTION;
        }else{
            $description = '';
        }
    }
}
 ?>
    <title><?php if (isset($SEOON) && $SEOON == '1') { ?><?php  echo $SEOTITLENOCODEON ? tpure_CodeToString($ThisTitle) : $ThisTitle;  ?><?php }else{  ?><?php if ($type == 'index' && $page == '1') { ?><?php  echo $name;  ?> - <?php  echo $title;  ?><?php }else{  ?><?php  echo $title;  ?> - <?php  echo $name;  ?><?php } ?><?php } ?></title>
<?php if (isset($SEOON) && $SEOON == '1') { ?>
<?php if ($keywords) { ?>
    <meta name="keywords" content="<?php  echo $keywords;  ?>">
<?php } ?>
<?php if ($description) { ?>
    <meta name="description" content="<?php  echo $description;  ?>">
<?php } ?>
<?php } ?>
    <?php if ($zbp->Config('tpure')->PostFAVICONON) { ?><link rel="shortcut icon" href="<?php  echo $zbp->Config('tpure')->PostFAVICON;  ?>" type="image/x-icon" />
<?php } ?>
    
<?php if ($zbp->Config('tpure')->PostSHAREARTICLEON == '1' || $zbp->Config('tpure')->PostSHAREPAGEON == '1') { ?>
    <link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/tpure/plugin/share/share.css" />
    <script src="<?php  echo $host;  ?>zb_users/theme/tpure/plugin/share/share.js"></script>
<?php } ?>
<?php if ($zbp->Config('tpure')->PostSLIDEON == '1') { ?>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/plugin/swiper/swiper.min.js"></script>
    <link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/plugin/swiper/swiper.min.css" type="text/css" media="all"/>
<?php } ?>
    <link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/<?php  echo $style;  ?>.css?v=<?php  echo $zbp->themeapp->version;  ?>" type="text/css" media="all" />
<?php if ($zbp->Config('tpure')->PostCOLORON == '1') { ?>
    <link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/skin.css" type="text/css" media="all" />
<?php } ?>
    <script src="<?php  echo $host;  ?>zb_system/script/jquery-2.2.4.min.js"></script>
    <script src="<?php  echo $host;  ?>zb_system/script/zblogphp.js"></script>
    <script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php"></script>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/common.js?v=<?php  echo $zbp->themeapp->version;  ?>"></script>
<?php if ($zbp->Config('tpure')->PostCHECKDPION == '1' && !tpure_isMobile()) { ?>
    <script src="<?php  echo $host;  ?>zb_users/theme/tpure/plugin/checkdpi/jquery.detectZoom.js"></script>
<?php } ?>
<?php if ($zbp->Config('tpure')->PostQRON == '1') { ?>
    <script src="<?php  echo $host;  ?>zb_users/theme/tpure/plugin/qrcode/jquery.qrcode.min.js"></script>
<?php } ?>
    <script>window.tpure={<?php if ($zbp->Config('tpure')->PostQRON == '1') { ?>qr:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostQRSIZE) { ?>qrsize:<?php  echo $zbp->Config('tpure')->PostQRSIZE ? $zbp->Config('tpure')->PostQRSIZE : '70';  ?>,<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEON=='1') { ?>slideon:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEDISPLAY=='1') { ?>slidedisplay:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDETIME) { ?>slidetime:<?php  echo $zbp->Config('tpure')->PostSLIDETIME;  ?>,<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEPAGETYPE=='1') { ?>slidepagetype:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEEFFECTON=='1') { ?>slideeffect:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostBANNERDISPLAYON=='1') { ?>bannerdisplay:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostVIEWALLON=='1') { ?>viewall:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostVIEWALLSTYLE) { ?>viewallstyle:'1',<?php }else{  ?>viewallstyle:'0',<?php } ?><?php if ($zbp->Config('tpure')->PostVIEWALLHEIGHT) { ?>viewallheight:'<?php  echo $zbp->Config('tpure')->PostVIEWALLHEIGHT;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostAJAXON=='1') { ?>ajaxpager:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostLOADPAGENUM) { ?>loadpagenum:'<?php  echo $zbp->Config('tpure')->PostLOADPAGENUM;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostLAZYLOADON=='1') { ?>lazyload:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostLAZYLINEON=='1') { ?>lazyline:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostLAZYNUMON=='1') { ?>lazynum:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTON) { ?>night:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTAUTOON) { ?>setnightauto:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTSTART) { ?>setnightstart:'<?php  echo $zbp->Config('tpure')->PostSETNIGHTSTART;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTOVER) { ?>setnightover:'<?php  echo $zbp->Config('tpure')->PostSETNIGHTOVER;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostSELECTON=='1') { ?>selectstart:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSINGLEKEY=='1') { ?>singlekey:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostPAGEKEY=='1') { ?>pagekey:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostTFONTSIZEON=='1') { ?>tfontsize:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostFIXSIDEBARON=='1') { ?>fixsidebar:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostFIXSIDEBARSTYLE) { ?>fixsidebarstyle:'1',<?php }else{  ?>fixsidebarstyle:'0',<?php } ?><?php if ($zbp->Config('tpure')->PostREMOVEPON=='1') { ?>removep:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostBACKTOTOPON=='1') { ?>backtotop:'on',<?php } ?>version:<?php  echo $zbp->themeapp->version;  ?>}</script>
<?php if ($zbp->Config('tpure')->PostBLANKSTYLE=='1') { ?>
    <base target="_blank" />
<?php } ?>
<?php if ($zbp->Config('tpure')->PostGREYON=='1') { ?>
    <?php if (($zbp->Config('tpure')->PostGREYDAY && tpure_IsToday($zbp->Config('tpure')->PostGREYDAY) == true)) { ?>
        <?php if ($zbp->Config('tpure')->PostGREYSTATE=='0') { ?>
            <?php if ($type == 'index') { ?><style>html { filter:grayscale(100%); } * { filter:gray; }</style><?php } ?>
        <?php }else{  ?>
            <style>html { filter:grayscale(100%); } * { filter:gray; }</style>
        <?php } ?>
    <?php }elseif(!$zbp->Config('tpure')->PostGREYDAY) {  ?>
        <?php if ($zbp->Config('tpure')->PostGREYSTATE=='0') { ?>
            <?php if ($type == 'index') { ?><style>html { filter:grayscale(100%); } * { filter:gray; }</style><?php } ?>
        <?php }else{  ?>
            <style>html { filter:grayscale(100%); } * { filter:gray; }</style>
        <?php } ?>
    <?php } ?>
<?php } ?>
<?php if ($type=='article') { ?>
    <link rel="canonical" href="<?php  echo $article->Url;  ?>" />
<?php } ?>
<?php if ($type=='index'&&$page=='1') { ?>
    <link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" />
<?php } ?>