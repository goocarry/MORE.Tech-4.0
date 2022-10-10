<?php

namespace frontend\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use OpenApi\Generator;
use yii\helpers\ArrayHelper;
use yii\filters\Cors;

class SwaggerController extends Controller
{
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
        ]);
    }

    public function actionIndex()
    {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->render('index');
    }

    public function actionOpenapi()
    {
        Yii::$app->response->format = Response::FORMAT_RAW;
        $openapi = Generator::scan([
            Yii::getAlias('@frontend/controllers'),
            Yii::getAlias('@common/modules/blog/controllers'),
            Yii::getAlias('@common/modules/task/controllers'),
        ]);
        return $openapi->toYaml();
    }
} 