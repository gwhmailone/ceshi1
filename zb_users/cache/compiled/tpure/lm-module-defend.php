<li class="<?php  echo $id;  ?>-item">
<?php if ($id!=="link") { ?>
	<a href="<?php  echo $item->href;  ?>" target="<?php  echo $item->target;  ?>" title="<?php  echo $item->title;  ?>" rel="external nofollow"><?php  echo $item->ico;  ?><?php  echo $item->text;  ?></a>
	<?php if (count($item->subs)) { ?>
	<ul><?php  foreach ( $item->subs as $item) { ?><?php  include $this->GetTemplate('lm-module-defend');  ?><?php }   ?></ul>
	<?php } ?>
<?php }else{  ?>
	<a href="<?php  echo $item->href;  ?>" target="<?php  echo $item->target;  ?>" title="<?php  echo $item->title;  ?>"><?php  echo $item->ico;  ?><?php  echo $item->text;  ?></a>
	<?php if (count($item->subs)) { ?>
	<ul><?php  foreach ( $item->subs as $item) { ?><?php  include $this->GetTemplate('lm-module-defend');  ?><?php }   ?></ul>
  <?php } ?>
<?php } ?>
</li>