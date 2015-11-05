<?php
/**
 * Created by PhpStorm.
 * User: ngilk
 * Date: 11/5/2015
 * Time: 9:38 PM
 */

namespace frontend\models;


class Post extends \common\models\Post{

    public static function find(){
        return parent::find()->andWhere(['show' => 1]);
    }

    public function beforeSave($insert)
    {
        $this->author = isset(\Yii::$app->user->identity['id']) ? \Yii::$app->user->identity['id'] : 0;

        return parent::beforeSave($insert);
    }
} 