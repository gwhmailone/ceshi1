<?php  /* Template Name:404错误页 */  ?>
<!DOCTYPE html>
<html xml:lang="<?php  echo $lang['lang_bcp47'];  ?>" lang="<?php  echo $lang['lang_bcp47'];  ?>">
<head>
    <meta charset="utf-8">
    <?php if (isset($lang['tpure']['theme'])) { ?><meta name="theme" content="<?php  echo $lang['tpure']['theme'];  ?>">
<?php } ?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <title><?php  echo $lang['tpure']['error404'];  ?> - <?php  echo $name;  ?></title>
    <?php if ($zbp->Config('tpure')->PostFAVICONON) { ?><link rel="shortcut icon" href="<?php  echo $zbp->Config('tpure')->PostFAVICON;  ?>" type="image/x-icon" />
<?php } ?>
    <meta name="generator" content="<?php  echo $zblogphp;  ?>">
<?php if ($zbp->Config('tpure')->PostSHAREARTICLEON == '1' || $zbp->Config('tpure')->PostSHAREPAGEON == '1') { ?>
    <link rel="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/tpure/plugin/share/share.css" />
    <script src="<?php  echo $host;  ?>zb_users/theme/tpure/plugin/share/share.js"></script>
<?php } ?>
<?php if ($zbp->Config('tpure')->PostSLIDEON == '1') { ?>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/plugin/swiper/swiper.min.js"></script>
    <link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/plugin/swiper/swiper.min.css" type="text/css" media="all"/>
<?php } ?>
    <link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/style/<?php  echo $style;  ?>.css" type="text/css" media="all" />
<?php if ($zbp->Config('tpure')->PostCOLORON == '1') { ?>
    <link rel="stylesheet" rev="stylesheet" href="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/include/skin.css" type="text/css" media="all" />
<?php } ?>
    <script src="<?php  echo $host;  ?>zb_system/script/jquery-2.2.4.min.js"></script>
    <script src="<?php  echo $host;  ?>zb_system/script/zblogphp.js"></script>
    <script src="<?php  echo $host;  ?>zb_system/script/c_html_js_add.php"></script>
    <script src="<?php  echo $host;  ?>zb_users/theme/<?php  echo $theme;  ?>/script/common.js"></script>
    <script>window.tpure={<?php if ($zbp->Config('tpure')->PostSLIDEON=='1') { ?>slideon:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEDISPLAY=='1') { ?>slidedisplay:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDETIME) { ?>slidetime:<?php  echo $zbp->Config('tpure')->PostSLIDETIME;  ?>,<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEPAGETYPE=='1') { ?>slidepagetype:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSLIDEEFFECTON=='1') { ?>slideeffect:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostBANNERDISPLAYON=='1') { ?>bannerdisplay:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostVIEWALLON=='1') { ?>viewall:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostVIEWALLSTYLE) { ?>viewallstyle:'1',<?php }else{  ?>viewallstyle:'0',<?php } ?><?php if ($zbp->Config('tpure')->PostVIEWALLHEIGHT) { ?>viewallheight:'<?php  echo $zbp->Config('tpure')->PostVIEWALLHEIGHT;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostAJAXON=='1') { ?>ajaxpager:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostLOADPAGENUM) { ?>loadpagenum:'<?php  echo $zbp->Config('tpure')->PostLOADPAGENUM;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostLAZYLOADON=='1') { ?>lazyload:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostLAZYLINEON=='1') { ?>lazyline:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostLAZYNUMON=='1') { ?>lazynum:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTON) { ?>night:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTAUTOON) { ?>setnightauto:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTSTART) { ?>setnightstart:'<?php  echo $zbp->Config('tpure')->PostSETNIGHTSTART;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostSETNIGHTOVER) { ?>setnightover:'<?php  echo $zbp->Config('tpure')->PostSETNIGHTOVER;  ?>',<?php } ?><?php if ($zbp->Config('tpure')->PostSELECTON=='1') { ?>selectstart:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostSINGLEKEY=='1') { ?>singlekey:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostPAGEKEY=='1') { ?>pagekey:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostTFONTSIZEON=='1') { ?>tfontsize:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostFIXSIDEBARON=='1') { ?>fixsidebar:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostFIXSIDEBARSTYLE) { ?>fixsidebarstyle:'1',<?php }else{  ?>fixsidebarstyle:'0',<?php } ?><?php if ($zbp->Config('tpure')->PostREMOVEPON=='1') { ?>removep:'on',<?php } ?><?php if ($zbp->Config('tpure')->PostBACKTOTOPON=='1') { ?>backtotop:'on'<?php } ?>}</script>
<?php if ($zbp->Config('tpure')->PostBLANKSTYLE == '1') { ?>
    <base target="_blank" />
<?php } ?>
<?php if ($zbp->Config('tpure')->PostGREYON == '1') { ?>
    <?php if (($zbp->Config('tpure')->PostGREYDAY && tpure_IsToday($zbp->Config('tpure')->PostGREYDAY) == true)) { ?>
        <?php if ($zbp->Config('tpure')->PostGREYSTATE == '0') { ?>
            <?php if ($type == 'index') { ?><style>html { filter:grayscale(100%); } * { filter:gray; }</style><?php } ?>
        <?php }else{  ?>
            <style>html { filter:grayscale(100%); } * { filter:gray; }</style>
        <?php } ?>
    <?php }elseif(!$zbp->Config('tpure')->PostGREYDAY) {  ?>
        <?php if ($zbp->Config('tpure')->PostGREYSTATE == '0') { ?>
            <?php if ($type == 'index') { ?><style>html { filter:grayscale(100%); } * { filter:gray; }</style><?php } ?>
        <?php }else{  ?>
            <style>html { filter:grayscale(100%); } * { filter:gray; }</style>
        <?php } ?>
    <?php } ?>
<?php } ?>
<?php if ($type == 'article') { ?>
    <link rel="canonical" href="<?php  echo $article->Url;  ?>" />
<?php } ?>
<?php if ($type == 'index' && $page == '1') { ?>
    <link rel="alternate" type="application/rss+xml" href="<?php  echo $feedurl;  ?>" title="<?php  echo $name;  ?>" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php  echo $host;  ?>zb_system/xml-rpc/?rsd" />
    <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php  echo $host;  ?>zb_system/xml-rpc/wlwmanifest.xml" />
<?php } ?>
</head>
<body class="<?php  echo $type;  ?><?php if (GetVars('night','COOKIE') ) { ?> night<?php } ?>">
<div class="wrapper">
    <?php  include $this->GetTemplate('navbar');  ?>
    <div class="main<?php if ($zbp->Config('tpure')->PostFIXMENUON == '1') { ?> fixed<?php } ?>">
        <?php if ($zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1') { ?>
            <div class="banner" data-type="display" data-speed="2" style="
            <?php if (!tpure_isMobile()) { ?>height:<?php  echo $zbp->Config('tpure')->PostBANNERPCHEIGHT;  ?>px;<?php }else{  ?>height:<?php  echo $zbp->Config('tpure')->PostBANNERMHEIGHT;  ?>px;<?php } ?>
            background-image:url(<?php  echo $zbp->Config('tpure')->PostBANNER;  ?>);"><div class="wrap"><?php if ($zbp->Config('tpure')->PostBANNERFONT) { ?><h2><?php  echo $zbp->Config('tpure')->PostBANNERFONT;  ?></h2><?php } ?></div>
            </div>
        <?php } ?>
        <div class="mask"></div>
        <div class="wrap">
            <div class="errorpage">
				<h3><?php  echo $lang['tpure']['error404txt'];  ?></h3>
				<h4><?php  echo $lang['tpure']['nopage'];  ?></h4>
				<p><?php  echo $lang['tpure']['trysearch'];  ?></p>
				<form name="search" method="post" action="<?php  echo $host;  ?>zb_system/cmd.php?act=search" class="errorsearch">
				<input type="text" name="q" size="11" class="errschtxt"> 
				<input type="submit" value="<?php  echo $lang['tpure']['search'];  ?>" class="errschbtn">
				</form>
				<a class="goback" href="<?php  echo $host;  ?>"><?php  echo $lang['tpure']['back'];  ?><?php  echo $lang['tpure']['index'];  ?></a>
			</div>
        </div>
    </div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
</body>
</html>