<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "postsImages".
 *
 * @property integer $id
 * @property integer $post
 * @property string $link
 * @property integer $deleted
 */
class PostImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'postsImages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post', 'link'], 'required'],
            [['post', 'deleted'], 'integer'],
            [['link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'post' => 'Post',
            'link' => 'Link',
            'deleted' => 'Deleted',
        ];
    }
}
