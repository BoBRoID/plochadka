<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $created
 * @property integer $deleted
 * @property string $phone
 * @property integer $money
 */
class Author extends \yii\db\ActiveRecord
{
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
            [['email', 'password', 'phone'], 'required'],
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
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'created' => 'Created',
            'deleted' => 'Deleted',
            'phone' => 'Phone',
            'money' => 'Money',
        ];
    }
}
