<?php  /* Template Name:搜索页模板 */  ?>
<!DOCTYPE html>
<html xml:lang="<?php  echo $lang['lang_bcp47'];  ?>" lang="<?php  echo $lang['lang_bcp47'];  ?>">
<head>
<?php  include $this->GetTemplate('header');  ?>
</head>
<body class="<?php  echo $type;  ?><?php if (GetVars('night','COOKIE') ) { ?> night<?php } ?>">
<div class="wrapper">
    <?php  include $this->GetTemplate('navbar');  ?>
    <div class="main<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
        <div class="mask"></div>
        <div<?php if ($zbp->Config('tpure')->PostFIXSIDEBARSTYLE=='0') { ?> id="hcsticky"<?php } ?> class="wrap">
            <?php if ($zbp->Config('tpure')->PostSITEMAPON=='1') { ?>
            <div class="sitemap"><?php  echo $lang['tpure']['sitemap'];  ?><a href="<?php  echo $host;  ?>"><?php  echo $lang['tpure']['index'];  ?></a> > <?php  echo $title;  ?>
            </div>
            <?php } ?>
			<?php if ($zbp->Config('tpure')->PostBANNERON == '1') { ?>
        		<div class="banner" data-type="display" data-speed="2" style="
        <?php if (tpure_isMobile()) { ?>height:<?php  echo $zbp->Config('tpure')->PostBANNERPCHEIGHT;  ?>px;<?php }else{  ?>height:<?php  echo $zbp->Config('tpure')->PostBANNERMHEIGHT;  ?>px;<?php } ?>">
			<a href="<?php  echo $zbp->Config('tpure')->PostBANNERURL;  ?>" rel="external nofollow"><img src="<?php  echo $zbp->Config('tpure')->PostBANNER;  ?>" alt="banner" /></a>
        </div>
				<br>
			<?php } ?>
            <div class="content listcon">
				<?php $slidedata = json_decode($zbp->Config('tpure')->PostSLIDEDATA,true); ?>
                    <?php if ($zbp->Config('tpure')->PostSLIDEON == '1' && $zbp->Config('tpure')->PostSLIDEPLACE == '0' && count((array)$slidedata)>0) { ?>
                    <div class="slideblock">
                    <div class="slide swiper-container">
                        <div class="swiper-wrapper">
                            <?php if (isset($slidedata)) { ?>
                            <?php  foreach ( $slidedata as $value) { ?>
                                <?php if ($value['isused']) { ?>
                                    <a href="<?php  echo $value['url'];  ?>" rel="external nofollow"<?php if ($zbp->Config('tpure')->PostBLANKSTYLE == 2) { ?> target="_blank"<?php } ?> class="swiper-slide" style="background-color:#<?php  echo $value['color'];  ?>;"><img src="<?php  echo $value['img'];  ?>" alt="<?php  echo $value['title'];  ?>" /></a>
                                <?php } ?>
                            <?php }   ?>
                            <?php } ?>
                        </div>
                        <?php if (count((array)$slidedata) > 1) { ?>
                            <?php if ($zbp->Config('tpure')->PostSLIDEPAGEON == '1') { ?>
                            <div class="swiper-pagination"></div>
                            <?php } ?>
                            <?php if ($zbp->Config('tpure')->PostSLIDEBTNON == '1') { ?>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    </div>
                    <?php } ?>
                <div class="block<?php if ($zbp->Config('tpure')->PostBIGPOSTIMGON=='1') { ?> large<?php } ?>">
                    <?php if (count((array)$articles)) { ?>
                        <?php  foreach ( $articles as $article) { ?>
                        <?php  include $this->GetTemplate('post-multi');  ?>
                        <?php }   ?>
                    <?php }else{  ?>
                        <div class="searchnull"><?php  echo $lang['tpure']['searchnulltip'];  ?> <a href="https://www.baidu.com/s?wd=<?php  echo $_GET['q'];  ?>" target="_blank" rel="nofollow"><?php  echo $_GET['q'];  ?></a> <?php  echo $lang['tpure']['searchnullcon'];  ?></div>
                    <?php } ?>
                </div>
                <?php if ($pagebar && $pagebar->PageAll > 1) { ?>
                <div class="pagebar">
                    <?php  include $this->GetTemplate('pagebar');  ?>
                </div>
                <?php } ?>
            </div>
            <div class="sidebar<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
                <?php  include $this->GetTemplate('sidebar5');  ?>
            </div>
        </div>
    </div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
</body>
</html>