<?php
require_once('modxconnect.php');
require_once('installpackages.php');

//Установка минимального набора дополнений
installPackage('sdStore');
installPackage('pdoTools');
installPackage('AdminTools');
installPackage('debugParser');
installPackage('tagElementPlugin');
installPackage('translit');
installPackage('Console');
installPackage('MIGX');
installPackage('mixedImage');
installPackage('phpThumbOn');
installPackage('pdoTools', 2);
installPackage('controlErrorLog', 2);
installPackage('debugParser', 2);
installPackage('Ace', 2);
installPackage('TinyMCE Rich Text Editor');
installPackage('FormIt');
installPackage('settingsWidget');
installPackage('AjaxForm');
installPackage('Collections');
installPackage('FastUploadTV');
installPackage('filetranslit');
// installPackage('Image SEO alt and title tags');
// installPackage('SEO Pro');
installPackage('Summary');
installPackage('ClientConfig');
// installPackage('Gallery');
echo 'Пакеты установлены!</br>';
$modx->cacheManager->refresh();
echo 'Кэш обновлен!</br>';

//Выстваляем системные настройки
$settings = array(
    'site_name' => 'My Site',
    'container_suffix' => '',
    'friendly_urls' => 1,
    'friendly_urls_strict' => 1,
    'global_duplicate_uri_check' => 1,
    'use_alias_path' => 1,
    'use_frozen_parent_uris' => 1,
    'upload_maxsize' => 629145600,
    'pdotools_fenom_parser' => 1,
    //'pdotools_fenom_options' => '{"force_include":true}',
    'friendly_alias_translit' => 'russian',
    'ace.theme' => 'twilight',
    'ace.font_size' => '16px',
    'request_method_strict' => 1,
    'locale' => 'ru_RU.UTF8',
    'fe_editor_lang' => 'ru',
    'enable_gravatar' => 0,
    'manager_date_format' => 'd-m-Y',
    'manager_time_format' => 'H:i',
    'manager_week_start' => '1',
    'resource_tree_node_name' => 'menutitle',
    'site_unavailable_message' => 'Сайт временно не доступен! Попробуйте зайти позже.',
    'site_unavailable_page' => '1',
    'feed_modx_news_enabled' => 0,
    'feed_modx_security_enabled' => 0,
    'allow_multiple_emails' => 0,
    'resource_tree_node_tooltip' => '',
    'hidemenu_default' => 1,
    'link_tag_scheme' => 'abs',
    'publish_default' => '1',
);

//Устанавливаем системные настройки
foreach ($settings as $key => $value) {
    $setting = $modx->getObject('modSystemSetting', array(
        'key' => $key
    ));
    if (!$setting) {
        $setting = $modx->newObject('modSystemSetting', array(
            'key' => $key
        ));
    }
    $setting->set('value', $value);
    $setting->save();
    echo 'Настройка ' . $key . ' обновлена!';
    echo '<br>';
}
echo 'Все настройки установлены!</br>';
$modx->cacheManager->refresh();
echo 'Кэш обновлен!</br>';

//Установка типов содержимого
$ContentType = $modx->getObject('modContentType', array(
    'name' => 'HTML'
));
$ContentType->set('file_extensions', '');
$ContentType->save();
echo 'Content type text/html обновлен</br>';


//Шаблоны
$home_template = array(
    'templatename' => 'Главная',
    'description' => 'Шаблон главной страницы',
    'icon' => 'icon-home',
    'content' => '{include "file:templates/index.tpl"}'
);

$templates = array($home_template);

//Изменяем настройки шаблона главной страницы
$home_t = $modx->getObject('modTemplate', array('id' => 1));
foreach ($home_template as $key => $value) {
    $home_t->set($key, $value);
}
$home_t->save();
echo 'Шаблон главной страницы обновлен</br>';

$modx->cacheManager->refresh();
echo 'Кэш обновлен!</br>';

//Определяем настройки начальных ресурсов
$resources = array(
    '404' => array(
        'pagetitle' => '404',
        'template' => 1,
        'longtitle' => 'Страница не найдена',
        'alias' => '404',
        'context_key' => 'web',
        'parent' => 0,
        'hidemenu' => 1,
        'published' => 1,
        'menuindex' => 1
    ),
    'sitemap' => array(
        'pagetitle' => 'sitemap',
        'template' => 0,
        'alias' => 'sitemap',
        'contentType' => 'text/xml',
        'content_type' => 2,
        'richtext' => 0,
        'hidemenu' => 1,
        'published' => 1,
        'content' => '[[pdoSitemap]]',
        'uri' => 'sitemap.xml',
        'context_key' => 'web',
        'parent' => 0,
        'menuindex' => 2
    ),
    'robots' => array(
        'pagetitle' => 'robots',
        'template' => 0,
        'alias' => 'robots',
        'contentType' => 'text/plain',
        'content_type' => 3,
        'richtext' => 0,
        'hidemenu' => 1,
        'published' => 1,
        'content' => 'User-agent: *
Disallow: /manager/
Disallow: /assets/components/
Disallow: /core/
Disallow: /connectors/
Disallow: /index.php
Disallow: *?query
Host: [[++http_host]]
Sitemap: [[++site_url]]sitemap.xml',
        'uri' => 'robots.txt',
        'context_key' => 'web',
        'parent' => 0,
        'menuindex' => 3
    )
);

//ресурсы
foreach ($resources as $title => $resource) {
    $document = $modx->getObject('modResource', array(
        'alias' => $resource['alias']
    ));
    if ($document) {
        $resource['id'] = $document->get('id');
        $modx->runProcessor('resource/update', $resource);
        echo 'Ресурс ' . $title . ' обновлен!<br>';
    } else {
        $document = $modx->newObject('modResource', $resource);
        $document->save();
        echo 'Ресурс ' . $title . ' создан!<br>';
    }
}


//Выставляем служебные страницы в системных настройках
$document = $modx->getObject('modResource', array('alias' => '404'));
$doc_id = $document->get('id');
$Setting = $modx->getObject('modSystemSetting', 'error_page');
$Setting->set('value', $doc_id);
$Setting->save();

echo 'Ресурсы созданы и выставлены в системных настройках</br>';
$modx->cacheManager->refresh();
echo 'Кэш обновлен!</br>';

// Создаём базовую структуру файлов-шаблонов
$paths = array(
    "../core/elements/templates",
    "../core/elements/chunks",
    "../core/elements/snippets",
    "../core/elements/plugins",
    "../core/elements/chunks/forms",
    "../core/elements/chunks/emails",
    "../core/elements/chunks/analytics",
);
foreach ($paths as $foldpath) {
    mkdir($foldpath, 0755, true);
}
touch('../core/elements/templates/index.tpl');
echo 'Папки и файлы шаблонов созданы</br>';

//Создаём новый источник файлов в админке для шаблонов
$props = array(
    'basePath' => 'core/elements/ ',
    'basePathRelative' => array(
        'name' => 'basePathRelative',
        'desc' => 'prop_file.basePath_desc',
        'type' => 'combo-boolean',
        'value' => 1,
        'lexicon' => 'core:source'
    ),
    'baseUrl' => 'core/elements/',
    'baseUrlRelative' => array(
        'name' => 'baseUrlRelative',
        'desc' => 'prop_file.baseUrlRelative_desc',
        'type' => 'combo-boolean',
        'value' => 1,
        'lexicon' => 'core:source'
    )
);
if (!$mds = $modx->getObject('modMediaSource', array('name' => 'Fenom Templates'))){
    $fenom_templates_ms = $modx->newObject('modMediaSource');
    $fenom_templates_ms->set('name', 'Fenom Templates');
    $fenom_templates_ms->set('description', 'Шаблоны Феном');
    $fenom_templates_ms->setProperties($props);
    $fenom_templates_ms->save();
    $modx->cacheManager->refresh();
}

echo 'Источник файлов создан</br>';
echo 'Кэш обновлен!</br>';

// Создаём новый источник файлов в админке для пользователя
$props = array(
    'basePath' => 'assets/templets/files_user/ ',
    'basePathRelative' => array(
        'name' => 'basePathRelative',
        'desc' => 'prop_file.basePath_desc',
        'type' => 'combo-boolean',
        'value' => 1,
        'lexicon' => 'core:source'
    ),
    'baseUrl' => 'assets/templets/files_user/',
    'baseUrlRelative' => array(
        'name' => 'baseUrlRelative',
        'desc' => 'prop_file.baseUrlRelative_desc',
        'type' => 'combo-boolean',
        'value' => 1,
        'lexicon' => 'core:source'
    )
);
if (!$mds = $modx->getObject('modMediaSource', array('name' => 'userFilesSystem'))){
    $fenom_templates_ms = $modx->newObject('modMediaSource');
    $fenom_templates_ms->set('name', 'userFilesSystem');
    $fenom_templates_ms->set('description', 'Шаблоны Феном');
    $fenom_templates_ms->setProperties($props);
    $fenom_templates_ms->save();
    $modx->cacheManager->refresh();
}

echo 'Источник файлов создан</br>';
echo 'Кэш обновлен!</br>';

//Переименуем все htaccess файлы системы
$ht_paths = array(
    '../',
    '../core/',
    '../manager/'
);
foreach ($ht_paths as $ht_path) {
    rename($ht_path . 'ht.access', $ht_path . '.htaccess');
}
echo 'htaccess файлы переименованы</br>';
echo '<h1>Базовая настройка сайта завершена! Приятной разработки.</h1></br>';
echo '<a href="/">Перейти на главную страницу</a></br>';
