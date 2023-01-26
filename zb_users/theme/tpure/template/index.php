{* Template Name:首页 *}
<!DOCTYPE html>
<html xml:lang="{$lang['lang_bcp47']}" lang="{$lang['lang_bcp47']}">
<head>
{template:header}
</head>
<body class="{$type}{if GetVars('night','COOKIE') } night{/if}">
<div class="wrapper">
    {template:navbar}
    <div class="main{if $zbp->Config('tpure')->PostFIXMENUON == '1'} fixed{/if}">
        <div class="indexcon">
            <div{if $zbp->Config('tpure')->PostFIXSIDEBARSTYLE == '0'} id="hcsticky"{/if} class="wrap">
				<div class="sitemap">{$lang['tpure']['sitemap']}<a href="{$host}">{$lang['tpure']['index']}</a> &gt; 
                {if $type=='article'}{if is_object($article.Category) && $article.Category.ParentID}<a href="{$article.Category.Parent.Url}">{$article.Category.Parent.Name}</a> &gt; {/if} <a href="{$article.Category.Url}">{$article.Category.Name}</a> &gt; {if $zbp->Config('tpure')->PostSITEMAPSTYLE == '1'}{$article.Title}{else}{$lang['tpure']['text']}{/if}{elseif $type=='page'}{$article.Title}{/if}
            	</div>
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
                    <div class="block{if $zbp->Config('tpure')->PostBIGPOSTIMGON == '1'} large{/if}">
                        {foreach $articles as $article}
                            {if $article.IsTop}
                            {template:post-istop}
                            {else}
                            {template:post-multi}
                            {/if}
                        {/foreach}
                    </div>
                    {if $pagebar && $pagebar.PageAll > 1}
                    <div class="pagebar">
                        {template:pagebar}
                    </div>
                    {/if}
                    {if $type == 'index' && $page == '1' && $zbp->Config('tpure')->PostFRIENDLINKON == '1' && !tpure_isMobile()}
                        <div class="friendlink">
                            <span>{$lang['tpure']['friendlink']}</span>
                            <ul>{module:link}</ul>
                        </div>
                        {elseif tpure_isMobile() && $zbp->Config('tpure')->PostFRIENDLINKMON == '1'}
                        <div class="friendlink">
                            <span>{$lang['tpure']['friendlink']}</span>
                            <ul>{module:link}</ul>
                        </div>
                    {/if}
                </div>
                <div class="sidebar{if $zbp->Config('tpure')->PostFIXMENUON == '1'} fixed{/if}">
                    {template:sidebar}
                </div>
            </div>
        </div>
    </div>
</div>
{template:footer}
</body>
</html>