<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('baiduziyuan')) {$zbp->ShowError(48);die();}

if(count($_POST)>0){
    $zbp->Config('baiduziyuan')->iscategory = $_POST['iscategory'];
    $zbp->Config('baiduziyuan')->isarticle = $_POST['isarticle'];
    $zbp->Config('baiduziyuan')->ispage = $_POST['ispage'];
    $zbp->Config('baiduziyuan')->istag = $_POST['istag'];
    $zbp->SaveConfig('baiduziyuan');
    $zbp->SetHint('good', '参数已保存');
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><urlset />');
    $xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    $url = $xml->addChild('url');
    $url->addChild('loc', $zbp->host);
    
    if($zbp->Config('baiduziyuan')->iscategory){
        foreach ($zbp->categorys as $c) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $c->Url);
        }
    }
    
    if($zbp->Config('baiduziyuan')->isarticle){
        $array=$zbp->GetArticleList(
            null,
            array(array('=','log_Status',0)),
            null,
            null,
            null,
            false
            );
    
        foreach ($array as $key => $value) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $value->Url);
        }
    }
    
    if($zbp->Config('baiduziyuan')->ispage){
        $array=$zbp->GetPageList(
            null,
            array(array('=','log_Status',0)),
            null,
            null,
            null
            );
    
        foreach ($array as $key => $value) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $value->Url);
        }
    }
    
    if($zbp->Config('baiduziyuan')->istag){
        $array=$zbp->GetTagList();
    
        foreach ($array as $key => $value) {
            $url = $xml->addChild('url');
            $url->addChild('loc', $value->Url);
        }
    }
    
    
    file_put_contents($zbp->path . 'sitemap.xml',$xml->asXML());
    
    
    $zbp->SetHint('good');
    Redirect($_SERVER["HTTP_REFERER"]);
}

require $blogpath .'zb_system/admin/admin_header.php';
require $blogpath .'zb_system/admin/admin_top.php';

?>

<div id="divMain">
    <div class="divHeader">百度提交</div>
    <div class="SubMenu"><?php echo baiduziyuan_submenu('sitemap'); ?></div>
    <div id="divMain2">
        <form id="form1" name="form1" method="post">
            <table border="1" class="tableFull tableBorder tableBorder-thcenter">
            <tr>
                <th class="td20"></th>
                <th>SitemapXML内容组成</th>
            </tr>
            <tr>
                <td>选项</td>
                <td>
                    <p>分类<input type="text" name="iscategory" class="checkbox" value="<?php echo $zbp->Config('baiduziyuan')->iscategory;?>" /></p>
                    <p>文章<input type="text" name="isarticle" class="checkbox" value="<?php echo $zbp->Config('baiduziyuan')->isarticle;?>" /></p>
                    <p>页面<input type="text" name="ispage" class="checkbox" value="<?php echo $zbp->Config('baiduziyuan')->ispage;?>" /></p>
                    <p>标签<input type="text" name="istag" class="checkbox" value="<?php echo $zbp->Config('baiduziyuan')->istag;?>" /></p>
                </td>
            </tr>
            </table>
            <hr/>
            <p><input type="submit" class="button" value="生成sitemap.xml文件" /></p>
            <hr/>
            <table border="1" class="tableFull tableBorder">
            <tr>
                <th class="td20">sitemap.xml地址：</td>
                <th><p><?php echo $zbp->host;?>sitemap.xml</p></td>
            </tr>
            <tr>
                <td class="td20">向百度站长平台提交：</td>
                <td><p><a href="http://ziyuan.baidu.com/linksubmit/index?site=<?php echo $zbp->host; ?>" target="_blank">http://ziyuan.baidu.com/linksubmit/index?site=<?php echo $zbp->host; ?></a></p></td>
            </tr>
            </table>
        </form>
        <script type="text/javascript">
            ActiveLeftMenu("aPluginMng");
            AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/baiduziyuan/logo.png'; ?>");
        </script>
    </div>
</div>

<?php
    require $blogpath .'zb_system/admin/admin_footer.php';
    RunTime();
?>