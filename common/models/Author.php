<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $username
 * @property string $created
 * @property integer $deleted
 * @property string $phone
 * @property integer $money
 */
class Author extends \yii\db\ActiveRecord
{
    public $password2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'username'], 'required'],
            [['created'], 'safe'],
            [['deleted', 'money'], 'integer'],
            [['email', 'password', 'phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => \Yii::t('author', 'ID'),
            'email'     => \Yii::t('author', 'Email'),
            'username'  => \Yii::t('author', 'Username'),
            'password'  => \Yii::t('author', 'Password'),
            'password2' => \Yii::t('author', 'Password confirmation'),
            'created'   => \Yii::t('author', 'Created'),
            'deleted'   => \Yii::t('author', 'Deleted'),
            'phone'     => \Yii::t('author', 'Phone'),
            'money'     => \Yii::t('author', 'Money'),
        ];
    }
}
