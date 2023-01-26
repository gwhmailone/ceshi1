<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('baiduziyuan')) {$zbp->ShowError(48);die();}

if (isset($_POST['isbatch'])) {
    $zbp->Config('baiduziyuan')->isbatch = $_POST['isbatch'];
    $zbp->Config('baiduziyuan')->appid = $_POST['appid'];
    $zbp->Config('baiduziyuan')->batchtoken = $_POST['batchtoken'];
    $zbp->SaveConfig('baiduziyuan');
    $zbp->SetHint('good', '参数已保存');
}

require $blogpath .'zb_system/admin/admin_header.php';
require $blogpath .'zb_system/admin/admin_top.php';

?>

<div id="divMain">
    <div class="divHeader">百度提交</div>
    <div class="SubMenu"><?php echo baiduziyuan_submenu('batch'); ?></div>
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
                    <td width="20%" height="50px" align="center">是否开启熊掌号</td>
                    <td width="40%" align="center">
                        <input type="text"  name="isbatch" value="<?php echo $zbp->Config('baiduziyuan')->isbatch;?>" class="checkbox"/>
                    </td>
                </tr>
                <tr>
                    <td width="20%" height="50px" align="center">appid</td>
                    <td width="40%" align="center">
                        <input name="appid" id="appid" type="text" value="<?php echo $zbp->Config('baiduziyuan')->appid; ?>" style="width:90%;height:30px;letter-spacing:1px; " required="required" />
                    </td>
                </tr>
                <tr>
                    <td width="20%" height="50px" align="center">token</td>
                    <td width="40%" align="center">
                        <input name="batchtoken" id="batchtoken" type="text" value="<?php echo $zbp->Config('baiduziyuan')->batchtoken; ?>" style="width:90%;height:30px;letter-spacing:1px; " required="required" />
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