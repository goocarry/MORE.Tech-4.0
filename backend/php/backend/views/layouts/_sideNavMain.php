<?php

use yii\helpers\Html;
use yii\helpers\Url;

$isCustomNavLogo = isset(Yii::$app->params['materialadmin_module']) ? isset(Yii::$app->params['materialadmin_module']['custom_assets']) ? isset(Yii::$app->params['materialadmin_module']['custom_assets']['logo_sidenav']) : false : false;
$customNavLogoPath = $isCustomNavLogo ? Yii::$app->params['materialadmin_module']['custom_assets']['logo_sidenav'] : null;

?>

<ul id="slide-out" class="sidenav sidenav-fixed">
    <li class="logo"><a href="<?= Url::home() ?>" style="<?= $isCustomNavLogo ? ('background-image: url('.$customNavLogoPath.');') : null; ?>"></a></li>

    <li class="no-padding <?= (Yii::$app->controller->module->id === 'materialadmin' && Yii::$app->controller->id === 'profile')?'active':'' ?>">
        <ul class="collapsible collapsible-accordion white-text">
            <li class="<?= Yii::$app->controller->id === 'profile' ? 'active' : '' ?>">
            <a class="collapsible-header waves-effect waves-blue white-text tooltipped" data-position="right" data-tooltip="Нажмите чтобы открыть"><i class="material-icons white-text">account_circle</i><b style="font-size: 1.6rem;"><?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?></b><br/><i class="material-icons white-text">mail</i><?= Yii::$app->user->isGuest ? null : Yii::$app->user->identity->email ?></a>
                <div class="collapsible-body">
                    <ul class="">
                        <?php if (!Yii::$app->user->can('doNotChangeCredentials')) { ?>
                        <li class="<?= (Yii::$app->controller->module->id === 'materialadmin' && Yii::$app->controller->id === 'profile' && Yii::$app->controller->action->id === 'index') ? 'active' : '' ?>"><a class="waves-effect waves-blue white-text" href="<?= Url::toRoute('/materialadmin/profile/index') ?>"><i class="material-icons white-text">person</i> Личный кабинет</a></li>
                        <li class="<?= (Yii::$app->controller->module->id === 'materialadmin' && Yii::$app->controller->id === 'profile' && Yii::$app->controller->action->id === 'change') ? 'active' : '' ?>"><a class="waves-effect waves-blue white-text" href="<?= Url::toRoute('/materialadmin/profile/change') ?>"><i class="material-icons white-text">security</i> Изменить пароль</a></li>
                        <?php } ?>
                        <li><?= Html::a('Выйти <i class="material-icons white-text">exit_to_app</i>', ['/materialadmin/profile/logout'], ['data' => ['method' => 'post'], 'class' => 'waves-effect waves-blue white-text']) ?></li>
                    </ul>
                </div>
            </li>
        </ul>
    </li>
    
    <?php if(Yii::$app->user->can("navigation") || Yii::$app->user->can("page")) { ?>
        <li><a class="subheader grey-text"><?= Yii::t('app', 'Структура')?></a></li>
    <?php } ?>

    <?php if(Yii::$app->user->can("page")) { ?>
        <li class="<?= (Yii::$app->controller->module->id=='page' && Yii::$app->controller->id=='back')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/page/back/index') ?>"><i class="material-icons">pageview</i> <?= Yii::t('app', 'Страницы') ?></a></li>
    <?php } ?>

    <?php if(Yii::$app->user->can("navigation")) { ?>
        <li class="<?= (Yii::$app->controller->module->id=='navigation' && Yii::$app->controller->id=='back')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/navigation/back/index') ?>"><i class="material-icons">clear_all</i> <?= Yii::t('app', 'Вверхнее меню') ?></a></li>
    <?php } ?>

    <?= $this->render("@backend/views/layouts/_sidenav"); ?>

    <?php if(Yii::$app->user->can("news_category") || Yii::$app->user->can("news")) { ?>
        <li><a class="subheader grey-text"><?= Yii::t('app', 'Эко просвещение')?></a></li>
    <?php } ?>
    <?php if(Yii::$app->user->can("news_category")) { ?>
        <li class="<?= (Yii::$app->controller->module->id=='blog' && Yii::$app->controller->id=='back-category')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/blog/back-category/index') ?>"><i class="material-icons">list</i> <?= Yii::t('app', 'Категории') ?></a></li>
    <?php } ?>
    <?php if(Yii::$app->user->can("news")) { ?>
        <li class="<?= (Yii::$app->controller->module->id=='blog' && Yii::$app->controller->id=='back')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/blog/back/index') ?>"><i class="material-icons">send</i> <?= Yii::t('app', 'Статьи') ?></a></li>
    <?php } ?>
    
    <?php if(Yii::$app->user->can("rbac_permissions") || Yii::$app->user->can("rbac_roles") || Yii::$app->user->can("rbac_users") || Yii::$app->user->can("settings")) { ?>
        <li><a class="subheader grey-text"><?= Yii::t('app', 'Администрирование') ?></a></li>
    <?php } ?>
    <?php if(Yii::$app->user->can("rbac_permissions")) { ?>
        <li class="<?= (Yii::$app->controller->id == 'permission')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/rbac/permission/index') ?>"><i class="material-icons">check_circle</i> <?= Yii::t('app', 'Права') ?></a></li>
    <?php } ?>
    <?php if(Yii::$app->user->can("rbac_roles")) { ?>
        <li class="<?= (Yii::$app->controller->id == 'role')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/rbac/role/index') ?>"><i class="material-icons">perm_identity</i> <?= Yii::t('app', 'Роли') ?></a></li>
    <?php } ?>
    <?php if(Yii::$app->user->can("rbac_users")) { ?>
        <li class="<?= (Yii::$app->controller->id == 'user')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/rbac/user/index') ?>"><i class="material-icons">supervisor_account</i> <?= Yii::t('app', 'Пользователи') ?></a></li>
    <?php } ?>
    <?php if(Yii::$app->user->can("settings")) { ?>
        <li class="<?= (Yii::$app->controller->module->id == 'setting')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/setting/back/index') ?>"><i class="material-icons">settings</i> <?= Yii::t('app', 'Параметры') ?></a></li>
    <?php } ?>

    <br>
    <br>
    <br>
    <br>
    <br>
</ul>