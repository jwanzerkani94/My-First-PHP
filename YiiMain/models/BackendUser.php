<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "backend_user".
 *
 * @property integer $user_id
 * @property string $email
 * @property string $authKey
 * @property string $password
 * @property string $firstName
 * @property string $lastName
 * @property string $username
 *
 * @property Photos[] $photos
 */
class BackendUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'backend_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'authKey'], 'string', 'max' => 50],
            [['password', 'username'], 'string', 'max' => 30],
            [['firstName'], 'string', 'max' => 15],
            [['lastName'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'email' => Yii::t('app', 'Email'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'password' => Yii::t('app', 'Password'),
            'firstName' => Yii::t('app', 'First Name'),
            'lastName' => Yii::t('app', 'Last Name'),
            'username' => Yii::t('app', 'Username'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['user_id' => 'user_id']);
    }

    public function getAuthKey(): string {
        return $this->authKey;
    }

    public function getId() {
        return $this->user_id;
    }

    public function validateAuthKey($authKey): bool {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id): \yii\web\IdentityInterface {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null): \yii\web\IdentityInterface {
        throw new \yii\base\NotSupportedException();
    }
    
    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }
    
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

}
