<?php


namespace console\controllers;


use common\models\User;
use Faker\Factory;
use yii\console\Controller;

class FakerController extends Controller
{

    public $faker;

    public function init()
    {
        $this->faker = Factory::create();
        parent::init();
    }

    /*
     * php yii faker/add-admin example@gmail.com
     */
    public function actionAddAdmin($email, $password = '000000') {

        if(YII_ENV !== 'dev') {
            return false;
        }

        $isUserExists = User::find()->where(['email' => $email])->exists();
        if($isUserExists) {
           return false;
        }

        $user = new User([
            'username' => $email,
            'email' => $email,
            'password' => $password,
            'created_at' => time(),
            'updated_at' => time(),
            'status' => 10,
        ]);
        $user->generateAuthKey();
        if($user->save())
            echo $user->username . "\n";
        else {
            echo var_dump($user->errors);
            echo "\n";
        }

        return true;
    }

}