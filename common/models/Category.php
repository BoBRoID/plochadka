<?php

namespace common\models;

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
 * @property string $color
 */
class Category extends \yii\db\ActiveRecord
{
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
            [['name', 'link', 'image', 'color'], 'string', 'max' => 255]
        ];
    }

    public function getPostsCount(){
        return Post::find()->where(['show' => 1])->count();
    }

    public function getSubcategories(){
        return self::find()->where(['parent' => $this->id])->all();
    }

    public static function getList(){
        $list = [];

        foreach(self::find()->select(['id', 'name'])->each() as $category){
            $list[$category->id] = $category->name;
        }

        return $list;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
            'link' => Yii::t('app', 'Link'),
            'image' => Yii::t('app', 'Image'),
            'created' => Yii::t('app', 'Created'),
            'postPrice' => Yii::t('app', 'Post Price'),
            'color' => Yii::t('app', 'Color'),
        ];
    }
}
