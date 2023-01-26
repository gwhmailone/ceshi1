<?php 
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('Jz52_imgmask')) {$zbp->ShowError(48);die();}
$blogtitle='图片隐写术';
if (count($_POST) > 0 && $zbp->VerifyCSRFToken($_POST['csrfToken'])) {
	$zbp->Config('Jz52_imgmask')->title=$_POST['title'];
	$zbp->Config('Jz52_imgmask')->readme=$_POST['readme'];
	$zbp->Config('Jz52_imgmask')->css=$_POST['css'];
	$zbp->Config('Jz52_imgmask')->clearSetting=$_POST['clearSetting'];
    $zbp->SaveConfig('Jz52_imgmask'); 
    if (GetVars('addnavbar')) {
		 if ($zbp->option['ZC_STATIC_MODE'] == 'REWRITE') {
			$zbp->AddItemToNavbar('item', 'Jz52_imgmask', $zbp->Config('Jz52_imgmask')->title, $zbp->host.'Jz52_imgmask.html'); 
		 }else{
			$zbp->AddItemToNavbar('item', 'Jz52_imgmask', $zbp->Config('Jz52_imgmask')->title, $zbp->host.'?Jz52_imgmask');
		 }
    } else {
        $zbp->DelItemToNavbar('item', 'Jz52_imgmask');
    }
    $zbp->SetHint('good');
    Redirect('./main.php');
}
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
?>
<div id="divMain">
	<div class="divHeader"><?php echo $blogtitle;?></div>
	<div class="SubMenu">
     <a href="https://www.jz52.com" target="_blank"><span class="m-right">技术支持</span></a>
    </div>
	<div id="divMain2">
<table width="100%" style="padding:0;margin:0;" cellspacing="0" cellpadding="0" class="tableBorder">
	<br/>
	<tr>
    <td>	
		<p>1、图片隐写术是由 <a href="https://www.jz52.com" target="_blank">极致时空</a> 开发制作并免费分享的免费插件。</p>
		<p>2、图片隐写核心代码来源：https://github.com/kingthy/imagemask</p>
		<p>3、免费插件不提供在线技术支持，有问题请直接在应用中心留言</p>
		<p>4、更多免费插件主题、建站交流请加群：236895886（验证：zblog）</p>
		<p>5、本插件前台所有操作都在用户浏览器端进行，不用担心安全问题</p>
	</td>
	
	</tr>	
</table>	
<form id="edit" name="edit" method="post" action="#">
<input id="reset" name="reset" type="hidden" value="" />
<table border="1" class="tableFull tableBorder">
<input type="hidden" name="csrfToken" value="<?php echo $zbp->GetCSRFToken();?>">
<tr>
	<td class="td30"><p align='center'><b>将图片隐写术加入导航栏</b></p></td>
	<td><input type="checkbox" name="addnavbar" value="ok" <?php if($zbp->CheckItemToNavbar('item','Jz52_imgmask')){?>checked="checked"<?php }?> /></td>
</tr>
<tr>
	<td class="td30"><p align='center'><b>图片隐写术面标题</b></p></td>
	<td><input type="text" name="title" value="<?php echo ($zbp->Config('Jz52_imgmask')->title);?>" style="width:30%;" /></td>
</tr>
<tr>
	<td class="td30"><p align='center'><b>图片隐写术面说明文字</b></p></td>
	<td><textarea name="readme" style="width:90%;height:100px;" /><?php echo ($zbp->Config('Jz52_imgmask')->readme);?></textarea></td>
</tr>
<tr>
	<td class="td30"><p align='center'><b>自定义css</b></p></td>
	<td><textarea name="css" style="width:90%;height:100px;" /><?php echo ($zbp->Config('Jz52_imgmask')->css);?></textarea></td>
</tr>
<tr>
	<td class="td30"><p align='center'><b>关闭插件后清空配置</b></p></td>
	<td><input type="text" id="clearSetting" name="clearSetting" class="checkbox" value="<?php echo $zbp->Config('Jz52_imgmask')->clearSetting;?>"/>
	（谨慎使用，开启后关闭插件将清空所有配置）</td>
</tr>
<tr>
<td  class="td30"><p align='center'><b>图片隐写术面的地址</b></p></td>
<td>动态：<a target="_blank" href="<?php echo $zbp->host.'?Jz52_imgmask';?>"><?php echo $zbp->host.'?Jz52_imgmask';?> </a> 静态：<a target="_blank" href="<?php echo $zbp->host.'Jz52_imgmask.html';?>"><?php echo $zbp->host.'Jz52_imgmask.html';?></a></td>
</tr>
</table>
	  <hr/>
	  <p>
		<input type="submit" class="button" value="<?php echo $lang['msg']['submit']?>" />
	</form>
	</div>
</div>
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>