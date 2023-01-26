<div class="content">
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
    <div data-cateurl="{if $type=='article' && is_object($article.Category)}{if $article.Category.ParentID}{$article.Category.Parent.Url}{else}{$article.Category.Url}{/if}{/if}" class="block">
        <div class="post">
            <h1>{$article.Title}</h1>
            <div class="info">
                {php}
                $post_info = array(
                    'user'=>'<a href="'.$article->Author->Url.'" rel="nofollow">'.$article->Author->StaticName.'</a>',
                    'date'=>tpure_TimeAgo($article->Time()),
                    'cate'=>'<a href="'.$article->Category->Url.'">'.$article->Category->Name.'</a>',
                    'view'=>$article->ViewNums,
                    'cmt'=>$article->CommNums,
                    'edit'=>'<a href="'.$host.'zb_system/cmd.php?act=ArticleEdt&id='.$article->ID.'" target="_blank">'.$lang['tpure']['edit'].'</a>',
                    'del'=>'<a href="'.$host.'zb_system/cmd.php?act=ArticleDel&id='.$article->ID.'&csrfToken='.$zbp->GetToken().'" data-confirm="'.$lang['tpure']['delconfirm'].'">'.$lang['tpure']['del'].'</a>',
                );
                $article_info = json_decode($zbp->Config('tpure')->PostARTICLEINFO,true);
                if(count((array)$article_info)){
                    foreach($article_info as $key => $info){
                        if($info == '1'){
                            if($user->Level == '1'){
                                echo '<span class="'.$key.'">'.$post_info[$key].'</span>';
                            }else{
                                if($key == 'edit' || $key == 'del'){
                                    echo '';
                                }else{
                                    echo '<span class="'.$key.'">'.$post_info[$key].'</span>';
                                }
                            }
                        }
                    }
                }else{
                    echo '<span class="user"><a href="'.$article->Author->Url.'" rel="nofollow">'.$article->Author->StaticName.'</a></span>
                    <span class="date">'.tpure_TimeAgo($article->Time()).'</span>
                    <span class="view">'.$article->ViewNums.'</span>';
                }
                {/php}
                {if $zbp->Config('tpure')->PostTFONTSIZEON == '1'}
                <div class="ctrl"><a href="javascript:;" title="{$lang['tpure']['bigfont']}"></a><a href="javascript:;" title="{$lang['tpure']['smallfont']}"></a><a href="javascript:;" title="{$lang['tpure']['refont']}" class="hide"></a></div>
                {/if}
            </div>
            <div class="single{if (($type=='article' && $zbp->Config('tpure')->PostVIEWALLSINGLEON)||($type=='page' && $zbp->Config('tpure')->PostVIEWALLPAGEON))} viewall{/if}{if $zbp->Config('tpure')->PostINDENTON == '1'} indent{/if}">
                {$article.Content}
                </div>
                {if ($zbp->Config('tpure')->PostCOPYNOTICEON && !tpure_isMobile()) || ($zbp->Config('tpure')->PostCOPYNOTICEON && $zbp->Config('tpure')->PostCOPYNOTICEMOBILEON == '0' && tpure_isMobile())}
                <div class="copynotice">
                    {if $zbp->Config('tpure')->PostQRON == '1'}<div data-qrurl="{$zbp.fullcurrenturl}" class="tpureqr"></div>{/if}
                    <div class="copynoticetxt">
                    {$zbp->Config('tpure')->PostCOPYNOTICE}
                    {if $zbp->Config('tpure')->PostCOPYURLON == '1'}<p>{$lang['tpure']['copynoticetip']}<a href="{$zbp.fullcurrenturl}">{urldecode($zbp.fullcurrenturl)}</a></p>{/if}
                    </div>
                </div>
                {/if}
                {if count($article.Tags)>0 && $zbp->Config('tpure')->PostTAGSON == '1'}
                <div class="tags">
                    {$lang['tpure']['tags']}
                    {foreach $article.Tags as $tag}<a href='{$tag.Url}' title='{$tag.Name}'>{$tag.Name}</a>{/foreach}
                </div>
                {/if}
            
{if $type == 'article' && $zbp->Config('tpure')->PostSHAREARTICLEON == '1'}
        <div class="sharebox">
            <div class="label">{$lang['tpure']['sharelabel']}：</div>
            <div class="sharebtn">
                <div class="sharing" data-initialized="true">
                    {$zbp->Config('tpure')->PostSHARE}
                </div>
            </div>
        </div>
{/if}
        </div>
{if $type == 'article' && $zbp->Config('tpure')->PostPREVNEXTON == '1'}
        <div class="pages">
            <a href="{$article.Category.Url}" class="backlist">{$lang['tpure']['backlist']}</a>
            <p>{if $article.Prev}{$lang['tpure']['prev']}<a href="{$article.Prev.Url}" class="single-prev">{$article.Prev.Title}</a>{else}<span>{$lang['tpure']['noprev']}</span>{/if}</p>
            <p>{if $article.Next}{$lang['tpure']['next']}<a href="{$article.Next.Url}" class="single-next">{$article.Next.Title}</a>{else}<span>{$lang['tpure']['nonext']}</span>{/if}</p>
        </div>
{/if}
    </div>
{template:mutuality}
{$header}
{if !$article.IsLock && $zbp->Config('tpure')->PostARTICLECMTON=='1'}
    {template:comments}
{/if}
</div>
<div class="sidebar{if $zbp->Config('tpure')->PostFIXMENUON=='1'} fixed{/if}">
    {template:sidebar3}
</div>