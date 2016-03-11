<?php

use yii\db\Schema;
use yii\db\Migration;

class m151104_164608_postsViews extends Migration
{
    public function up()
    {
        $this->addColumn('posts', 'views', \yii\db\mysql\Schema::TYPE_BIGINT.' DEFAULT 0');

    }

    public function down()
    {
        $this->dropColumn('posts', 'views');
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
