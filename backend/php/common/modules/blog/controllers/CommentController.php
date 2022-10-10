<?php

namespace common\modules\blog\controllers;

use Yii;
use yii\rest\ActiveController;
use bizley\jwt\JwtHttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;
use common\modules\blog\models\BlogCommentSearch;

class CommentController extends ActiveController
{
    public $modelClass = 'common\modules\blog\models\BlogComment';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        $actions['index'] = [
            'class' => 'yii\rest\IndexAction',
            'modelClass' => $this->modelClass,
            'prepareDataProvider' => function () {
                $searchModel = new BlogCommentSearch();
                return $searchModel->search(Yii::$app->request->queryParams);
            },
        ];
        return $actions;
    }
}