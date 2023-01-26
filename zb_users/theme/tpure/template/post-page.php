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
    <div class="block">
        <div class="post">
            <h1 align="center">{$article.Title}</h1>
            <div class="info">
                {php}
                $post_info = array(
                    'user'=>'<a href="'.$article->Author->Url.'" rel="nofollow">'.$article->Author->StaticName.'</a>',
                    'date'=>tpure_TimeAgo($article->Time()),
                    'view'=>$article->ViewNums,
                    'cmt'=>$article->CommNums,
                    'edit'=>'<a href="'.$host.'zb_system/cmd.php?act=PageEdt&id='.$article->ID.'" target="_blank">'.$lang['tpure']['edit'].'</a>',
                    'del'=>'<a href="'.$host.'zb_system/cmd.php?act=PageDel&id='.$article->ID.'&csrfToken='.$zbp->GetToken().'" data-confirm="'.$lang['tpure']['delconfirm'].'">'.$lang['tpure']['del'].'</a>',
                );
                $page_info = json_decode($zbp->Config('tpure')->PostPAGEINFO,true);
                if(count((array)$page_info)){
                    foreach($page_info as $key => $info){
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
{if $type == 'page' && $zbp->Config('tpure')->PostSHAREPAGEON == '1'}
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
    </div>
{if !$article.IsLock && $zbp->Config('tpure')->PostPAGECMTON=='1'}
    {template:comments}
{/if}
</div>
<div class="sidebar{if $zbp->Config('tpure')->PostFIXMENUON=='1'} fixed{/if}">
    {template:sidebar4}
</div>