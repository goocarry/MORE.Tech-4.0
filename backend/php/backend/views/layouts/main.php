<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use ityakutia\materialadmin\assets\MaterialAdminAsset;
use uraankhayayaal\materializecomponents\alert\Toast;

$adminBundle = MaterialAdminAsset::register($this);

$isCustomFaviconLogo = isset(Yii::$app->params['materialadmin_module']) ? isset(Yii::$app->params['materialadmin_module']['custom_assets']) ? isset(Yii::$app->params['materialadmin_module']['custom_assets']['logo_favicon']) : false : false;
$customFaviconLogoPath = $isCustomFaviconLogo ? Yii::$app->params['materialadmin_module']['custom_assets']['logo_favicon'] : null;


?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $isCustomFaviconLogo ? $customFaviconLogoPath : ($adminBundle->baseUrl.'/favicon/apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $isCustomFaviconLogo ? $customFaviconLogoPath : ($adminBundle->baseUrl.'/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $isCustomFaviconLogo ? $customFaviconLogoPath : ($adminBundle->baseUrl.'/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?= $adminBundle->baseUrl; ?>/favicon/site.webmanifest">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <?= $this->render('_topBar', [
        'adminBundle' => $adminBundle,
        'isCustomFaviconLogo' => $isCustomFaviconLogo,
        'customFaviconLogoPath' => $customFaviconLogoPath,
    ]); ?>
    <?= $this->render('_sideNavMain'); ?>

    <main>
        <?= Toast::widget() ?>
        <?= $content ?>
    </main>

    <footer class="page-footer">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">IT Yakutia</h5>
                <p class="grey-text text-lighten-4"><a href="https://ityakutia.ru">https://ityakutia.ru</a></p>
                <p class="grey-text text-lighten-4"><a href="mailto:manager@admin14.ru">manager@admin14.ru</a></p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Соцсети</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" target="_blank" href="https://www.instagram.com/ityakutia.ru/">IT Yakutia - instagram</a></li>
                    <li><a class="grey-text text-lighten-3" target="_blank" href="https://www.youtube.com/channel/UC2rlE5deBK7_KSl5Nsozw7w">IT Yakutia - youtube</a></li>
                    <li><a class="grey-text text-lighten-3" target="_blank" href="https://www.facebook.com/ityakutia">IT Yakutia - facebook</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="row">
                <div class="col s12">
                    &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>
                </div>
            </div>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
