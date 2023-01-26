{* Template Name:列表页模板 *}
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
			{if $zbp->Config('tpure')->PostBANNERON == '1' && $zbp->Config('tpure')->PostBANNERALLON == '1'}
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
                    {if $type=='category' && $zbp->Config('tpure')->PostFILTERON == '1'}
                    <div class="filternav">
                        <form id="filternav">
                            <h1>{$category.Name}</h1>
                            <ul class="filter">
                                <li{if GetVars('order','GET') == 'newlist' || !GetVars('order','GET')} class="active"{/if} data-type="newlist">
                                    最新<i class="{if GetVars('sort','GET')}up{else}down{/if}"></i>
                                </li>
                                <li{if GetVars('order','GET') == 'viewlist'} class="active"{/if} data-type="viewlist">
                                    浏览<i class="{if GetVars('sort','GET')}up{else}down{/if}"></i>
                                </li>
                                <li{if GetVars('order','GET') == 'cmtlist'} class="active"{/if} data-type="cmtlist">
                                    评论<i class="{if GetVars('sort','GET')}up{else}down{/if}"></i>
                                </li>
                            </ul>
                            {if $zbp->Config('system')->ZC_STATIC_MODE != 'REWRITE'}<input type="hidden" name="cate" value="{$category->ID}">{/if}
                            <input type="hidden" name="order" value="{GetVars('order','GET')}">
                            <input type="hidden" name="sort" value="{php}echo (int)GetVars('sort','GET'){/php}">
                        </form>
                    </div>
<script>
    !function(f){
  var a=f.find('li'),o=f.find('[name=order]'),s=f.find('[name=sort]');
  a.click(function(){
     var v=$(this).data('type');
      if(v===o.val()){
      s.val(s.val().toString()==='1'?0:1);
    }else{
      s.val(''===o.val() && !$(this).index() ? 1 : 0);
      o.val(v);
    }
    f.submit();
    return false;
  })
}($('#filternav'));
</script>
                    {/if}
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
            <div class="sidebar{if $zbp->Config('tpure')->PostFIXMENUON=='1'} fixed{/if}">
                {template:sidebar2}
            </div>
        </div>
    </div>
</div>
{template:footer}
</body>
</html>