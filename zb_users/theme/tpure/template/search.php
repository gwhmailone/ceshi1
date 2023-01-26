{* Template Name:搜索页模板 *}
<!DOCTYPE html>
<html xml:lang="{$lang['lang_bcp47']}" lang="{$lang['lang_bcp47']}">
<head>
{template:header}
</head>
<body class="{$type}{if GetVars('night','COOKIE') } night{/if}">
<div class="wrapper">
    {template:navbar}
    <div class="main{if $zbp->Config('tpure')->PostFIXMENUON=='1'} fixed{/if}">
        <div class="mask"></div>
        <div{if $zbp->Config('tpure')->PostFIXSIDEBARSTYLE=='0'} id="hcsticky"{/if} class="wrap">
            {if $zbp->Config('tpure')->PostSITEMAPON=='1'}
            <div class="sitemap">{$lang['tpure']['sitemap']}<a href="{$host}">{$lang['tpure']['index']}</a> > {$title}
            </div>
            {/if}
			{if $zbp->Config('tpure')->PostBANNERON == '1'}
        		<div class="banner" data-type="display" data-speed="2" style="
        {if tpure_isMobile()}height:{$zbp->Config('tpure')->PostBANNERPCHEIGHT}px;{else}height:{$zbp->Config('tpure')->PostBANNERMHEIGHT}px;{/if}">
			<a href="{$zbp->Config('tpure')->PostBANNERURL}" rel="external nofollow"><img src="{$zbp->Config('tpure')->PostBANNER}" alt="banner" /></a>
        </div>
				<br>
			{/if}
            <div class="content listcon">
				{php}$slidedata = json_decode($zbp->Config('tpure')->PostSLIDEDATA,true);{/php}
                    {if $zbp->Config('tpure')->PostSLIDEON == '1' && $zbp->Config('tpure')->PostSLIDEPLACE == '0' && count((array)$slidedata)>0}
                    <div class="slideblock">
                    <div class="slide swiper-container">
                        <div class="swiper-wrapper">
                            {if isset($slidedata)}
                            {foreach $slidedata as $value}
                                {if $value['isused']}
                                    <a href="{$value['url']}" rel="external nofollow"{if $zbp->Config('tpure')->PostBLANKSTYLE == 2} target="_blank"{/if} class="swiper-slide" style="background-color:#{$value['color']};"><img src="{$value['img']}" alt="{$value['title']}" /></a>
                                {/if}
                            {/foreach}
                            {/if}
                        </div>
                        {if count((array)$slidedata) > 1}
                            {if $zbp->Config('tpure')->PostSLIDEPAGEON == '1'}
                            <div class="swiper-pagination"></div>
                            {/if}
                            {if $zbp->Config('tpure')->PostSLIDEBTNON == '1'}
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                            {/if}
                        {/if}
                    </div>
                    </div>
                    {/if}
                <div class="block{if $zbp->Config('tpure')->PostBIGPOSTIMGON=='1'} large{/if}">
                    {if count((array)$articles)}
                        {foreach $articles as $article}
                        {template:post-multi}
                        {/foreach}
                    {else}
                        <div class="searchnull">{$lang['tpure']['searchnulltip']} <a href="https://www.baidu.com/s?wd={$_GET['q']}" target="_blank" rel="nofollow">{$_GET['q']}</a> {$lang['tpure']['searchnullcon']}</div>
                    {/if}
                </div>
                {if $pagebar && $pagebar.PageAll > 1}
                <div class="pagebar">
                    {template:pagebar}
                </div>
                {/if}
            </div>
            <div class="sidebar{if $zbp->Config('tpure')->PostFIXMENUON=='1'} fixed{/if}">
                {template:sidebar5}
            </div>
        </div>
    </div>
</div>
{template:footer}
</body>
</html>