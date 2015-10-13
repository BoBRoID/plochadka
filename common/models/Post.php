<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property integer $category
 * @property integer $author
 * @property string $premium
 * @property string $title
 * @property string $content
 * @property string $image
 * @property string $category_color
 * @property string $category_icon
 * @property integer $price
 * @property string $created
 * @property integer $deleted
 * @property string $phone
 * @property string $email
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'title', 'content'], 'required'],
            [['category', 'author', 'price', 'deleted'], 'integer'],
            [['premium', 'created'], 'safe'],
            [['content'], 'string'],
            [['email'], 'email'],
            [['title', 'image', 'category_color', 'category_icon', 'phone'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'author' => 'Author',
            'premium' => 'Premium',
            'title' => 'Title',
            'content' => 'Content',
            'image' => 'Image',
            'category_color' => 'Category Color',
            'category_icon' => 'Category Icon',
            'price' => 'Price',
            'created' => 'Created',
            'deleted' => 'Deleted',
            'phone' => 'Phone',
            'email' => 'Email',
        ];
    }

    public function beforeSave($insert)
    {
        $this->author = isset(\Yii::$app->user->identity['id']) ? \Yii::$app->user->identity['id'] : 0;

        return parent::beforeSave($insert);
    }
}
