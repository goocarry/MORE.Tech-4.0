<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\ErrorAction;
use frontend\models\SearchForm;
use yii\helpers\Url;

/**
 * Search controller
 */
class SearchController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SearchForm();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
