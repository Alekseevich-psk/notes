<?php
require_once('modxconnect.php');

//Категории с элементами
$categories = array(
    'STRUCTURE' => array(
        'chunks' => array(
            'HEAD',
            'HEADER',
            'SCRIPTS',
            'FOOTER'
        )
    ),
    'WIDGETS' => array(),
    'TPL' => array(),
    'MEDIA' => array(
        'tvs' => array(
            array(
                'name' => 'tv_image',
                'caption' => 'Page image',
                'type' => 'image'
            ),
            array(
                'name' => 'tv_thumb',
                'caption' => 'Page thumbnail',
                'type' => 'image'
            ),
            array(
                'name' => 'tv_images',
                'caption' => 'Images',
                'type' => 'migx'
            ),
            array(
                'name' => 'tv_slider',
                'caption' => 'Slider',
                'type' => 'migx'
            )
        )
    ),
    'OPTIONS' => array(),
    'SEO' => array(
        'tvs' => array(
            array(
                'name' => 'meta_title',
                'caption' => 'META Title',
                'type' => 'text'
            ),
            array(
                'name' => 'meta_description',
                'caption' => 'META Description',
                'type' => 'textarea'
            ),
            array(
                'name' => 'meta_keywords',
                'caption' => 'META Keywords',
                'type' => 'textarea'
            ),
            array(
                'name' => 'meta_robots',
                'caption' => 'META Robots',
                'type' => 'listbox',
                'elements' => 'index, follow==index, follow||nofollow==noindex, nofollow',
                'default_text' => 'index, follow'
            )
        )
    )
);
//Настройки
$settings = array(
    'site_name' => '[[++site_url]] ',
    'upload_maxsize' => 20971520,
    'date_timezone' => 'Europe/Moscow',
    'friendly_urls' => 1,
    'use_alias_path' => 1,
    'friendly_alias_translit' => 'russian' //only if package "Translit" is installed
);
//Ресурсы
$resources = array(
    'home' => array(
        'id' => 1,
        'pagetitle' => 'Главная',
        'longtitle' => 'Главная страница',
        'alias' => 'index',
        'context_key' => 'web',
        'parent' => 0
    ),
    '404' => array(
        'pagetitle' => '404',
        'longtitle' => 'Page not found',
        'alias' => '404',
        'context_key' => 'web',
        'parent' => 0
    ),
    'sitemap' => array(
        'pagetitle' => 'Sitemap',
        'alias' => 'sitemap',
        'contentType' => 'text/xml',
        'content_type' => 2,
        'richtext' => 0,
        'hidemenu' => 1,
        'published' => 1,
        'content' => '[[pdoSitemap]]',
        'uri' => 'sitemap.xml',
        'context_key' => 'web',
        'parent' => 0
    )
);
//Шаблоны
$home_template = array(
    'templatename' => 'Главная',
    'description' => 'Шаблон главной страницы',
    'icon' => 'icon-home',
    'content' => '{include "file:templates/index.tpl"}'
);

//$templates = array($home_template);


//Создаем категории
foreach ($categories as $catname => $objects) {
    $category = $modx->getObject('modCategory', array(
        'category' => $catname
    ));
    if (!$category) {
        $category = $modx->newObject('modCategory');
        $category->set('parent', 0);
        $category->set('category', $catname);
        $category->save();
        echo '<br>';
        echo 'Категория ' . $catname . ' создана!';
        //создаем чанки
        if (array_key_exists('chunks', $objects)) {
            foreach ($objects['chunks'] as $chunkname) {
                $chunk = $modx->getObject('modChunk', array(
                    'name' => $chunkname
                ));
                if (!$chunk) {
                    $chunk = $modx->newObject('modChunk');
                    $chunk->set('name', $chunkname);
                    $chunk->set('category', $category->get('id'));
                    $chunk->save();
                    echo '<br>';
                    echo 'Чанк ' . $chunkname . ' создан!';
                } else {
                    echo '<br>';
                    echo 'Чанк ' . $chunkname . ' уже существует!';
                }
            }
        }
        //создаем tv
        if (array_key_exists('tvs', $objects)) {
            foreach ($objects['tvs'] as $tvname) {
                $tv = $modx->getObject('modTemplateVar', array(
                    'name' => $tvname['name']
                ));
                if (!$tv) {
                    $tv = $modx->newObject('modTemplateVar');
                    $tv->set('name', $tvname['name']);
                    $tv->set('caption', $tvname['caption']);
                    $tv->set('type', $tvname['type']);
                    $tv->set('category', $category->get('id'));
                    $tv->save();
                    echo '<br>';
                    echo 'TV ' . $tvname['name'] . ' создан!';
                } else {
                    echo '<br>';
                    echo 'TV ' . $tvname['name'] . ' уже существует!';
                }
            }
        }
    } else {
        echo '<br>';
        echo 'Категория ' . $catname . ' уже существует!';
    }
}

//Установка системных настроек
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

//Установка типов содержимого
$ContentType = $modx->getObject('modContentType', array(
    'name' => 'HTML'
));
$ContentType->set('file_extensions', '');
$ContentType->save();
echo 'Content type text/html обновлен</br>';

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

//Изменяем настройки шаблона главной страницы
$home_t = $modx->getObject('modTemplate', array('id' => 1));
foreach ($home_template as $key => $value) {
    $home_t->set($key, $value);
}
$home_t->save();
echo 'Темплейт главной обновлен</br>';

$modx->cacheManager->refresh();
echo 'Кэш обновлен!</br>';