<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('baiduziyuan')) {$zbp->ShowError(48);die();}

if (isset($_POST['token'])) {
    $zbp->Config('baiduziyuan')->token = $_POST['token'];
    $zbp->SaveConfig('baiduziyuan');
    $zbp->SetHint('good', '参数已保存');
}

require $blogpath .'zb_system/admin/admin_header.php';
require $blogpath .'zb_system/admin/admin_top.php';

$weburl=$zbp->host;
$weburl=str_replace('http://','',$weburl);
$weburl=str_replace('https://','',$weburl);
$weburl=str_replace('/','',$weburl);

?>

<div id="divMain">
    <div class="divHeader">百度提交</div>
    <div class="SubMenu"><?php echo baiduziyuan_submenu('main'); ?></div>
    <div id="divMain2">
        <form id="form1" name="form1" method="post">
            <table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
                <tr>
                    <td width="20%" height="50px" align="center">site</td>
                    <td width="40%" align="center">
                    <?php echo $zbp->host; ?>
                    </td>
                </tr>
                <tr>
                    <td width="20%" height="50px" align="center">token</td>
                    <td width="40%" align="center">
                        <input name="token" id="token" type="text" value="<?php echo $zbp->Config('baiduziyuan')->token; ?>" style="width:90%;height:30px;letter-spacing:1px; " required="required" />
                    </td>
                </tr>
                <tr>
                    <td colspan="3" width="100%" height="50px" align="center">
                    接口调用地址案例： http://data.zz.baidu.com/urls?site=<?php echo $weburl; ?>&token=QPEVRyeGdseEUEFfb
                    <BR>
                    token信息查看地址：
                    <a href="http://ziyuan.baidu.com/linksubmit/index?site=<?php echo $weburl; ?>" target="_blank">http://ziyuan.baidu.com/linksubmit/index?site=<?php echo $weburl; ?></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" width="100%" height="50px" align="center">
                        <input name="" type="Submit" class="button" value="保存" />
                    </td>
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