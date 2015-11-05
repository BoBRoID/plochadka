<?php

use yii\db\Schema;
use yii\db\Migration;

class m151105_155333_posts_images extends Migration
{
    public function up()
    {
        $this->createTable('postsImages', [
            'id'        =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL PRIMARY KEY AUTO_INCREMENT',
            'post'      =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL',
            'link'      =>  \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL',
            'deleted'   =>  \yii\db\mysql\Schema::TYPE_INTEGER.' NOT NULL DEFAULT 0'
        ]);

        $this->execute("INSERT INTO `postsImages` (`post`, `link`) SELECT `id` as `post`, `image` as `link` FROM `posts`");

        $this->dropColumn('posts', 'image');
    }

    public function down()
    {
        echo "m151105_155333_posts_images cannot be reverted.\n";

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
