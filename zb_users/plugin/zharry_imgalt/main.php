<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('zharry_imgalt')) {$zbp->ShowError(48);die();}

$blogtitle='图片alt设置';
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
if(isset($_POST['Items'])){
    foreach($_POST['Items'] as $key=>$val){
       $zbp->Config('zharry_imgalt')->$key = $val;
    }
  $zbp->SaveConfig('zharry_imgalt');
  $zbp->ShowHint('good');
  //Redirect('./main.php');
}
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
  <a href="main.php"><span class="m-left m-now"><b>图片alt设置</b></span></a>
  <a href="../../plugin/AppCentre/main.php?id=1935" title="我的博客可以听，语音朗读助手让你的博客变的可以听，给文章添加语音朗读助手，释放你的眼睛，一边朗读文章，一边去完成其他操作；"><span class="m-right"><b>语音朗读助手插件</b></span></a>
  <a href="http://wpa.qq.com/msgrd?v=3&uin=1955326421&site=qq&menu=yes" target="_blank"><span class="m-right">联系作者</span></a>
  </div>
  <div id="divMain2">
<style type="text/css">
.xtips{color:#999;margin-left:15px}
.xtips:hover{color:#136;margin-left:15px;cursor:pointer;}
div.xtips{line-height:1.5;padding:6px 0;}
td label{display:inline-block;margin:3px 13px 3px 0;white-space:nowrap;}
td label input{margin:-2px 2px 0 0;vertical-align:middle;}
input.button{height:auto;padding:10px 35px;}
</style>
<!--代码-->
	<form id="form1" name="form1" method="post">	
	 <?php if (function_exists('CheckIsRefererValid')) {echo '<input type="hidden" name="csrfToken" value="' . $zbp->GetCSRFToken() . '">';}?>
    <table class="tb-set" width="100%">
        <tr height="40">
            <td colspan="2" align="center"><b>图片ALT参数设置</b></td>
        </tr>
        <tr>
            <td colspan="2"><div class="xtips"></td>
        </tr>
        <tr height="60">
            <td width="200" align="right"><b>图片ALT参数开关：</b></td>
            <td><input name="Items[zharry_imgalt_alt_kg]" type="text" value="<?php echo $zbp->Config('zharry_imgalt')->zharry_imgalt_alt_kg;?>" class="checkbox"><span class="xtips">ON状态时,可为文章中的图片添加ALT参数,默认开启；</span></td>
        </tr>
        <tr height="60">
            <td width="200" align="right"><b>图片ALT显示选择：</b></td>
            <td>
			<select name="Items[zharry_imgalt_alt]" id="zharry_imgalt_alt">
				<option value="3"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='3'){echo 'selected="selected"';}?>>显示自定义</option>
				<option value="1"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='1'){echo 'selected="selected"';}?>>显示文章标题</option>
				<option value="5"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='5'){echo 'selected="selected"';}?>>显示文章标题+站名</option>
				<option value="4"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='4'){echo 'selected="selected"';}?>>显示文章标题+第N张图</option>
				<option value="2"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_alt=='2'){echo 'selected="selected"';}?>>显示文章标题+第N张图+站名</option>
			</select><span class="xtips">图片ALT显示分五种选择,默认显示文章标题；</span></td>
        </tr>
        <tr height="60">
            <td width="200" align="right"><b>自定义显示样式：</b></td>
            <td>
			<select name="Items[zharry_imgalt_altdiy]" id="zharry_imgalt_altdiy">
				<option value="1"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='1'){echo 'selected="selected"';}?>>显示自定义内容</option>
				<option value="4"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='4'){echo 'selected="selected"';}?>>自定义+文章标题</option>
				<option value="2"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='2'){echo 'selected="selected"';}?>>自定义+文章标题+站名</option>
				<option value="3"<?php if($zbp->Config('zharry_imgalt')->zharry_imgalt_altdiy=='3'){echo 'selected="selected"';}?>>自定义+文章标题+第N张图+站名</option>
			</select>
			<span class="xtips">自定义显示样式分四种选择；</span></td>
        </tr>
        <tr height="60">
            <td align="right"><b>排除某些分类：</b></td>
            <td><input name="Items[zharry_fl_id]" type="text" value="<?php echo $zbp->Config('zharry_imgalt')->zharry_fl_id;?>" size="100"><span class="xtips"></br></br>排除某些分类图片不添加ALT参数，直接输入分类ID，多个分类间用“,”(逗号)隔开。如：1,2 </span></td>
        </tr>
        <tr height="60">
            <td align="right"><b>排除某些文章：</b></td>
            <td><input name="Items[zharry_wz_id]" type="text" value="<?php echo $zbp->Config('zharry_imgalt')->zharry_wz_id;?>" size="100"><span class="xtips"></br></br>排除某些文章图片不添加ALT参数，直接输入文章ID，多篇文章间用“,”(逗号)隔开。如：11,12,13,14 </span></td>
        </tr>
        <tr height="60">
            <td align="right"><b>ALT/title参数说明：</b></td>
            <td><span class="xtips">图片ALT参数设置同时自动替换title参数，title参数值与ALT参数值相同；</span></td>
        </tr>
        <tr>
            <td colspan="2"><div class="xtips"></td>
        </tr>
        <tr>
            <td colspan="2"><div class="xtips"></td>
        </tr>
        <tr height="80">
            <td colspan="2" align="center"><input type="submit" class="button" value="保存设置"></td>
        </tr>
    </table><br><br>
    </form>
  </div>
</div>
<script type="text/javascript">AddHeaderIcon("<?php echo $bloghost . 'zb_users/plugin/zharry_imgalt/logo.png';?>");</script> 

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>