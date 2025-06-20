<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

// class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
class User extends ActiveRecord implements IdentityInterface
{
    public $authKey;

    public static function tableName()
    {
        //return 'user';
        return '{{%Usuarios}}';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            //[['activo', 'tipo'], 'string'],
            //[['fechaRegistro'], 'safe'],
            [['username'], 'string', 'max' => 45],
            [['password'], 'string', 'max' => 70],

            //[['email'], 'string', 'max' => 60],
            //[['confirmacionDePassword'], 'compare', 'compareAttribute' => 'password', 'message' => 'La contraseña no coincide, favor de verificar.'],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where("username = '$username' and estatus='activo' ")->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === $password;
        return password_verify($password, $this->password);
    }

    public static function encriptarPassword($password)
    {
        $opciones = ['cost' => 10];
        return password_hash($password, PASSWORD_BCRYPT, $opciones);
    }

    public function getIdColono0()
    {
        return $this->hasOne(Colonos::className(), ['id' => 'idColono']);
    }
}
