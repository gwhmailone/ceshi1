<?php  /* Template Name:用户文章列表模板 */  ?>
<!DOCTYPE html>
<html xml:lang="<?php  echo $lang['lang_bcp47'];  ?>" lang="<?php  echo $lang['lang_bcp47'];  ?>">
<head>
<?php  include $this->GetTemplate('header');  ?>
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
        <div<?php if ($zbp->Config('tpure')->PostFIXSIDEBARSTYLE == '0') { ?> id="hcsticky"<?php } ?> class="wrap">
            <?php if ($zbp->Config('tpure')->PostSITEMAPON == '1') { ?>
            <div class="sitemap"><?php  echo $lang['tpure']['sitemap'];  ?><a href="<?php  echo $host;  ?>"><?php  echo $lang['tpure']['index'];  ?></a>
<?php if ($type=='category') { ?>
<?php 
$html='';
function tpure_navcate($id){
   global $html;
   $cate = new Category;
   $cate->LoadInfoByID($id);
   $html = ' &gt; <a href="' .$cate->Url.'" title="查看' .$cate->Name. '中的全部文章">' .$cate->Name. '</a> '.$html;
   if(($cate->ParentID)>0){tpure_navcate($cate->ParentID);}
}
tpure_navcate($category->ID);
global $html;
echo $html;
 ?>
<?php }else{  ?>
> <?php  echo $title;  ?>
<?php } ?>
            </div>
            <?php } ?>
            <div class="content listcon">
                <?php if ($type == 'author') { ?>
                <div class="block">
                    <div class="auth">
                        <div class="authimg">
                            <?php if ($author->Metas->memberimg) { ?>
                                <img src="<?php  echo $author->Metas->memberimg;  ?>" alt="<?php  echo $author->StaticName;  ?>" />
                            <?php }else{  ?>
                                <img src="<?php  echo tpure_MemberAvatar($author);  ?>" alt="<?php  echo $author->StaticName;  ?>" />
                            <?php } ?>
                            <em class="sex<?php if ($author->Metas->membersex == '2') { ?> female<?php }else{  ?> male<?php } ?>"></em>
                        </div>
                        <div class="authinfo">
                            <h1><?php  echo $author->StaticName;  ?> <?php if ($type == 'author') { ?><span class="level"><?php if ($author->Level == '1') { ?><?php  echo $lang['tpure']['user_level_name']['1'];  ?><?php }elseif($author->Level == '2') {  ?><?php  echo $lang['tpure']['user_level_name']['2'];  ?><?php }elseif($author->Level == '3') {  ?><?php  echo $lang['tpure']['user_level_name']['3'];  ?><?php }elseif($author->Level == '4') {  ?><?php  echo $lang['tpure']['user_level_name']['4'];  ?><?php }elseif($author->Level == '5') {  ?><?php  echo $lang['tpure']['user_level_name']['5'];  ?><?php }else{  ?><?php  echo $lang['tpure']['user_level_name']['6'];  ?><?php } ?></span><?php } ?></h1>
                            <p<?php if ($author->Intro) { ?> title="<?php  echo $author->Intro;  ?>"<?php } ?>><?php  echo $author->Intro ? $author->Intro : $lang['tpure']['intronull'];  ?></p>
                            <span class="cate"> <?php  echo $author->Articles;  ?> <?php  echo $lang['tpure']['articles'];  ?></span>
                            <span class="cmt"> <?php  echo $author->Comments;  ?> <?php  echo $lang['tpure']['comments'];  ?></span>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="block<?php if ($zbp->Config('tpure')->PostBIGPOSTIMGON == '1') { ?> large<?php } ?>">
                    <?php  foreach ( $articles as $article) { ?>
                        <?php if ($article->IsTop) { ?>
                        <?php  include $this->GetTemplate('post-istop');  ?>
                        <?php }else{  ?>
                        <?php  include $this->GetTemplate('post-multi');  ?>
                        <?php } ?>
                    <?php }   ?>
                </div>
                <?php if ($pagebar && $pagebar->PageAll > 1) { ?>
                <div class="pagebar">
                    <?php  include $this->GetTemplate('pagebar');  ?>
                </div>
                <?php } ?>
            </div>
            <div class="sidebar<?php if ($zbp->Config('tpure')->PostFIXMENUON == '1') { ?> fixed<?php } ?>">
                <?php  include $this->GetTemplate('sidebar8');  ?>
            </div>
        </div>
    </div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
</body>
</html>