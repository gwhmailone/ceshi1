{* Template Name:公共底部 *}
{template:footerad}
<div class="footer">
	<div class="fademask"></div>
    <div class="wrap">
        <h3>{$copyright}</h3>
        {$footer}
    </div>
</div>
{if $zbp->Config('tpure')->PostSETNIGHTON}<a class="setnight" href="javascript:;" target="_self"></a>{/if}