<?php  /* Template Name:公共底部 */  ?>
<?php  include $this->GetTemplate('footerad');  ?>
<div class="footer">
	<div class="fademask"></div>
    <div class="wrap">
        <h3><?php  echo $copyright;  ?></h3>
        <?php  echo $footer;  ?>
    </div>
</div>
<?php if ($zbp->Config('tpure')->PostSETNIGHTON) { ?><a class="setnight" href="javascript:;" target="_self"></a><?php } ?>