<?php

use yii\db\Schema;
use yii\db\Migration;

class m151005_150722_posts extends Migration
{
    public function up()
    {
        $this->createTable('posts', [
            'id'            =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'category'      =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL',
            'author'        =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL',
            'premium'       =>  \yii\db\mysql\Schema::TYPE_DATETIME.' NOT NULL DEFAULT "0000-00-00 00:00:00"',
            'title'         =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'content'       =>  \yii\db\mysql\Schema::TYPE_TEXT.' NOT NULL',
            'image'         =>  \yii\db\mysql\Schema::TYPE_STRING.' DEFAULT NULL',
            'category_color'=>  \yii\db\mysql\Schema::TYPE_STRING.' DEFAULT NULL',
            'category_icon' =>  \yii\db\mysql\Schema::TYPE_STRING.' DEFAULT NULL',
            'price'         =>  \yii\db\mysql\Schema::TYPE_INTEGER.' DEFAULT NULL',
            'created'       =>  \yii\db\mysql\Schema::TYPE_TIMESTAMP.' NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'deleted'       =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL DEFAULT 0',
            'phone'         =>  \yii\db\mysql\Schema::TYPE_STRING.' NULL',
            'email'         =>  \yii\db\mysql\Schema::TYPE_STRING.' NULL',
        ]);

        $this->createTable('authors', [
            'id'            =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'email'         =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'password'      =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'created'       =>  \yii\db\mysql\Schema::TYPE_TIMESTAMP.' NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'deleted'       =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL DEFAULT 0',
            'phone'         =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'money'         =>  \yii\db\mysql\Schema::TYPE_INTEGER.' DEFAULT 0',
        ]);

        $this->createTable('categories', [
            'id'            =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'parent'        =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL',
            'name'          =>  \yii\db\mysql\Schema::TYPE_STRING.' DEFAULT NULL',
            'description'   =>  \yii\db\mysql\Schema::TYPE_TEXT.' DEFAULT NULL',
            'keywords'      =>  \yii\db\mysql\Schema::TYPE_TEXT.' DEFAULT NULL',
            'link'          =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'image'         =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'created'       =>  \yii\db\mysql\Schema::TYPE_TIMESTAMP.' NOT NULL DEFAULT CURRENT_TIMESTAMP',
            'postPrice'     =>  \yii\db\mysql\Schema::TYPE_INTEGER.' DEFAULT 0',
        ]);
    }

    public function down()
    {
        $this->dropTable('posts');
        $this->dropTable('authors');
        $this->dropTable('categories');

        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
