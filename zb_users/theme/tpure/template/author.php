{* Template Name:用户文章列表模板 *}
<!DOCTYPE html>
<html xml:lang="{$lang['lang_bcp47']}" lang="{$lang['lang_bcp47']}">
<head>
{template:header}
</head>
<body class="{$type}{if GetVars('night','COOKIE') } night{/if}">
<div class="wrapper">
    {template:navbar}
    <div class="main{if $zbp->Config('tpure')->PostFIXMENUON == '1'} fixed{/if}">
        {if $zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1'}
            <div class="banner" data-type="display" data-speed="2" style="
            {if !tpure_isMobile()}height:{$zbp->Config('tpure')->PostBANNERPCHEIGHT}px;{else}height:{$zbp->Config('tpure')->PostBANNERMHEIGHT}px;{/if}
            background-image:url({$zbp->Config('tpure')->PostBANNER});"><div class="wrap">{if $zbp->Config('tpure')->PostBANNERFONT}<h2>{$zbp->Config('tpure')->PostBANNERFONT}</h2>{/if}</div>
            </div>
        {/if}
        <div class="mask"></div>
        <div{if $zbp->Config('tpure')->PostFIXSIDEBARSTYLE == '0'} id="hcsticky"{/if} class="wrap">
            {if $zbp->Config('tpure')->PostSITEMAPON == '1'}
            <div class="sitemap">{$lang['tpure']['sitemap']}<a href="{$host}">{$lang['tpure']['index']}</a>
{if $type=='category'}
{php}
$html='';
function tpure_navcate($id){
   global $html;
   $cate = new Category;
   $cate->LoadInfoByID($id);
   $html = ' &gt; <a href="' .$cate->Url.'" title="查看' .$cate->Name. '中的全部文章">' .$cate->Name. '</a> '.$html;
   if(($cate->ParentID)>0){tpure_navcate($cate->ParentID);}
}
tpure_navcate($category->ID);
global $html;
echo $html;
{/php}
{else}
> {$title}
{/if}
            </div>
            {/if}
            <div class="content listcon">
                {if $type == 'author'}
                <div class="block">
                    <div class="auth">
                        <div class="authimg">
                            {if $author.Metas.memberimg}
                                <img src="{$author.Metas.memberimg}" alt="{$author.StaticName}" />
                            {else}
                                <img src="{tpure_MemberAvatar($author)}" alt="{$author.StaticName}" />
                            {/if}
                            <em class="sex{if $author.Metas.membersex == '2'} female{else} male{/if}"></em>
                        </div>
                        <div class="authinfo">
                            <h1>{$author.StaticName} {if $type == 'author'}<span class="level">{if $author.Level == '1'}{$lang['tpure']['user_level_name']['1']}{elseif $author.Level == '2'}{$lang['tpure']['user_level_name']['2']}{elseif $author.Level == '3'}{$lang['tpure']['user_level_name']['3']}{elseif $author.Level == '4'}{$lang['tpure']['user_level_name']['4']}{elseif $author.Level == '5'}{$lang['tpure']['user_level_name']['5']}{else}{$lang['tpure']['user_level_name']['6']}{/if}</span>{/if}</h1>
                            <p{if $author.Intro} title="{$author.Intro}"{/if}>{$author.Intro ? $author.Intro : $lang['tpure']['intronull']}</p>
                            <span class="cate"> {$author.Articles} {$lang['tpure']['articles']}</span>
                            <span class="cmt"> {$author.Comments} {$lang['tpure']['comments']}</span>
                        </div>
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
            </div>
            <div class="sidebar{if $zbp->Config('tpure')->PostFIXMENUON == '1'} fixed{/if}">
                {template:sidebar8}
            </div>
        </div>
    </div>
</div>
{template:footer}
</body>
</html>