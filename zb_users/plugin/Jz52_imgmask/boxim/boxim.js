var mask = new ImageMask({
debug: false,   //是否开启调试模式
    charSize: 16,   //字符的字节位数，默认为16，即字符最大值为0xFFFF
    mixCount: 2,    //隐写数据要混合到图片颜色值里的最低位数，值范围在1-5，默认为2，如果大于3，则图片会失真很严重
    lengthSize: 24  //数据长度值的占用字节位数，默认为24，也即数据长度最大值为16777215
});
var fileInput = document.getElementById('file2');
var tip = document.querySelector('.tip');
  fileInput.addEventListener('change',function(e){ //监听change事件，选择文件后触发
       tip.textContent = '已选择文件：' + this.files[0].name;
    })
  window.onload = function() {
    // add action to the file input
    var input = document.getElementById('file');
    input.addEventListener('change', importImage);

    // add action to the encode button
    var encodeButton = document.getElementById('encode');
    encodeButton.addEventListener('click', encode);

    // add action to the decode button
    var decodeButton = document.getElementById('decode');
    decodeButton.addEventListener('click', decode);

    // add action to the encode button
    var encodeButton2 = document.getElementById('encode2');
    encodeButton2.addEventListener('click', encode2);

    // add action to the decode button
    var decodeButton2 = document.getElementById('decode2');
    decodeButton2.addEventListener('click', decode2);
};

// put image in the canvas and display it
var importImage = function(e) {
    var reader = new FileReader();

    reader.onload = function(event) {
        // set the preview
        document.getElementById('preview').style.display = 'block';
        document.getElementById('preview').src = event.target.result;

        // wipe all the fields clean
        document.getElementById('message').value = '';
        document.getElementById('output').src = '';

        // read the data into the canvas element
        var img = new Image();
        img.onload = function() {
			var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            ctx.canvas.width = img.width;
            ctx.canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            
			var count = mask.maxTextLength(canvas);
			document.getElementById('aa').innerHTML = '隐藏文字的最大长度: ' + count + ' || 隐藏文件的最大大小: ' + (mask.maxFileSize(canvas)/1024).toFixed(2) + 'KB';
            //decode();
        };
        img.src = event.target.result;
    };

    reader.readAsDataURL(e.target.files[0]);
};

// encode the image and save it
var encode = function() {
    var message = document.getElementById('message').value;
    var output = document.getElementById('output');
    var canvas = document.getElementById('canvas');
	var debug = document.getElementById('debug');
	var preview = document.getElementById('preview');
	var ctx = canvas.getContext('2d');
	ctx.drawImage(preview, 0, 0, preview.width, preview.height);

	mask.opts.debug = debug.checked;
	mask.hideText(canvas, message);
    output.src = canvas.toDataURL();
};
// decode the image and display the contents if there is anything
var decode = function() {
    // decode the message with the supplied password
    var canvas = document.getElementById('canvas');
    var message = mask.revealText(canvas);

     document.getElementById('message').value = message;
};
// encode the image and save it
var encode2 = function() {
    var output = document.getElementById('output');
    var canvas = document.getElementById('canvas');
    var input = document.getElementById('file2');
	var debug = document.getElementById('debug');
	var preview = document.getElementById('preview');
	var ctx = canvas.getContext('2d');
	ctx.drawImage(preview, 0, 0, preview.width, preview.height);

	mask.opts.debug = debug.checked;

	mask.hideFile(canvas, input.files[0], function(result){
		if(result.success){
			output.src = canvas.toDataURL();
		}else{
			alert(result.message);
		}
	});

};
function createFileBlob (data, name) {
  const file = new window.Blob([data], { type: "application/octet-binary" })
  const fileUrl = window.URL.createObjectURL(file)

  const files = document.getElementById('files')
  const link = document.createElement('a')
  link.setAttribute('href', fileUrl)
  link.setAttribute('download', name)

  link.innerText = name + ' - Size: ' + file.size
  files.appendChild(link);
}
// decode the image and display the file if there is anything
var decode2 = function() {
    // decode the message with the supplied password
    var canvas = document.getElementById('canvas');
    var file = mask.revealFile(canvas);
	createFileBlob(file.data, file.name);
};