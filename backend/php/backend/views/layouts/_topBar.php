<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

?>
<header>
    <nav>
        <div class="row">
            <div class="col s12">
        	    <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <?= Breadcrumbs::widget([
                    'tag' => false,
                    'itemTemplate' => "{link}",
                    'activeItemTemplate' => '<a class="breadcrumb truncate">{link}</a>',
                    'homeLink' => [
                        'label' => '<img src="' . ($isCustomFaviconLogo ? $customFaviconLogoPath : ($adminBundle->baseUrl.'/img/logo.png')) . '" alt="admin icon" height="15">',
                        'url' => Url::home(),
                        'encode' => false,
                        'class' => ' hide-on-med-and-down tooltipped',
                        'data-position' => "bottom",
                        'data-tooltip' => "Главная",
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [
                        $this->title,
                    ],
                ]); ?>
            </div>
        </div>
    </nav>
</header>