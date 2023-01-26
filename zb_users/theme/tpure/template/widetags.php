{* Template Name:标签云无侧栏模板 *}
<!DOCTYPE html>
<html xml:lang="{$lang['lang_bcp47']}" lang="{$lang['lang_bcp47']}">
<head>
{template:header}
</head>
<body class="{$type}{if GetVars('night','COOKIE') } night{/if}">
<div class="wrapper">
    {template:navbar}
    <div class="main{if $zbp->Config('tpure')->PostFIXMENUON=='1'} fixed{/if}">
        {if $zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1'}
            <div class="banner" data-type="display" data-speed="2" style="
            {if !tpure_isMobile()}height:{$zbp->Config('tpure')->PostBANNERPCHEIGHT}px;{else}height:{$zbp->Config('tpure')->PostBANNERMHEIGHT}px;{/if}
            background-image:url({$zbp->Config('tpure')->PostBANNER});"><div class="wrap">{if $zbp->Config('tpure')->PostBANNERFONT}<h2>{$zbp->Config('tpure')->PostBANNERFONT}</h2>{/if}</div>
            </div>
        {/if}
        <div class="mask"></div>
        <div{if $zbp->Config('tpure')->PostFIXSIDEBARSTYLE=='0'} id="hcsticky"{/if} class="wrap">
            {if $zbp->Config('tpure')->PostSITEMAPON=='1'}
            <div class="sitemap">{$lang['tpure']['sitemap']}<a href="{$host}">{$lang['tpure']['index']}</a> &gt; 
                {if $type=='article'}{if is_object($article.Category) && $article.Category.ParentID}<a href="{$article.Category.Parent.Url}">{$article.Category.Parent.Name}</a> &gt;{/if} <a href="{$article.Category.Url}">{$article.Category.Name}</a> &gt; {/if}{$article.Title}
            </div>
            {/if}
            <div class="content wide">
                <div class="block">
                    <div class="post">
                        <h1>{$article.Title}</h1>
                        <div class="single">
                            {tpure_GetTagCloudList()}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{template:footer}
</body>
</html>