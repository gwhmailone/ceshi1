<?php
require '../../../zb_system/function/c_system_base.php';
require '../../../zb_system/function/c_system_admin.php';
$zbp->Load();
$action='root';
if (!$zbp->CheckRights($action)) {$zbp->ShowError(6);die();}
if (!$zbp->CheckPlugin('KeyWordReplace')) {$zbp->ShowError(48);die();}

$blogtitle='自动添加标签链接';

require $blogpath . 'zb_system/admin/admin_header.php';
require $blogpath . 'zb_system/admin/admin_top.php';
$act = GetVars('act', 'GET');
if ($act == 'save') { 		      		  					 	     		 		  
    $zbp->Config('KeyWordReplace')->target = (bool) GetVars('target');
    $zbp->Config('KeyWordReplace')->colorOn = (bool) GetVars('colorOn');
    $zbp->Config('KeyWordReplace')->threshold= (string) GetVars('threshold');
    $zbp->Config('KeyWordReplace')->color= (string) GetVars('color');
    $zbp->Config('KeyWordReplace')->class= (string) GetVars('class');
    $zbp->Config('KeyWordReplace')->ID= (string) GetVars('ID');
    $zbp->SaveConfig('KeyWordReplace');
    $zbp->ShowHint('good'); 
    Redirect('./main.php');
}
if ($act == 'addTag') {
    $zbp->Config('KeyWordReplace')->tags= (string) GetVars('tags');
    $zbp->SaveConfig('KeyWordReplace');
    $zbp->ShowHint('good');
    Redirect('./main.php?act=add');
}
?>
<div id="divMain">
  <div class="divHeader"><?php echo $blogtitle;?></div>
  <div class="SubMenu">
  </div>
  <div id="divMain2">
  	<div class="content-box">
  		<div class="content-box-header">
                <ul class="content-box-tabs">
                    <li><a href="#tab1" <?php if (!GetVars('act')) { echo ' class="default-tab current"';} ?>><span>基础设置</span></a></li>
                    <li><a href="#tab2" <?php if (GetVars('act') == 'add') {echo '  class="default-tab current"';} ?>><span>添加关键词</span></a></li>
                    <li><a href="#tab3" <?php if (GetVars('act') == 'help') {echo '  class="default-tab current"';} ?>><span>帮助</span></a></li>
                </ul>
            <div class="clear"></div>
        </div>
		<div class="content-box-content"> 
		<div class="tab-content<?php if (!GetVars('act')) { echo ' default-tab';} ?>" style="margin: 0px; padding: 0px; border: none; display: block;" id="tab1">
            <form action="<?php echo BuildSafeURL("main.php?act=save"); ?>" method="post">
              <table width="900px" border="0">
                <thead></thead>
                <tbody>
                <tr height="32">
                  <td width="30%" align="left"><p><b>· 新窗口打开</b>
                      <span class="note">&nbsp;&nbsp; </span></p>
                      <p><?php echo zbpform::zbradio('target', $zbp->Config("KeyWordReplace")->target); ?></p>
                  </td>
                </tr> 
                <tr height="32">
                  <td width="30%" align="left"><p><b>· 自定义颜色</b>
                      <span class="note">&nbsp;&nbsp; </span></p>
                      <p><?php zbpform::text("color", $zbp->Config("KeyWordReplace")->color, "100px"); ?>&nbsp;&nbsp; <?php echo zbpform::zbradio('colorOn', $zbp->Config("KeyWordReplace")->colorOn); ?></p>
                  </td>
                </tr> 
                <tr height="32">
                  <td width="30%" align="left"><p><b>· 文章最多内链次数</b><br/>
                      <span class="note">&nbsp;&nbsp; 当设置关键词太多然后文章又很多关键词导致内链过多问题</span></p>
                      <p><?php zbpform::text("threshold", $zbp->Config("KeyWordReplace")->threshold, "100px"); ?></p>
                  </td>
                </tr>
                <tr height="32">
                  <td width="30%" align="left"><p><b>· 自定义CLASS或ID</b><br/>
                      <span class="note">&nbsp;&nbsp; 可以使用你原有主题链接的CLASS或ID而无需使用自定义颜色</span></p>
                      <p>class:<?php zbpform::text("class", $zbp->Config("KeyWordReplace")->class, "100px"); ?>&nbsp;&nbsp; id:<?php zbpform::text("ID", $zbp->Config("KeyWordReplace")->ID, "100px"); ?></p>
                  </td>
                </tr>
                    </tbody>
              </table>
              <p>
                <input type="submit" value="提交保存" class="button" />
              </p>
            </form>
		</div>
		<div class="tab-content<?php if (GetVars('act') == 'add') { echo ' default-tab';} ?>" style="margin: 0px; padding: .5em; border: none;;" id="tab2">
			<table>
			<form method="post" action="<?php echo BuildSafeURL("main.php?act=addTag"); ?>">
				<tr>
					<td>
					<p>一行一个关键词与链接之间使用$$$隔开(关键词请勿包含英文逗号)<br/>
					如：菜鸟建站$$$http://www.newbii.cn
					</p>
					<?php zbpform::textarea("tags", $zbp->Config("KeyWordReplace")->tags, "885px", "450PX"); ?>
					<p><input type="submit" id="addTag" value="保存关键词"></p>
				</td>
				</tr>
			</form>
			</table>
		</div>
		<div class="tab-content<?php if (GetVars('act') == 'help') { echo ' default-tab';} ?>" style="margin: 0px; padding: .5em; border: none;;" id="tab3">
		<p>V1.4修复zblog1.7版本兼容问题</p>   
		<p>此插件自动关联你的文章标签还有你所添加的关键词对文章自动添加内链。
		<br/>AD:做网站呢，很多人都知道要做内容，然后做内链，还有外链。
		<br/>在这里给大家推荐几个免费的<a href="https://app.zblogcn.com/circle/?id=17868" target="_blank" style="color:red">
			【小应用】</a>让你快速部署你的网站内链，从创建标签开始，一条龙？方便简单快速部署你的链接
		<br/>关注<a href="http://www.newbii.cn/" target="_blank" style="color:red">菜鸟建站</a>获取更多免费实用插件</p>
		</div>
	</div>

<script src="jscolor.js" type="text/javascript"></script>
  </div>
</div>

<?php
require $blogpath . 'zb_system/admin/admin_footer.php';
RunTime();
?>