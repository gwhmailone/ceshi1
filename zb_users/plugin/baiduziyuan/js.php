<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();

if (!$zbp->CheckRights('root')) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('baiduziyuan')) {$zbp->ShowError(48);die();}

if (isset($_POST['isjs'])) {
    $zbp->Config('baiduziyuan')->isjs = $_POST['isjs'];
    $zbp->SaveConfig('baiduziyuan');
    $zbp->SetHint('good', '参数已保存');
}

require $blogpath .'zb_system/admin/admin_header.php';
require $blogpath .'zb_system/admin/admin_top.php';

?>

<div id="divMain">
    <div class="divHeader">百度提交</div>
    <div class="SubMenu"><?php echo baiduziyuan_submenu('js'); ?></div>
    <div id="divMain2">
        <form id="form1" name="form1" method="post">
            <table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
                <tr>
                    <td width="20%" height="50px" align="center">是否开启自动推送</td>
                    <td width="40%" align="center">
                        <input type="text"  name="isjs" value="<?php echo $zbp->Config('baiduziyuan')->isjs;?>" class="checkbox"/>
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