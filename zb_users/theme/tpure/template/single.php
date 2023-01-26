{* Template Name:文章页/单页模板 *}
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
            <div class="sitemap">{$lang['tpure']['sitemap']}<a href="{$host}">{$lang['tpure']['index']}</a> &gt; 
                {if $type=='article'}{if is_object($article.Category) && $article.Category.ParentID}<a href="{$article.Category.Parent.Url}">{$article.Category.Parent.Name}</a> &gt; {/if} <a href="{$article.Category.Url}">{$article.Category.Name}</a> &gt; {if $zbp->Config('tpure')->PostSITEMAPSTYLE == '1'}{$article.Title}{else}{$lang['tpure']['text']}{/if}{elseif $type=='page'}{$article.Title}{/if}
            </div>
			{/if}
			{if $zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1'}
            <div class="banner" data-type="display" data-speed="2" style="
        {if tpure_isMobile()}height:{$zbp->Config('tpure')->PostBANNERPCHEIGHT}px;{else}height:{$zbp->Config('tpure')->PostBANNERMHEIGHT}px;{/if}">
			<a href="{$zbp->Config('tpure')->PostBANNERURL}" rel="external nofollow"><img src="{$zbp->Config('tpure')->PostBANNER}" alt="banner" /></a>
        </div>
			<br>
        	{/if}
            {if $article.Type==ZC_POST_TYPE_ARTICLE}
                {template:post-single}
            {else}
                {template:post-page}
            {/if}
        </div>
    </div>
</div>
{template:footer}
</body>
</html>