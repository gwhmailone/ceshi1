<?php  /* Template Name:读者墙TOP100模板 */  ?>
<!DOCTYPE html>
<html xml:lang="<?php  echo $lang['lang_bcp47'];  ?>" lang="<?php  echo $lang['lang_bcp47'];  ?>">
<head>
<?php  include $this->GetTemplate('header');  ?>
</head>
<body class="<?php  echo $type;  ?><?php if (GetVars('night','COOKIE') ) { ?> night<?php } ?>">
<div class="wrapper">
    <?php  include $this->GetTemplate('navbar');  ?>
    <div class="main<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
        <?php if ($zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1') { ?>
            <div class="banner" data-type="display" data-speed="2" style="
            <?php if (!tpure_isMobile()) { ?>height:<?php  echo $zbp->Config('tpure')->PostBANNERPCHEIGHT;  ?>px;<?php }else{  ?>height:<?php  echo $zbp->Config('tpure')->PostBANNERMHEIGHT;  ?>px;<?php } ?>
            background-image:url(<?php  echo $zbp->Config('tpure')->PostBANNER;  ?>);"><div class="wrap"><?php if ($zbp->Config('tpure')->PostBANNERFONT) { ?><h2><?php  echo $zbp->Config('tpure')->PostBANNERFONT;  ?></h2><?php } ?></div>
            </div>
        <?php } ?>
        <div class="mask"></div>
        <div<?php if ($zbp->Config('tpure')->PostFIXSIDEBARSTYLE=='0') { ?> id="hcsticky"<?php } ?> class="wrap">
            <?php if ($zbp->Config('tpure')->PostSITEMAPON=='1') { ?>
            <div class="sitemap"><?php  echo $lang['tpure']['sitemap'];  ?><a href="<?php  echo $host;  ?>"><?php  echo $lang['tpure']['index'];  ?></a> &gt; 
                <?php if ($type=='article') { ?><?php if (is_object($article->Category) && $article->Category->ParentID) { ?><a href="<?php  echo $article->Category->Parent->Url;  ?>"><?php  echo $article->Category->Parent->Name;  ?></a> &gt;<?php } ?> <a href="<?php  echo $article->Category->Url;  ?>"><?php  echo $article->Category->Name;  ?></a> &gt; <?php } ?><?php  echo $article->Title;  ?>
            </div>
            <?php } ?>
            <div class="content">
                <div class="block">
                    <div class="post">
                        <h1><?php  echo $article->Title;  ?></h1>
                        <div class="single">
                            <?php  echo $article->Content;  ?>
                            <div class="readers">
                                <ul>
<?php  $readersnum = $zbp->Config('tpure')->PostREADERSNUM ? $zbp->Config('tpure')->PostREADERSNUM : 100;  ?>
<?php  foreach ( tpure_readers($readersnum) as $key => $value) { ?>
<?php if ($key < 3) { ?>
<li class="top">
    <span class="honor"><?php if ($key == 0) { ?>金牌读者<?php }elseif($key == 1) {  ?>银牌读者<?php }elseif($key == 2) {  ?>铜牌读者<?php } ?></span>
    <?php if ($value['url']) { ?><a href="<?php  echo $value['url'];  ?>" target="_blank" rel="nofollow"><?php } ?>
    <span class="readersimg"><img src="<?php  echo tpure_MemberAvatar($value['member'],$value['email']);  ?>" alt="<?php  echo $value['name'];  ?>"></span>
    <span class="readersinfo"><span><?php  echo $value['name'];  ?></span>评论 <?php  echo $value['count'];  ?> 次</span>
    <?php if ($value['url']) { ?></a><?php } ?>
</li>
<?php }else{  ?>
<li>
    <?php if ($value['url']) { ?><a href="<?php  echo $value['url'];  ?>" target="_blank" rel="nofollow"><?php } ?>
    <span class="readersimg"><img src="<?php  echo tpure_MemberAvatar($value['member'],$value['email']);  ?>" alt="<?php  echo $value['name'];  ?>"></span>
    <span class="readersinfo"><span><?php  echo $value['name'];  ?></span>评论 <?php  echo $value['count'];  ?> 次</span>
    <?php if ($value['url']) { ?></a><?php } ?>
</li>
<?php } ?>
<?php }   ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sidebar<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
                <?php  include $this->GetTemplate('sidebar9');  ?>
            </div>
        </div>
    </div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
</body>
</html>