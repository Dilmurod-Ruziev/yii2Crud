<?php
/**
 * Created by PhpStorm
 * User: Ruziev Dilmurod
 * Date: 08.02.2021
 * Time: 18:05
 */

namespace app\models;
use \yii\helpers\VarDumper;
use yii\base\Model;

class RegisterForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $password_repeat;

    public function rules()
    {
        return [
            [['username', 'email','password', 'password_repeat'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 16],
            ['email', 'email'],
            [['password', 'password_repeat'], 'string', 'min' => 8, 'max' => 32],
            [['password_repeat'], 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function register()
    {
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->auth_key = \Yii::$app->security->generateRandomString();
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);

        if ($user->save()){
            return true;
        }

        \Yii::error("User was not saved: ".VarDumper::dumpAsString($user->errors));
        return false;
    }
}