<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';

$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('AutoLinkTags')) {$zbp->ShowError(48);die();}

$blogtitle='正文标签自动内链';

$act = "";
if ($_GET['act']){
$act = $_GET['act'] == "" ? 'config' : $_GET['act'];
}
require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';

?>

<link rel="stylesheet" href="./script/admin.css">
<script type="text/javascript" src="./script/custom.js"></script>

<div class="twrapper">
	<div class="theader">
		<div class="theadbg"></div>
		<div class="tuser">
			<div class="tuserimg"><img src="./logo.png" /></div>
			<div class="tusername"><?php echo $blogtitle;?></div>
		</div>
		<div class="tmenu">
			<ul>
				<?php AutoLinkTags_SubMenu($act);?>
			</ul>
		</div>
	</div>
	<div class="tmain">
<?php
if ($act == 'base'){
if(count($_POST)>0){
	$zbp->Config('AutoLinkTags')->PLUGINON = $_POST['PLUGINON'];
	$zbp->Config('AutoLinkTags')->TAGSNUM = $_POST['TAGSNUM'];
	$zbp->Config('AutoLinkTags')->CLASSON = $_POST['CLASSON'];
	$zbp->Config('AutoLinkTags')->CLASS = $_POST['CLASS'];
	$zbp->Config('AutoLinkTags')->COLORON = $_POST['COLORON'];
	$zbp->Config('AutoLinkTags')->COLOR = $_POST['COLOR'];
	$zbp->Config('AutoLinkTags')->SAVECONFIG = $_POST['SAVECONFIG'];
	$zbp->SaveConfig('AutoLinkTags');
	$zbp->ShowHint('good');
}
?>
<script type="text/javascript" src="./script/jscolor.js"></script>
		<dl>
			<dt>基本设置</dt>
			<form method="post" class="setting">
				<dd class="half">
					<label>插件开关</label>
					<input type="text" id="PLUGINON" name="PLUGINON" class="checkbox" value="<?php echo $zbp->Config('AutoLinkTags')->PLUGINON;?>" />
					<i class="warn">?</i><span class="warncon">“ON”为启用插件功能；<br>“OFF”为关闭插件功能。</span>
				</dd>
				<dd class="half">
					<label for="TAGSNUM">最低同词标签</label>
					<input type="number" id="TAGSNUM" name="TAGSNUM" value="<?php echo $zbp->Config('AutoLinkTags')->TAGSNUM;?>" min="1" step="1" class="settext" />
					<i class="warn">?</i><span class="warncon">文章内容含多个相同标签时取前N条标签自动增加链接。</span>
				</dd>
				<dt>类名设置</dt>
				<dd class="half">
					<label>自定义类名</label>
					<input type="text" id="CLASSON" name="CLASSON" class="checkbox" value="<?php echo $zbp->Config('AutoLinkTags')->CLASSON;?>" />
					<i class="warn">?</i><span class="warncon">“ON”为标签增加class属性；<br>“OFF”为取消增加class属性。</span>
				</dd>
				<dd class="half">
					<label for="CLASS">class名称</label>
					<input type="text" id="CLASS" name="CLASS" value="<?php echo $zbp->Config('AutoLinkTags')->CLASS;?>" class="settext" />
					<i class="warn">?</i><span class="warncon">设置class名称，由主题定义class样式。</span>
				</dd>
				<dt>颜色设置</dt>
				<dd class="half">
					<label>自定义颜色</label>
					<input type="text" id="COLORON" name="COLORON" class="checkbox" value="<?php echo $zbp->Config('AutoLinkTags')->COLORON;?>" />
					<i class="warn">?</i><span class="warncon">“ON”为增加标签颜色；<br>“OFF”为关闭标签颜色。</span>
				</dd>
				<dd class="half">
					<label for="COLOR">选取颜色</label>
					<input type="text" id="COLOR" name="COLOR" value="<?php echo $zbp->Config('AutoLinkTags')->COLOR;?>" class="color settext" />
					<i class="warn">?</i><span class="warncon">统一为标签设置颜色。</span>
				</dd>
				<dt>配置信息</dt>
				<dd>
					<label>保存配置</label>
					<input type="text" id="SAVECONFIG" name="SAVECONFIG" class="checkbox" value="<?php echo $zbp->Config('AutoLinkTags')->SAVECONFIG;?>" />
					<i class="warn">?</i><span class="warncon">“ON”为保存配置信息，启用或卸载插件后不清空配置信息；<br>“OFF”为删除配置信息，启用或卸载插件后将清空配置信息。<br>若不再使用本插件，请选择"OFF"提交，停用或卸载时将清空配置信息。</span>
				</dd>
				<dd class="setok"><input type="submit" value="保存设置" class="setbtn" /></dd>
				</form>
		</dl>
<?php }
if ($act == 'help'){
if(count($_POST)>0){
	$zbp->Config('AutoLinkTags')->PLUGINON = $_POST['PLUGINON'];
	$zbp->Config('AutoLinkTags')->TAGSNUM = $_POST['TAGSNUM'];
	if($zbp->Config('AutoLinkTags')->CLASSON == 1){
		$zbp->Config('AutoLinkTags')->CLASS = $_POST['CLASS'];
	}
	$zbp->Config('AutoLinkTags')->CLASSON = $_POST['CLASSON'];
	if($zbp->Config('AutoLinkTags')->COLORON == 1){
		$zbp->Config('AutoLinkTags')->COLOR = $_POST['COLOR'];
	}
	$zbp->Config('AutoLinkTags')->COLORON = $_POST['COLORON'];
	$zbp->Config('AutoLinkTags')->SAVECONFIG = $_POST['SAVECONFIG'];
	$zbp->SaveConfig('AutoLinkTags');
	$zbp->ShowHint('good');
}
?>
		<dl>
			<dt>插件说明</dt>
			<form method="post" class="setting">
				<dd>
					<p>01. 插件可实现自动检测文章中出现的已有标签列表中词语，并自动为标签词语添加所在链接，增加站内链接以利于SEO。</p>
					<p>02. 插件可实现为标签添加class属性，由主题CSS设置样式(如需字体加粗，边框等等)。</p>
					<p>03. 插件可实现为标签统一设置颜色。</p>
					<p>03. 插件可设置最低词频，检测文章中存在多个相同标签时，将前N个标签自动增加链接。</p>
					<p>交流群（ZBlog中国）：491920017 <a target="_blank" href="//shang.qq.com/wpa/qunwpa?idkey=161c1e3745ba6e1d1f1c7d3b3d93f685938d89e0e56da0c8b6f8d9c67340a9b6" style="vertical-align:middle;"><img border="0" src="./style/images/group.png" alt="ZBlog中国" title="ZBlog中国"></a></p>
				</dd>
			</form>
		</dl>
<?php } ?>
	</div>
</div>
<div class="tfooter">
	<ul>
		<li><a href="../../plugin/AppCentre/main.php?auth=e9210072-2342-4f96-91e7-7a6f35a7901e" target="_blank">全部应用</a></li>
		<li><a href="https://www.toyean.com/?advice" target="_blank">意见反馈</a></li>
		<li><a href="https://www.toyean.com/post/autolinktags.html" target="_blank">帮助说明</a></li>
		<li><a href="https://wpa.qq.com/msgrd?v=3&uin=476590949&site=qq&menu=yes" target="_blank">技术支持</a></li>
		<li><a href="https://jq.qq.com/?_wv=1027&k=44zyTKi" target="_blank">主题交流群</a></li>
	</ul>
	<p>Copyright &copy; 2010-<script>document.write(new Date().getFullYear());</script> <a href="https://www.toyean.com/" target="_blank">TOYEAN.COM</a> all rights reserved.</p>
</div>
<script type="text/javascript">ActiveTopMenu("topmenu_AutoLinkTags");</script> 
<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>