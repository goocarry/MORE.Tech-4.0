<?php

namespace frontend\models;

/**
 * UserFrom model
 *
 * @property string $username
 */
class UserForm extends \yii\base\Model
{
    public $username;

    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'string'],
        ];
    }
}
