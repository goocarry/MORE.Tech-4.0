<?php

use yii\helpers\Url;

?>

    <li><a class="subheader grey-text"><?= Yii::t('app', 'Ботанический сад')?></a></li>

    <li class="<?= (Yii::$app->controller->id=='back-familia')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/catalog/back-familia/index') ?>"><i class="material-icons">nature_people</i> <?= Yii::t('app', 'Семейства') ?></a></li>
    <li class="<?= (Yii::$app->controller->id=='back-collection')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/catalog/back-collection/index') ?>"><i class="material-icons">folder_open</i> <?= Yii::t('app', 'Коллекции') ?></a></li>
    <li class="<?= (Yii::$app->controller->id=='back-rarity')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/catalog/back-rarity/index') ?>"><i class="material-icons">equalizer</i> <?= Yii::t('app', 'Редкости') ?></a></li>
    <li class="<?= (Yii::$app->controller->id=='back-catalog')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/catalog/back-catalog/index') ?>"><i class="material-icons">spa</i> <?= Yii::t('app', 'Каталог') ?></a></li>
    
    <li class="<?= (Yii::$app->controller->module->id=='collective')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/collective/back/index') ?>"><i class="material-icons">people</i> <?= Yii::t('app', 'Коллектив') ?></a></li>

    <?php if(Yii::$app->user->can("event")) { ?>
        <li><a class="subheader grey-text"><?= Yii::t('app', 'Дайджест')?></a></li>
        <!-- <li class="<?= (Yii::$app->controller->module->id=='event' && Yii::$app->controller->id=='back-district')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/event/back-district/index') ?>"><i class="material-icons">people</i> <?= Yii::t('app', 'Районы') ?></a></li> -->
        <li class="<?= (Yii::$app->controller->module->id=='event' && Yii::$app->controller->id=='back-category')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/event/back-category/index') ?>"><i class="material-icons">list</i> <?= Yii::t('app', 'Категории') ?></a></li>
        <li class="<?= (Yii::$app->controller->module->id=='event' && Yii::$app->controller->id=='back')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/event/back/index') ?>"><i class="material-icons">assignment</i> <?= Yii::t('app', 'Дайджест') ?></a></li>
        <!-- <li class="<?= (Yii::$app->controller->module->id=='event' && Yii::$app->controller->id=='back-info')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/event/back-info/index') ?>"><i class="material-icons">people</i> <?= Yii::t('app', 'Культурные мероприятия') ?></a></li>
        <li class="<?= (Yii::$app->controller->module->id=='event' && Yii::$app->controller->id=='back-notice')?'active':''; ?>"><a class="waves-effect waves-teal" href="<?= Url::toRoute('/event/back-notice/index') ?>"><i class="material-icons">people</i> <?= Yii::t('app', 'Советы специалистов') ?></a></li> -->
    <?php } ?>