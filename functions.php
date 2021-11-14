<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    
    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('sidebarBlock', 
    array('ShowRecentPosts' => _t('显示最新文章'),
    'ShowRecentComments' => _t('显示最近回复'),
    'ShowCategory' => _t('显示分类'),
    'ShowArchive' => _t('显示归档'),
    'ShowOther' => _t('显示其它杂项')),
    array('ShowRecentPosts', 'ShowRecentComments', 'ShowCategory', 'ShowArchive', 'ShowOther'), _t('侧边栏显示'));
    
    $form->addInput($sidebarBlock->multiMode());

    $links = new Typecho_Widget_Helper_Form_Element_Textarea(
        'links',
        NULL,
        NULL,
        _t('友情链接'),
        _t('链接格式参考 <a href="https://mdr.docs.fsky7.com/function/links/">MDr</a>')
    );
    $form->addInput($links);
}


/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

function postThumb($obj)
{
    $thumb = $obj->fields->thumb;
    if (!$thumb) {
        return false;
    }
    if (is_numeric($thumb)) {
        preg_match_all('/<img.*?src="(.*?)".*?[\/]?>/i', $obj->content, $matches);
        if (isset($matches[1][$thumb - 1])) {
            $thumb = $matches[1][$thumb - 1];
        } else {
            return false;
        }
    }
    if (Helper::options()->AttUrlReplace) {
        $thumb = UrlReplace($thumb);
    }
    return '<img src="' . $thumb . '"  style="width: 100%" class="post-thumb"/>';
}

function themeFields($layout)
{

    $thumb = new Typecho_Widget_Helper_Form_Element_Text(
        'thumb',
        NULL,
        NULL,
        _t('自定义缩略图'),
        _t('在这里填入一个图片 URL 地址, 以添加本文的缩略图，若填入纯数字，例如 <b>3</b> ，则使用文章第三张图片作为缩略图（对应位置无图则不显示缩略图），留空则默认不显示缩略图')
    );
    $thumb->input->setAttribute('class', 'w-100');
    $layout->addItem($thumb);

    $catalog = new Typecho_Widget_Helper_Form_Element_Radio(
        'catalog',
        array(
            true => _t('启用'),
            false => _t('关闭')
        ),
        false,
        _t('文章目录'),
        _t('默认关闭，启用则会在文章内显示“文章目录”（若文章内无任何标题，则不显示目录）')
    );
    $layout->addItem($catalog);

    $licenses = new Typecho_Widget_Helper_Form_Element_Radio(
        'linceses',
        array(
            'BY' => _t('CC BY'),
            'BY-SA' => _t('CC BY-SA'),
            'BY-ND' => _t('CC BY-ND'),
            'BY-NC' => _t('CC BY-NC'),
            'BY-NC-SA' => _t('CC BY-NC-SA'),
            'BY-NC-ND' => _t('CC BY-NC-ND'),
            'NONE' => _t('没有')
        ),
        'NONE',
        _t('许可协议'),
        _t('默认没有协议，请前往 <a href="https://creativecommons.org/licenses/" target="_blank">CreativeCommons</a> 查看更多关于协议的内容，仅支持 4.0 ( 国际 ) 协议')
    );
    $layout->addItem($licenses);
}

function printLinks()
{
    $link = '';
    $list = Helper::options()->links ? explode("\r\n", Helper::options()->links) : [];

    $link .= '<div style="display: flex; display: -webkit-flex; justify-content: space-around; flex-wrap: wrap; flex-shrink: 0;">';
    foreach ($list as $val) {
        list($name, $url, $description, $logo) = explode(',', $val);
        $link .= <<<END
        <div style="display: flex; display: -webkit-flex; flex-direction: column; flex-shrink: 0; margin: 10px; height: 290px; width: 200px; border: 1px solid #AAAAAA">
            <div style="height: 200px; width: 100%; overflow: hidden;">
                <img src="$logo" title="$name" style="display: inline-block; max-width: 100%; height: auto;"/>
            </div>
            <a href="$url" target="_blank" title="$name" style="margin-top: 5px;">$name</a>
            <div style="background-color: white; margin-top: 5px;">$description</div>
        </div>
        END;
    }
    $link .= '</div>';
    echo $link ? $link : '<b>暂无链接</b>';
}
