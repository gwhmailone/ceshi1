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
    <div data-cateurl="<?php if ($type=='article' && is_object($article->Category)) { ?><?php if ($article->Category->ParentID) { ?><?php  echo $article->Category->Parent->Url;  ?><?php }else{  ?><?php  echo $article->Category->Url;  ?><?php } ?><?php } ?>" class="block">
        <div class="post">
            <h1><?php  echo $article->Title;  ?></h1>
            <div class="info">
                <?php 
                $post_info = array(
                    'user'=>'<a href="'.$article->Author->Url.'" rel="nofollow">'.$article->Author->StaticName.'</a>',
                    'date'=>tpure_TimeAgo($article->Time()),
                    'cate'=>'<a href="'.$article->Category->Url.'">'.$article->Category->Name.'</a>',
                    'view'=>$article->ViewNums,
                    'cmt'=>$article->CommNums,
                    'edit'=>'<a href="'.$host.'zb_system/cmd.php?act=ArticleEdt&id='.$article->ID.'" target="_blank">'.$lang['tpure']['edit'].'</a>',
                    'del'=>'<a href="'.$host.'zb_system/cmd.php?act=ArticleDel&id='.$article->ID.'&csrfToken='.$zbp->GetToken().'" data-confirm="'.$lang['tpure']['delconfirm'].'">'.$lang['tpure']['del'].'</a>',
                );
                $article_info = json_decode($zbp->Config('tpure')->PostARTICLEINFO,true);
                if(count((array)$article_info)){
                    foreach($article_info as $key => $info){
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
                <?php if (($zbp->Config('tpure')->PostCOPYNOTICEON && !tpure_isMobile()) || ($zbp->Config('tpure')->PostCOPYNOTICEON && $zbp->Config('tpure')->PostCOPYNOTICEMOBILEON == '0' && tpure_isMobile())) { ?>
                <div class="copynotice">
                    <?php if ($zbp->Config('tpure')->PostQRON == '1') { ?><div data-qrurl="<?php  echo $zbp->fullcurrenturl;  ?>" class="tpureqr"></div><?php } ?>
                    <div class="copynoticetxt">
                    <?php  echo $zbp->Config('tpure')->PostCOPYNOTICE;  ?>
                    <?php if ($zbp->Config('tpure')->PostCOPYURLON == '1') { ?><p><?php  echo $lang['tpure']['copynoticetip'];  ?><a href="<?php  echo $zbp->fullcurrenturl;  ?>"><?php  echo urldecode($zbp->fullcurrenturl);  ?></a></p><?php } ?>
                    </div>
                </div>
                <?php } ?>
                <?php if (count($article->Tags)>0 && $zbp->Config('tpure')->PostTAGSON == '1') { ?>
                <div class="tags">
                    <?php  echo $lang['tpure']['tags'];  ?>
                    <?php  foreach ( $article->Tags as $tag) { ?><a href='<?php  echo $tag->Url;  ?>' title='<?php  echo $tag->Name;  ?>'><?php  echo $tag->Name;  ?></a><?php }   ?>
                </div>
                <?php } ?>
            
<?php if ($type == 'article' && $zbp->Config('tpure')->PostSHAREARTICLEON == '1') { ?>
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
<?php if ($type == 'article' && $zbp->Config('tpure')->PostPREVNEXTON == '1') { ?>
        <div class="pages">
            <a href="<?php  echo $article->Category->Url;  ?>" class="backlist"><?php  echo $lang['tpure']['backlist'];  ?></a>
            <p><?php if ($article->Prev) { ?><?php  echo $lang['tpure']['prev'];  ?><a href="<?php  echo $article->Prev->Url;  ?>" class="single-prev"><?php  echo $article->Prev->Title;  ?></a><?php }else{  ?><span><?php  echo $lang['tpure']['noprev'];  ?></span><?php } ?></p>
            <p><?php if ($article->Next) { ?><?php  echo $lang['tpure']['next'];  ?><a href="<?php  echo $article->Next->Url;  ?>" class="single-next"><?php  echo $article->Next->Title;  ?></a><?php }else{  ?><span><?php  echo $lang['tpure']['nonext'];  ?></span><?php } ?></p>
        </div>
<?php } ?>
    </div>
<?php  include $this->GetTemplate('mutuality');  ?>
<?php  echo $header;  ?>
<?php if (!$article->IsLock && $zbp->Config('tpure')->PostARTICLECMTON=='1') { ?>
    <?php  include $this->GetTemplate('comments');  ?>
<?php } ?>
</div>
<div class="sidebar<?php if ($zbp->Config('tpure')->PostFIXMENUON=='1') { ?> fixed<?php } ?>">
    <?php  include $this->GetTemplate('sidebar3');  ?>
</div>