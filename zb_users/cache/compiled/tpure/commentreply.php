<div class="cmtsreply">
    <div class="cmtsreplyname"><?php if ($comment->Author->HomePage) { ?><a href="<?php  echo $comment->Author->HomePage;  ?>" rel="nofollow" target="_blank"><?php  echo $comment->Author->StaticName;  ?></a><?php }else{  ?><?php  echo $comment->Author->StaticName;  ?><?php } ?> <?php  echo $lang['tpure']['replytxt'];  ?></div>
    <div class="cmtsreplycon"><?php  echo $comment->Content;  ?></div>
    <div class="cmtsreplydate"><?php  echo tpure_TimeAgo($comment->Time());  ?></div>
</div>
<?php  foreach ( $comment->Comments as $comment) { ?>
    <?php  include $this->GetTemplate('commentreply');  ?>
<?php }   ?>