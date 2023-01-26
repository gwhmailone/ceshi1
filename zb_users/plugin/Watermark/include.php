<?php
#注册插件
RegisterPlugin("Watermark","ActivePlugin_Watermark");
function ActivePlugin_Watermark() {
	Add_Filter_Plugin('Filter_Plugin_Upload_SaveFile','Watermark_Main');

}
//图片水印
function Watermark_Main($tmp) {
	global $zbp;
	$waterImage= $zbp->path . 'zb_users/plugin/Watermark/img/Watermark.png'; //作为水印的图片，暂只支持GIF,JPG,PNG格式；
	$waterPos = $zbp->Config('Watermark')->waterPos; //水印位置
	$waterText= $zbp->Config('Watermark')->waterText;//文字水印，即把文字作为为水印；
	$textFont = $zbp->Config('Watermark')->textFont;//文字大小；
	$textColor= $zbp->Config('Watermark')->textColor;//文字颜色，值为十六进制颜色值，默认为#FF0000(红色)；
    $diyw = $zbp->Config('Watermark')->diyw;
    $diyh = $zbp->Config('Watermark')->diyh;
	$watertype = $zbp->Config('Watermark')->watertype ? $zbp->Config('Watermark')->watertype : 1;
	$tmp_info = getimagesize($tmp);
	if(isset($tmp_info[2])){
		if($tmp_info[2]>1 and  $tmp_info[2]<4) {
			Watermark_Do($tmp,$waterPos,$waterImage,$waterText,$textFont,$textColor,$watertype);
		}
	}
}
function Watermark_Do($groundImage,$waterPos="",$waterImage="",$waterText="",$textFont="",$textColor="",$watertype="") {
	global $zbp;
	if($watertype == '1') {
		$isWaterImage = FALSE;
	}elseif($watertype == '2') {
		$isWaterImage = TRUE;
	}else{
		return;
	}
	if($isWaterImage === TRUE){
		//读取水印文件
		if(!empty($waterImage) && file_exists($waterImage)) {
			$water_info = getimagesize($waterImage);
			$water_w = $water_info[0];//取得水印图片的宽
			$water_h = $water_info[1];//取得水印图片的高
			switch($water_info[2])//取得水印图片的格式
			{
				#case 1:$water_im = imagecreatefromgif($waterImage);break;
				case 2:$water_im = imagecreatefromjpeg($waterImage);break;
				case 3:$water_im = imagecreatefrompng($waterImage);break;
				default:return;
			}
		}
	}
	//读取背景图片
	if(!empty($groundImage) && file_exists($groundImage))
	{
		$ground_info = getimagesize($groundImage);
		$ground_w = $ground_info[0];//取得背景图片的宽
		$ground_h = $ground_info[1];//取得背景图片的高
		switch($ground_info[2])//取得背景图片的格式
		{
			#case 1:$ground_im = imagecreatefromgif($groundImage);break;
			case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
			case 3:$ground_im = imagecreatefrompng($groundImage);break;
			default:return;
		}
	}else{
		return;
	}
	//定义平铺数据
	$water_borderx = $zbp->Config('Watermark')->borderx ? $zbp->Config('Watermark')->borderx : 20;
	$water_bordery = $zbp->Config('Watermark')->bordery ? $zbp->Config('Watermark')->bordery : 20;
	$x_length = $ground_w - $water_borderx; //x轴总长度
    $y_length = $ground_h - $water_bordery; //y轴总长度
	$water_opacity = intval($zbp->Config('Watermark')->opacity ? $zbp->Config('Watermark')->opacity : 88);//透明度
	$water_tile_x = intval($zbp->Config('Watermark')->tilex ? $zbp->Config('Watermark')->tilex : 45);
    $water_tile_y = intval($zbp->Config('Watermark')->tiley ? $zbp->Config('Watermark')->tiley : 50);
	$water_rotate = $zbp->Config('Watermark')->rotate?$zbp->Config('Watermark')->rotate:30;
    $c1 = substr($textColor,1);
    $colorarr = ['0x'.substr($c1,0,2),'0x'.substr($c1,2,2),'0x'.substr($c1,4,2)];
	//水印位置
	if($isWaterImage === TRUE) {//图片水印
		$w = $water_w;
		$h = $water_h;
	}else{//文字水印
		$temp = imagettfbbox($textFont,0,$zbp->path . 'zb_users/plugin/Watermark/font/pangmen.ttf',$waterText);//取得使用 TrueType 字体的文本的范围
		$w = $temp[2] - $temp[6];
		$h = $temp[3] - $temp[7];
		unset($temp);
	}
	$diyw = $zbp->Config('Watermark')->diyw?$zbp->Config('Watermark')->diyw:10;
    $diyh = $zbp->Config('Watermark')->diyh?$zbp->Config('Watermark')->diyh:10;
	if( ($ground_w<$w) || ($ground_h<$h) || ($ground_w < $diyw) || ($ground_h < $diyh) )
	{
        //echo "需要加水印的图片的长度或宽度比水印小，无法生成水印！"; 
		return;
	}
	if('10' != $waterPos){  
		switch($waterPos){
			case 0://随机
			$posX = rand(0,($ground_w - $w));
			$posY = rand(0,($ground_h - $h));
			break;
			case 1://1为顶端居左
			$posX = $isWaterImage ? 0 : +20;
			$posY = $isWaterImage ? 0 : $h + 20;
			break;
			case 2://2为顶端居中
			$posX = ($ground_w - $w) / 2;
			$posY = $isWaterImage ? 0 : $h + 20;
			break;
			case 3://3为顶端居右
			$posX = $isWaterImage ? $ground_w - $w : $ground_w - $w - 20;
			$posY = $isWaterImage ? 0 : $h + 20;
			break;
			case 4://4为中部居左
			$posX = $isWaterImage ? 0 : +20;
			$posY = ($ground_h - $h) / 2;
			break;
			case 5://5为中部居中
			$posX = ($ground_w - $w) / 2;
			$posY = ($ground_h - $h) / 2;
			break;
			case 6://6为中部居右
			$posX = $isWaterImage ? $ground_w - $w : $ground_w - $w - 20;
			$posY = ($ground_h - $h) / 2;
			break;
			case 7://7为底端居左
			$posX = $isWaterImage ? 0 : + 20;
			$posY = $isWaterImage ? $ground_h - $h : $ground_h - 20;
			break;
			case 8://8为底端居中
			$posX = ($ground_w - $w) / 2;
			$posY = $isWaterImage ? $ground_h - $h : $ground_h - 20;
			break;
			case 9://9为底端居右
			$posX = $isWaterImage ? $ground_w - $w : $ground_w - $w - 20;
			$posY = $isWaterImage ? $ground_h - $h : $ground_h - 20;
			break;
			default://随机
			$posX = rand(0,($ground_w - $w));
			$posY = rand(0,($ground_h - $h));
			break;
		}
		//设定图像的混色模式
		imagealphablending($ground_im, true);
		if($isWaterImage === TRUE) { //图片水印
			//防止PNG透明背景变黑
			$color=imagecolorallocate($water_im,255,255,255);
			//设置透明
			imagecolortransparent($water_im,$color);
			imagefill($water_im,0,0,$color);
			imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷贝水印到目标文件
		}else{//文字水印
			$font = $zbp->path . 'zb_users/plugin/Watermark/font/pangmen.ttf';//字体
			$black = imagecolorallocatealpha($ground_im, hexdec($colorarr[0]),hexdec($colorarr[1]),hexdec($colorarr[2]),$water_opacity);//字体颜色
			imagettftext($ground_im, $textFont, 0, $posX, $posY, $black, $font, $waterText);
		}
	}else{
        //循环平铺水印
		//imagesavealpha($ground_im,true);
        for ($x = 0; $x < $x_length; $x++)
        {
            for ($y = 0; $y < $y_length; $y++) {
                if($isWaterImage === FALSE){
					//文字水印
                    $font = $zbp->path . 'zb_users/plugin/Watermark/font/pangmen.ttf';//字体
                    $black = imagecolorallocatealpha($ground_im, hexdec($colorarr[0]),hexdec($colorarr[1]),hexdec($colorarr[2]),$water_opacity);//字体颜色
                    imagettftext($ground_im, $textFont, $water_rotate, $x, $y, $black, $font, $waterText);
                }else if($isWaterImage === TRUE){
					//支持png本身透明度的方式
					imagecopy($ground_im, $water_im, $x, $y, 0, 0, $w,$h);//拷贝水印到目标文件
					//imagecopymerge($ground_im, $water_im, $x, $y, 0, 0, $w, $h,50);//拷贝水印到目标文件
                }
                $y += $h + $water_tile_y;
            }
            $x += $w + $water_tile_x;
        }
    }
	//生成水印后的图片
	@unlink($groundImage);
	switch($ground_info[2])//取得背景图片的格式
	{
		#case 1:imagegif($ground_im,$groundImage);break;
		case 2:imagejpeg($ground_im,$groundImage);break;
		case 3:imagepng($ground_im,$groundImage);break;
		default:return;
	}
	//释放内存
	if(isset($water_info)) unset($water_info);
	if(isset($water_im)) imagedestroy($water_im);
	unset($ground_info);
	imagedestroy($ground_im);
}
//安装插件
function InstallPlugin_Watermark() {
	global $zbp;
	//配置初始化
	if(!$zbp->Config('Watermark')->HasKey('Version')) {
		$zbp->Config('Watermark')->Version = '1.0';
		$zbp->Config('Watermark')->waterPos = '9';
		$zbp->Config('Watermark')->waterText = 'www.talklee.com';
		$zbp->Config('Watermark')->textFont = '26';
		$zbp->Config('Watermark')->textColor = '#FFFFFF';
		$zbp->Config('Watermark')->watertype = '1';
		$zbp->Config('Watermark')->diyw = '200';
		$zbp->Config('Watermark')->diyh = '150';
		$zbp->SaveConfig('Watermark');
	}
}
//卸载插件
function UninstallPlugin_Watermark() {
	global $zbp;
	//$zbp->DelConfig('Watermark');
}