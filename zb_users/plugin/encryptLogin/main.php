<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('encryptLogin')) {$zbp->ShowError(48);die();}

$blogtitle='后台登录地址加密 - 问题设置';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

if(count($_POST) > 1){
    if($_POST['isuse']==1){
        if(!empty($_POST['ask']) && !empty($_POST['answer'])){
            $zbp->Config('encryptLogin')->isuse=$_POST['isuse'];
            $zbp->Config('encryptLogin')->ask=$_POST['ask'];
            $zbp->Config('encryptLogin')->answer=$_POST['answer'];
            $zbp->SaveConfig('encryptLogin');
            $zbp->ShowHint('good','操作成功，当前后台地址为 '.$zbp->host.'zb_system/login.php?'.$_POST['ask'].'='.$_POST['answer'].'');
        }else{
            $zbp->ShowHint('bad','问题或答案不能为空');
        }
    }else{
        $zbp->Config('encryptLogin')->isuse=$_POST['isuse'];
        $zbp->Config('encryptLogin')->ask=$_POST['ask'];
        $zbp->Config('encryptLogin')->ask=$_POST['answer'];
        $zbp->SaveConfig('encryptLogin');
        $zbp->ShowHint('good');
    }
}
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
  </div>
  <div id="divMain2">
        <form method="post">
        <table border="1" class="tableFull tableBorder">
        <tr>
        <th class="td30"><p align='left'><b>配置名称</b></p></th>
        <th>配置功能/开关/选项</th>
        </tr>
        <tr>
        <td><p align='left'><b>是否开启</b></p></td>
        <td><input type="text"  name="isuse" value="<?php echo $zbp->Config('encryptLogin')->isuse;?>" class="checkbox"/>开启后才能生效！</td>
        </tr>
        <tr>
        <td><p align='left'><b>问题</b></p></td>
        <td><input type="text"  name="ask" value="<?php echo $zbp->Config('encryptLogin')->ask;?>" style="width:100%"/></td>
        </tr>
        <tr>
        <td><p align='left'><b>答案</b></p></td>
        <td><input type="text"  name="answer" value="<?php echo $zbp->Config('encryptLogin')->answer;?>" style="width:100%"/></td>
        </tr>
        <tr>
        <td colspan="2">
        当前后台地址：
        <?php 
        if($zbp->Config('encryptLogin')->isuse){
            echo $zbp->host. 'zb_system/login.php?'.$zbp->Config('encryptLogin')->ask.'='.$zbp->Config('encryptLogin')->answer.'';
        }else{
            echo $zbp->host. 'zb_system/login.php';
        }
        ?>
        <br/>
        如忘记问答，请使用ftp类工具删除插件目录即可
        </td>
        </tr>
        </table>
        <hr/>
        <p>
        <input type="submit" class="button" value="<?php echo $lang['msg']['submit'] ?>" />
        </p>
        </form>
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>