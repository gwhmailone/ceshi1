<?php  /* Template Name:列表页普通文章 */  ?>
<div class="post item">
    <h2><a href="<?php  echo $article->Url;  ?>"<?php if ($zbp->Config('tpure')->PostBLANKSTYLE == 2) { ?> target="_blank"<?php } ?>><?php if ($zbp->Config('tpure')->PostMEDIAICONSTYLE == '0') { ?><?php if ($article->Metas->audio) { ?><span class="zbaudio"></span><?php } ?><?php if ($article->Metas->video) { ?><span class="video"></span><?php } ?><?php } ?><?php  echo $article->Title;  ?><?php if ($zbp->Config('tpure')->PostMEDIAICONSTYLE == '1') { ?><?php if ($article->Metas->audio) { ?><span class="zbaudio"></span><?php } ?><?php if ($article->Metas->video) { ?><span class="video"></span><?php } ?><?php } ?></a></h2>
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
        $list_info = json_decode($zbp->Config('tpure')->PostLISTINFO,true);
        if(count((array)$list_info)){
            foreach($list_info as $key => $info){
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
    </div>
    <?php if (tpure_Thumb($article) != '') { ?><div class="postimg<?php if ($article->Metas->video) { ?> v<?php } ?>"><a href="<?php  echo $article->Url;  ?>"<?php if ($zbp->Config('tpure')->PostBLANKSTYLE == 2) { ?> target="_blank"<?php } ?>><img src="http://www.wode.com/zb_users/theme/tpure/style/images/lazyloading.gif" data-original="<?php  echo tpure_Thumb($article);  ?>" alt="<?php  echo $article->Title;  ?>" /></a></div><?php } ?>
    <div class="intro<?php if (tpure_Thumb($article) != '') { ?> isimg<?php } ?>">
        <?php if (tpure_isMobile()) { ?><a href="<?php  echo $article->Url;  ?>"><?php } ?>
            <?php if ($zbp->Config('tpure')->PostINTRONUM) { ?>
            <?php $intro = preg_replace('/[\r\n\s]+/', ' ', trim(SubStrUTF8(TransferHTML($article->Intro,'[nohtml]'),$zbp->Config('tpure')->PostINTRONUM)).'...'); ?>
            <?php if ($type==='search') { ?>
                <?php  $intro=preg_replace('/' . preg_quote(GetVars('q'),'/') . '/i',"<mark>$0</mark>",$intro);  ?>
            <?php } ?>
            <?php  echo $intro;  ?><?php }else{  ?><?php  echo $article->Intro;  ?><?php } ?>
        <?php if (tpure_isMobile()) { ?></a><?php } ?>
    </div>
    <?php if ($zbp->Config('tpure')->PostMOREBTNON) { ?><div><a href="<?php  echo $article->Url;  ?>"<?php if ($zbp->Config('tpure')->PostBLANKSTYLE == 2) { ?> target="_blank"<?php } ?> class="readmore"><?php  echo $lang['tpure']['viewmore'];  ?></a></div><?php } ?>
</div>