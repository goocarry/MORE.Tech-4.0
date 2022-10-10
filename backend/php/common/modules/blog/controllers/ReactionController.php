<?php

namespace common\modules\blog\controllers;

use yii\rest\ActiveController;
use bizley\jwt\JwtHttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

class ReactionController extends ActiveController
{
    public $modelClass = 'common\modules\blog\models\BlogReaction';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'corsFilter' => [
                'class' => Cors::class,
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Allow-Origin' => ['*'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Request-Methods' => ['*'],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Max-Age' => 3600,
                ],
            ],
            'authenticator' => [
                'class' => JwtHttpBearerAuth::class,
                'except' => ['options'],
            ],
        ]);
    }
}