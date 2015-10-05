<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $name
 * @property string $description
 * @property string $keywords
 * @property string $link
 * @property string $image
 * @property string $created
 * @property integer $postPrice
 */
class Category extends \yii\db\ActiveRecord
{
    public $postsCount = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'link', 'image'], 'required'],
            [['parent', 'postPrice'], 'integer'],
            [['description', 'keywords'], 'string'],
            [['created'], 'safe'],
            [['name', 'link', 'image'], 'string', 'max' => 255]
        ];
    }

    public function getSubcategories(){
        return self::find()->where(['parent' => $this->id])->all();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent' => 'Parent',
            'name' => 'Name',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'link' => 'Link',
            'image' => 'Image',
            'created' => 'Created',
            'postPrice' => 'Post Price',
        ];
    }
}
