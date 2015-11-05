<?php
/**
 * Created by PhpStorm.
 * User: ngilk
 * Date: 11/5/2015
 * Time: 9:39 PM
 */

namespace backend\models;


class Post extends \common\models\Post{

    public function beforeSave($insert)
    {
        if($this->show == 1 && isset($this->oldAttributes['show'])){
            $this->posted = date('Y-m-d H:i:s');
        }

        return parent::beforeSave($insert);
    }

} 