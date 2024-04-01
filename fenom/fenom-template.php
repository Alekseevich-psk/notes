{extends 'file:templates/layout.tpl'}
{block 'main'}
{/block}

{include "file:templates/document.tpl"}
{include "file:templates/service.tpl"}
{include "file:templates/contacts.tpl"}
{include "file:templates/document-list.tpl"}

{$_modx->resource['tb1-title']}
{$_modx->runSnippet('phone') | phone}

{include "file:templates/index.tpl"}
{include 'file:chunks/head.tpl'}

{$_modx->resource | print}
{$order | print}
{$_pls['tv.picture']}
{$_pls['tv.picture'] | phpthumbon : "w=480&h=200&zc=95"}

{set $rows = json_decode($id | resource : 'service-tv', true)}
{foreach $rows as $row}
{set $photo = '/assets/template/gallery/' ~ $row.picture}
<a class="services__link carousel__slide" data-fancybox="gallery" data-src="{$photo}" data-caption="{$row.title}">
    <img class="services__picture" src="{$photo | phpthumbon : " w=180&h=140&zc=1"}" />
</a>
{/foreach}

{if $_modx->hasSessionContext('mgr')}
<div style="color:#000;position:fixed;bottom:0;width:100%; background-color:#fff;z-index:50;">
    {set $info = $_modx->getInfo('', false)}
    <span>Время работы: {$info.totalTime}</span>
    <span>Время запросов: {$info.totalTime}</span>
    <span>Количество запросов: {$info.queries}</span>
    <span>Источник: {$info.source}</span>
</div>
{/if}

{$_modx->runSnippet('copyYears', ['start' => '2021',])}
<base href="{$_modx->config.site_url}">
{$_modx->resource.description}
{$_modx->resource.content}
{$_modx->resource.pagetitle}
{$_modx->resource.longtitle}
{$_modx->resource.introtext}
{$_modx->resource.parent}
{$_modx->resource.publishedon | date_format:"%d-%m-%Y %H:%M:%S"}
{$id | url}

{set $phone = $_modx->config.phone}
{set $email = $_modx->config.email}
{set $adress = $_modx->config.adress}

{block 'main'}
{/block}

[[*longtitle:default=`[[*pagetitle]]`]]

'tpl' => '@FILE:chunks/newsInner.tpl'

// Получение значения TV у произвольного ресурса:
{1 | resource: 'tv_name'}

// Вывод в чанках
{$pagetitle}
{$description}

// Вывод
{$_modx->resource.id} - вывод id текущего ресурса
{$_modx->resource.tv_name} - вывод tv текущего ресурса
{$_modx->user}- массив текущего пользователя
{$_modx->makeUrl(10)} - ссылка на 10 ресурс
{$_modx->config.system_setting} - вывод системной настройки
{$_modx->resource.parent | resource : 'tv_name'}

{$_modx->runSnippet('phone', ['input' => $phoneMsk])}

//MS2
{$id | resource: 'price'}

[[*id]] {$_modx->resource.id}
[[*tv_param]] {$_modx->resource.tv_param}
[[%lexicon]] {$_modx->lexicon('lexicon')}
[[~15]] {$_modx->makeUrl(15)}
[[~[[*id]]]] {$_modx->makeUrl($_modx->resource.id)}
[[++system_setting]] {$_modx->config.system_setting}
[[~[[*id]]]] {$_modx->resource.id | url}
[[~[[+id]]]] {$id | url}
[[~[[!+some.placeholder]]]] {var $plcholder= $_modx->getPlaceholder('some.placeholder')}

{$plcholder | url}

[[~9]] {9 | url}
[[#9.pagetitle]] {9 | resource : 'pagetitle'}
[[*parent]] {$_modx->resource.parent}
[[+parent]] {$parent}
[[#[[!+some.placeholder]].parent]] {$_modx->getPlaceholder('some.placeholder') | resource : 'parent'}
[[!#get]] {$.get | print_r}


// Вывод MIGX через Fenom для текущего ресурса:
{set $rows = json_decode($_modx->resource.tv_images, true)}
{foreach $rows as $row}
{$row.image}
{/foreach}

{set $rows = (1 | resource: "mainSlider") | fromJSON}
{foreach $rows as $row}
<div class="main__slide swiper-slide">
    <div class="main__slide-bg">
        {set $pictureForSlider = './assets/template/files_user/' ~ $row.picture}
        <img src="{$pictureForSlider | phpthumbon : " w=1920&h=800&zc=95"}" alt="">
    </div>
    <div class="container">
        <div class="main__wrap-utp">
            <div class="main__title">{$row.title}</div>
            <div class="main__desc">{$row.desc}</div>
            <div class="main__btns-wrap">
                <a href="{$row.link | url}" class="main__btn main__btn--link">Подробнее</a>
                <button class="main__btn main__btn--order open__popup">Оставить заявку</button>
            </div>
        </div>
    </div>
</div>
{/foreach}

// Вывод MIGX через Fenom для определенного ресурса:
{set $rows = json_decode(1 | resource: 'tvname', true)}
{foreach $rows as $row}
{$row.image}
{/foreach}

// Получение изображения через переменную с точкой ($_pls)
{$_pls["tv.img"] | phpthumbon : "w=300&h=200&zc=1"}
//Без префикса
{$img | phpthumbon : "w=300&h=200&zc=1"}

//Получение превью изображений в корзине
{if $product['120x90']?}
<img src="{$product['120x90']}" alt="{$product.pagetitle}" title="{$product.pagetitle}" />
{else}
<img src="{'assets_url' | option}components/minishop2//web/ms2_small.png" srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x" alt="{$product.pagetitle}" title="{$product.pagetitle}" />
{/if}

//Проверка авторизации
{$_modx->isAuthenticated()}
{$_modx->hasSessionContext('web')}
{$_modx->hasPermission('load')}


// Модификатор дата
{$_modx->resource.publishedon | date_format:"%d-%m-%Y %H:%M:%S"}

// Устанавливаем id текущей страницы в переменную
{set $id = $_modx->resource.id}
#Условие
{if $id == '1'}
<p>Главная страница</p>
{else}
<p>Не главная</p>
{/if}

{if $_modx->resource.id == 1}
<img class="headerLogo" src="/assets/templates/img/logo.svg" alt="" />
{else}
<img class="headerLogoPage" src="/assets/templates/img/logo.svg" alt="" />
{/if}

// выбор между полями
{$_modx->resource.longtitle ? $_modx->resource.longtitle : $_modx->resource.pagetitle}

// значение по умолчанию
{$_modx->resource.introtext ?: 'аннотация не заполнена'}


{if $message}
{else}
{/if}

{'!pdoPage' | snippet : [
'parents' => $_modx->resource.id,
'limit' => 5,
'toPlaceholder' => 'result'
]}

{'result' | placeholder}
{'page.total' | placeholder}
{'page.nav' | placeholder}


[[!msOrdersProducts?
&order=[[+id]]
&tpl=`tpl.order_row`
&tpl_empty=`tpl.order_row_empty`
]]

{$_modx->runSnippet('!pdoResources',[
'parents' => 12,
'includeTVs' => 'imgSlide',
'tpl' => '@FILE chunks/stockChunk.tpl'
])}


{set $rows = json_decode(18 | resource : 'addPdf', true)}
{foreach $rows as $row}
<div class="gratitude_slide"><img src="/assets/uploads/{$row.image}" alt="{$row.caption}" /></div>
{/foreach}


{$_modx->config.vk}
{$_modx->config.adress}


<div class="breadcrumb">
    <nav>
        {'!pdoCrumbs' | snippet : [
        'showHome' => 1,
        'showAtHome' => 0,
        'showHome' => 0,
        'tpl' => '@INLINE <li class="visited"><a title="{$menutitle}" itemprop="item" href="{$link}">{$menutitle}</a></li>',
        'tplWrapper' => '@INLINE <ol>{$output}</ol>',
        'tplCurrent' => '@INLINE <li class="visited">{$menutitle}</li>'
        ]}
    </nav>
</div>

<div class="col-xl-3 col-md-6 col-xs-12 mb-3 service-card">
    <img src="{$_pls['tv.picture'] | phpthumbon : " w=480&h=200&zc=95"}" alt="{$longtitle}">
    <a href="{$id | url}" class="slider__link">
        <div class="slider__sub-title">{$longtitle}</div>
    </a>
    {set $rows = ($id | resource: "tableServiceCards") | fromJSON}
    {foreach $rows as $row}
    <div class="price_cards">Цена: <b>{$row.price} руб.</b></div>
    {/foreach}
    <button class="btn col-md-12 mb-2 header__btn order-sushka-sl">Заказать</button>
</div>


{$_modx->runSnippet('FormIt', [
'hooks' => 'email,redirect',
'emailSubject' => 'Заявка с сайта: обратный звонок',
'emailTpl' => 'kontact-form_phone_name',
'emailTpl' => $_modx->config.email,
'emailFrom' => 'no-reply@karsan60.ru',
'redirectTo' => 17,
'submitVar' => 'myform1',
])}



{$_modx->runSnippet('!pdoPage',[
'element' => 'pdoResources',
'parents' => 11,
'pageLimit'=>3,
'limit'=> 10,
'showHidden'=>1,
'tpl' => '@FILE:chunks/newsInner.tpl',
])}

{'pdoResources' | snippet : [
'parents' => '54',
'resources' => '55,56,57,72,73,91,71',
'sortdir' => 'ASC',
'limit' => 8,
'includeContent' => '1',
'includeTVs' => 'picture',
'tpl' => '@FILE chunks/slider/service-slider-index.tpl'
]}

{set $emailFrom = 'mail_smtp_user'|option}
{$_modx->runSnippet('!AjaxForm', [
'snippet' => 'FormIt',
'form' => 'tpl.AjaxForm.link',
'hooks' => 'email',
'emailTpl' => 'tpl.email.question',
'emailSubject' => 'Тема письма',
'emailTo' => 'example@mail.ru',
'emailFrom' => $emailFrom,
'validate' => 'message:required',
'validationErrorMessage' => 'Ошибки при заполнении формы',
'successMessage' => 'Сообщение успешно отправлено!'
])}

{$_modx->runSnippet('pdoMenu', [
'parents'=> '0',
'level' => 1,
'tplOuter' => '@INLINE <ul>[[+wrapper]]</ul>',
'tpl' => '@INLINE <li><a href="[[+link]]">[[+pagetitle]]</a>[[+wrapper]]</li>',
'tplHere' => '@INLINE <li class="active"><a href="[[+link]]">[[+pagetitle]]</a>[[+wrapper]]</li>',
])}


{set $title = ($_modx->resource.longtitle ? : $_modx->resource.pagetitle) | notags}
{set $description = ($_modx->resource.description) | replace :' "':' «' | replace :'"':'»'}
{set $sitename = ('site_name' | config) | replace :' "':' «' | replace :'"':'»'}
{set $page = 'site_url' | config ~ $_modx->resource.uri}



<base href="{'site_url' | config}">
<title>{$title}</title>
<meta property="og:type" content="website">
<meta property="og:site_name" content="{$sitename}">
<meta property="og:title" content="{$title}">
<meta property="og:description" content="{$description}">
<meta property="og:url" content="{$page}">
<meta property="og:locale" content="uk_UA">

<meta name="twitter:card" content="summary">
<meta name="twitter:title" content="{$title}">
<meta name="twitter:description" content="{$description}">
<meta name="twitter:url" content="{$page}">
<meta name="twitter:domain" content="{'site_url' | config}">
<meta name="twitter:site" content="@site_account">
<meta name="twitter:creator" content="@individual_account">