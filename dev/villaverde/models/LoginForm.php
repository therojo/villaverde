<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Ejercicios;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            // if (!$user) {
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
        
            $session = Yii::$app->session;

            $idTalonActivo = 0;

            if($this->getUser()->tipo==Usuarios::_ADMIN) {
                
                $modelSesion =(new Sesiones())->find()->where([
                    'idUsuario' => $this->getUser()->id
                ])->one();
                
                
                if($modelSesion) {
                    $idTalonActivo = $modelSesion->idTalon;
                }
            }

            $session->set('idUsuario', $this->getUser()->id);
            $session->set('tipo', $this->getUser()->tipo);
            $session->set('nombreUsuario', $this->getUser()->idColono0->nombre);
            $session->set('idTalon', $idTalonActivo);
            
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
