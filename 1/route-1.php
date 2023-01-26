
<?php

/**
 * 显示文章.
 *
 * @param array|int|string $id         文章ID/ ID/别名对象 (1.7起做为主要array型参数，后续的都作废了)
 * @param string           $alias     （如果有的话）文章别名
 * @param bool             $isrewrite  是否启用urlrewrite
 * @param array            $object     把1.7里新增array型参数传给旧版本的接口
 *
 * @api Filter_Plugin_ViewPost_Begin
 * @api Filter_Plugin_ViewPost_Begin_V2
 * @api Filter_Plugin_ViewPost_Template
 *
 * @throws Exception
 *
 * @return string
 */

function ViewPost($id = null, $alias = null, $isrewrite = false, $object = array())
{
    global $zbp;
    $fpargs = func_get_args();

    $fpargs_count = count($fpargs);

    //新版本的函数V2 (v2版本传入的第一个参数是array且只传一个array)
    foreach ($GLOBALS['hooks']['Filter_Plugin_ViewPost_Begin_V2'] as $fpname => &$fpsignal) {
        $fpreturn = $fpname($id);
        if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
            $fpsignal = PLUGIN_EXITSIGNAL_NONE;

            return $fpreturn;
        }
    }

    //修正首个参数使用array而不传入后续参数的情况
    if (is_array($id) && $fpargs_count == 1) {
        $object = $id;
        $isrewrite = true;
        $posttype = GetValueInArray($object, 'posttype', 0);
        $canceldisplay = GetValueInArray($object, 'canceldisplay', false);
        $route = GetValueInArray($object, 'route', array());
        $alias = GetValueInArray($object, 'alias', null);
        $id = GetValueInArray($object, 'id', null);
        //从别名post中读取正确的$id或$alias
        if (isset($route['args']) && is_array($route['args'])) {
            $parameters = UrlRule::ProcessParameters($route);
            foreach ($parameters as $key => $value) {
                if ($value['name'] == 'id' && $value['alias'] != '') {
                    $id = GetValueInArray($object, $value['alias'], null);
                }
                if ($value['name'] == 'alias' && $value['alias'] != '') {
                    $alias = GetValueInArray($object, $value['alias'], null);
                }
            }
        }
    } else {
        if (!is_array($object)) {
            $object = array();
        }
        $canceldisplay = GetValueInArray($object, 'canceldisplay', false);
        $route = GetValueInArray($object, 'route', array());
        $posttype = GetValueInArray($object, 'posttype', 0);
        if (is_array($id)) {
            $object = array_merge($object, $id);
            $id = isset($object['id']) ? $object['id'] : null;
            $alias = isset($object['alias']) ? $object['alias'] : null;
        } else {
            $object['id'] = $id;
            $object['alias'] = $alias;
            $object[0] = empty($alias) ? $id : $alias;
        }
    }

    //兼容老版本的接口
    foreach ($GLOBALS['hooks']['Filter_Plugin_ViewPost_Begin'] as $fpname => &$fpsignal) {
        $fpargs_v1 = array($id, $alias, $isrewrite, $object);
        $fpreturn = call_user_func_array($fpname, $fpargs_v1);
        if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
            $fpsignal = PLUGIN_EXITSIGNAL_NONE;

            return $fpreturn;
        }
    }

    $select = '';
    $w = array();
    $order = null;
    $limit = 1;
    $option = null;

    $w[] = array('=', 'log_Type', $posttype);

    if ($id !== null && is_numeric($id)) {
        if (function_exists('ctype_digit') && !ctype_digit((string) $id)) {
            $zbp->ShowError(3, __FILE__, __LINE__);
        }

        $w[] = array('=', 'log_ID', $id);
    } elseif ($alias !== null) {
        if ($zbp->option['ZC_POST_ALIAS_USE_ID_NOT_TITLE'] == false) {
            $w[] = array('array', array(array('log_Alias', $alias), array('log_Title', $alias)));
        } else {
            $w[] = array('array', array(array('log_Alias', $alias), array('log_ID', $alias)));
        }
    } else {
        $zbp->ShowError(2, __FILE__, __LINE__);
        exit;
    }

    if (empty($zbp->user->ID)) {
        $w[] = array('=', 'log_Status', 0);
    }

    foreach ($GLOBALS['hooks']['Filter_Plugin_ViewPost_Core'] as $fpname => &$fpsignal) {
        $fpname($select, $w, $order, $limit, $option);
    }

    $articles = $zbp->GetPostList($select, $w, $order, $limit, $option);
    if (count($articles) == 0) {
        if (!empty($route) || $isrewrite == true) {
            return false;
        }
        $zbp->ShowError(2, __FILE__, __LINE__);
    }

    $article = $articles[0];

    if ($posttype != $article->Type) {
        return false;
    } else {
        $classname = $zbp->GetPostType($posttype, 'classname');
        if (strcasecmp(get_class($article), $classname) != 0) {
            $newarticle = $article->Cloned(false, $classname);
            $article = $newarticle;
            $zbp->AddPostCache($article);
        }
    }

    if ($article->Status != 0 && !$zbp->CheckRights($article->TypeActions['all']) && ($article->AuthorID != $zbp->user->ID)) {
        $zbp->ShowError(2, __FILE__, __LINE__);
    }

    if (!empty($route) || $isrewrite == true) {
        if (isset($object[0]) && !isset($object['page'])) {
            if (!(stripos(urldecode($article->Url), $object[0]) !== false)) {
                //$zbp->ShowError(2, __FILE__, __LINE__);
                return false;
            }
        }
    }

    $zbp->LoadTagsByIDString($article->Tag);

    if (isset($zbp->option['ZC_VIEWNUMS_TURNOFF']) && $zbp->option['ZC_VIEWNUMS_TURNOFF'] == false) {
        $article->ViewNums += 1;
        $sql = $zbp->db->sql->Update($zbp->table['Post'], array('log_ViewNums' => $article->ViewNums), array(array('=', 'log_ID', $article->ID)));
        $zbp->db->Update($sql);
    }

    $pagebar = new Pagebar('javascript:zbp.comment.get(\'' . $article->ID . '\',\'{%page%}\');', false);
    $pagebar->PageCount = $zbp->commentdisplaycount;
    $pagebar->PageNow = 1;
    $pagebar->PageBarCount = $zbp->pagebarcount;
    $pagebar->UrlRule->RulesObject = &$article;

    if ($zbp->option['ZC_COMMENT_TURNOFF']) {
        $article->IsLock = true;
    }

    $comments = array();

    if (!$article->IsLock && $zbp->socialcomment == null) {
        $comments = $zbp->GetCommentList(
            '*',
            array(
                array('=', 'comm_LogID', $article->ID),
                array('=', 'comm_RootID', 0),
                array('=', 'comm_IsChecking', 0),
            ),
            array('comm_ID' => ($zbp->option['ZC_COMMENT_REVERSE_ORDER'] ? 'DESC' : 'ASC')),
            array(($pagebar->PageNow - 1) * $pagebar->PageCount, $pagebar->PageCount),
            array('pagebar' => $pagebar)
        );
        $rootid = array();
        foreach ($comments as &$comment) {
            $rootid[] = $comment->ID;
        }
        $comments2 = $zbp->GetCommentList(
            '*',
            array(
                array('=', 'comm_LogID', $article->ID),
                array('IN', 'comm_RootID', $rootid),
                array('=', 'comm_IsChecking', 0),
            ),
            array('comm_ID' => ($zbp->option['ZC_COMMENT_REVERSE_ORDER'] ? 'DESC' : 'ASC')),
            null,
            null
        );
        $floorid = (($pagebar->PageNow - 1) * $pagebar->PageCount);
        foreach ($comments as &$comment) {
            $floorid += 1;
            $comment->FloorID = $floorid;
            $comment->Content = FormatString($comment->Content, '[enter]');
            if ($zbp->autofill_template_htmltags && strpos($zbp->template->templates['comment'], 'id="AjaxComment') === false) {
                $comment->Content .= '<label id="AjaxComment' . $comment->ID . '"></label>';
            }
        }
        foreach ($comments2 as &$comment) {
            $comment->Content = FormatString($comment->Content, '[enter]');
            if ($zbp->autofill_template_htmltags && strpos($zbp->template->templates['comment'], 'id="AjaxComment') === false) {
                $comment->Content .= '<label id="AjaxComment' . $comment->ID . '"></label>';
            }
        }
    }

    $zbp->LoadMembersInList($comments);

    $zbp->template->SetTags('posttype', $article->Type);
    $zbp->template->SetTags('title', ($article->Status == 0 ? '' : '[' . $zbp->lang['post_status_name'][$article->Status] . ']') . $article->Title);
    $zbp->template->SetTags('url', $article->Url);
    $zbp->template->SetTags('article', $article);
    $zbp->template->SetTags('type', $article->TypeName);
    $zbp->template->SetTags('page', 1);

    if ($pagebar->PageAll == 0 || $pagebar->PageAll == 1) {
        $pagebar = null;
    }
    $zbp->template->SetTags('pagebar', $pagebar);
    $zbp->template->SetTags('commentspagebar', $pagebar);
    $zbp->template->SetTags('commentspage', 1);
    $zbp->template->SetTags('comments', $comments);

    $zbp->template->SetTags('args', $fpargs);
    $zbp->template->SetTags('route', $route);

    if ($zbp->template->hasTemplate($article->Template)) {
        $zbp->template->SetTemplate($article->Template);
    } else {
        $zbp->template->SetTemplate($zbp->option['ZC_POST_DEFAULT_TEMPLATE']);
    }

    foreach ($GLOBALS['hooks']['Filter_Plugin_ViewPost_Template'] as $fpname => &$fpsignal) {
        $fpreturn = $fpname($zbp->template);
        if ($fpsignal == PLUGIN_EXITSIGNAL_RETURN) {
            $fpsignal = PLUGIN_EXITSIGNAL_NONE;

            return $fpreturn;
        }
    }

    if ($canceldisplay == false) {
        $zbp->template->Display();
    } else {
        return $zbp->template->GetTags('url');
    }

    return true;
}
?>