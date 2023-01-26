<?php
/**
* 预处理和公共函数
*
* @author 心扬 <chrishyze@163.com>
*/

//系统初始化
require_once __DIR__.'/../../../../zb_system/function/c_system_base.php';

$zbp->Load(); //加载系统
//声明HTTP资源类型为JSON
if (!headers_sent()) {
    header('Content-Type: application/json; charset=utf-8');
}

//验证CSRF Token
if (GetVars('csrfToken')) {
    if (!$zbp->VerifyCSRFToken(GetVars('csrfToken'), 'Editormd')) {
        reject('非法访问！');
    }
} else {
    reject('非法访问！');
}

//检测主题/插件启用状态
if (!$zbp->CheckPlugin('Editormd')) {
    reject('插件未启用!');
}

/**
 * JSON消息响应
 * 转义输出，避免中文转码 Unicode
 * 兼容 PHP5.3～PHP7.
 *
 * @param array $arr 消息数组，仅支持一维数组
 *
 * @return string
 */
function jsonResponse($arr)
{
    foreach ($arr as &$value) {
        $value = htmlspecialchars($value);
    }

    return json_encode(
        $arr,
        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
    );
}

/**
 * 拒绝访问
 *
 * @param string $message
 */
function reject($message)
{
    echo jsonResponse(array(false, $message));
    die();
}
