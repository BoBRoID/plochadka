<?php
/**
 * Created by PhpStorm.
 * User: ngilk
 * Date: 11/5/2015
 * Time: 9:38 PM
 */

namespace frontend\models;


use common\models\Category;

class Post extends \common\models\Post{

    private $_photos = [];
    private $_category;

    public static function find(){
        return parent::find()->andWhere(['show' => 1]);
    }

    public function getPhoto(){
        $photos = $this->getPhotos();

        return !empty($photos[0]) ? $photos[0]->link : '/images/noimage.jpg';
    }

    public function getPhotos(){
        if(!empty($this->_photos)){
            return $this->_photos;
        }

        $photos = PostImage::find()->where(['post' => $this->id, 'deleted' => 0])->all();

        return $this->_photos = $photos;
    }

    public function getCategoryObject(){
        if(!empty($this->_category)){
            return $this->_category;
        }

        $category = Category::find()->where(['id' => $this->category])->one();

        return $this->_category = $category;
    }

    public function beforeSave($insert)
    {
        $this->author = isset(\Yii::$app->user->identity['id']) ? \Yii::$app->user->identity['id'] : 0;

        return parent::beforeSave($insert);
    }
} 