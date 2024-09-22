<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Модель формы регистрации.
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * Правила валидации.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Это имя пользователя уже занято.'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот email уже используется.'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Регистрирует нового пользователя.
     *
     * @return User|null
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->created_at = time();
        $user->updated_at = time();

        return $user->save() ? $user : null;
    }
}
