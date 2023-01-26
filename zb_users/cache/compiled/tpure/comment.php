<label id="cmt<?php  echo $comment->ID;  ?>"></label><div class="cmtsitem">
    <?php if ($comment->Author->HomePage) { ?><a href="<?php  echo $comment->Author->HomePage;  ?>" rel="nofollow" class="avatar"><img src="<?php  echo tpure_MemberAvatar($comment->Author);  ?>" alt="<?php  echo $comment->Author->StaticName;  ?>" /></a><?php }else{  ?><span class="avatar"><img src="<?php  echo tpure_MemberAvatar($comment->Author);  ?>" alt="<?php  echo $comment->Author->StaticName;  ?>" /></span><?php } ?>
    <div class="cmtscon">
        <div class="cmtshead">
            <div class="cmtsname"><?php if ($comment->Author->HomePage) { ?><a href="<?php  echo $comment->Author->HomePage;  ?>" rel="nofollow" target="_blank"><?php  echo $comment->Author->StaticName;  ?></a><?php }else{  ?><?php  echo $comment->Author->StaticName;  ?><?php } ?></div>
            <div class="cmtsdate"><?php  echo tpure_TimeAgo($comment->Time());  ?></div>
        </div>
        <div class="cmtsbody" data-commentid="<?php  echo $comment->ID;  ?>"><p><?php  echo $comment->Content;  ?></p></div>
        <?php  foreach ( $comment->Comments as $comment) { ?>
            <?php  include $this->GetTemplate('commentreply');  ?>
        <?php }   ?>
        <div class="cmtsfoot"><a href="#comment" onclick="zbp.comment.reply(<?php if ($comment->RootID) { ?><?php  echo $comment->RootID;  ?><?php }else{  ?><?php  echo $comment->ID;  ?><?php } ?>)" class="reply"><?php  echo $lang['tpure']['reply'];  ?></a></div>
    </div>
</div>