<?php  /* Template Name:列表页模板 */  ?>
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
			<?php if ($zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1') { ?>
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
                    <?php if ($type=='category' && $zbp->Config('tpure')->PostFILTERON == '1') { ?>
                    <div class="filternav">
                        <form id="filternav">
                            <h1><?php  echo $category->Name;  ?></h1>
                            <ul class="filter">
                                <li<?php if (GetVars('order','GET') == 'newlist' || !GetVars('order','GET')) { ?> class="active"<?php } ?> data-type="newlist">
                                    最新<i class="<?php if (GetVars('sort','GET')) { ?>up<?php }else{  ?>down<?php } ?>"></i>
                                </li>
                                <li<?php if (GetVars('order','GET') == 'viewlist') { ?> class="active"<?php } ?> data-type="viewlist">
                                    浏览<i class="<?php if (GetVars('sort','GET')) { ?>up<?php }else{  ?>down<?php } ?>"></i>
                                </li>
                                <li<?php if (GetVars('order','GET') == 'cmtlist') { ?> class="active"<?php } ?> data-type="cmtlist">
                                    评论<i class="<?php if (GetVars('sort','GET')) { ?>up<?php }else{  ?>down<?php } ?>"></i>
                                </li>
                            </ul>
                            <?php if ($zbp->Config('system')->ZC_STATIC_MODE != 'REWRITE') { ?><input type="hidden" name="cate" value="<?php  echo $category->ID;  ?>"><?php } ?>
                            <input type="hidden" name="order" value="<?php  echo GetVars('order','GET');  ?>">
                            <input type="hidden" name="sort" value="<?php echo (int)GetVars('sort','GET') ?>">
                        </form>
                    </div>
<script>
    !function(f){
  var a=f.find('li'),o=f.find('[name=order]'),s=f.find('[name=sort]');
  a.click(function(){
     var v=$(this).data('type');
      if(v===o.val()){
      s.val(s.val().toString()==='1'?0:1);
    }else{
      s.val(''===o.val() && !$(this).index() ? 1 : 0);
      o.val(v);
    }
    f.submit();
    return false;
  })
}($('#filternav'));
</script>
                    <?php } ?>
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
            <div class="sidebar<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
                <?php  include $this->GetTemplate('sidebar2');  ?>
            </div>
        </div>
    </div>
</div>
<?php  include $this->GetTemplate('footer');  ?>
</body>
</html>