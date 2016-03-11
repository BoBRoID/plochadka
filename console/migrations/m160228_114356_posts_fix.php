<?php

use yii\db\Schema;
use yii\db\Migration;

class m160228_114356_posts_fix extends Migration
{
    public function up()
    {
        $this->addColumn('posts', 'show', Schema::TYPE_SMALLINT.' UNSIGNED NOT NULL DEFAULT 0');
    }

    public function down()
    {
        return $this->dropColumn('posts', 'show');  
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
