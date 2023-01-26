<div class="content">
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
    <div class="block">
        <div class="post">
            <h1 align="center"><?php  echo $article->Title;  ?></h1>
            <div class="info">
                <?php 
                $post_info = array(
                    'user'=>'<a href="'.$article->Author->Url.'" rel="nofollow">'.$article->Author->StaticName.'</a>',
                    'date'=>tpure_TimeAgo($article->Time()),
                    'view'=>$article->ViewNums,
                    'cmt'=>$article->CommNums,
                    'edit'=>'<a href="'.$host.'zb_system/cmd.php?act=PageEdt&id='.$article->ID.'" target="_blank">'.$lang['tpure']['edit'].'</a>',
                    'del'=>'<a href="'.$host.'zb_system/cmd.php?act=PageDel&id='.$article->ID.'&csrfToken='.$zbp->GetToken().'" data-confirm="'.$lang['tpure']['delconfirm'].'">'.$lang['tpure']['del'].'</a>',
                );
                $page_info = json_decode($zbp->Config('tpure')->PostPAGEINFO,true);
                if(count((array)$page_info)){
                    foreach($page_info as $key => $info){
                        if($info == '1'){
                            if($user->Level == '1'){
                                echo '<span class="'.$key.'">'.$post_info[$key].'</span>';
                            }else{
                                if($key == 'edit' || $key == 'del'){
                                    echo '';
                                }else{
                                    echo '<span class="'.$key.'">'.$post_info[$key].'</span>';
                                }
                            }
                        }
                    }
                }else{
                    echo '<span class="user"><a href="'.$article->Author->Url.'" rel="nofollow">'.$article->Author->StaticName.'</a></span>
                    <span class="date">'.tpure_TimeAgo($article->Time()).'</span>
                    <span class="view">'.$article->ViewNums.'</span>';
                }
                 ?>
                <?php if ($zbp->Config('tpure')->PostTFONTSIZEON == '1') { ?>
                <div class="ctrl"><a href="javascript:;" title="<?php  echo $lang['tpure']['bigfont'];  ?>"></a><a href="javascript:;" title="<?php  echo $lang['tpure']['smallfont'];  ?>"></a><a href="javascript:;" title="<?php  echo $lang['tpure']['refont'];  ?>" class="hide"></a></div>
                <?php } ?>
            </div>
            <div class="single<?php if ((($type=='article' && $zbp->Config('tpure')->PostVIEWALLSINGLEON)||($type=='page' && $zbp->Config('tpure')->PostVIEWALLPAGEON))) { ?> viewall<?php } ?><?php if ($zbp->Config('tpure')->PostINDENTON == '1') { ?> indent<?php } ?>">
                <?php  echo $article->Content;  ?>
            </div>
<?php if ($type == 'page' && $zbp->Config('tpure')->PostSHAREPAGEON == '1') { ?>
        <div class="sharebox">
            <div class="label"><?php  echo $lang['tpure']['sharelabel'];  ?>：</div>
            <div class="sharebtn">
                <div class="sharing" data-initialized="true">
                    <?php  echo $zbp->Config('tpure')->PostSHARE;  ?>
                </div>
            </div>
        </div>
<?php } ?>
        </div>
    </div>
<?php if (!$article->IsLock && $zbp->Config('tpure')->PostPAGECMTON=='1') { ?>
    <?php  include $this->GetTemplate('comments');  ?>
<?php } ?>
</div>
<div class="sidebar<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
    <?php  include $this->GetTemplate('sidebar4');  ?>
</div>