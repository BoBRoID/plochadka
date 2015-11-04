<?php

use yii\db\Schema;
use yii\db\Migration;

class m151013_125623_author_some_changes extends Migration
{
    public function up()
    {
        $this->dropColumn('authors', 'created');
        $this->addColumn('authors', 'created_at', \yii\db\mysql\Schema::TYPE_TIMESTAMP);
        $this->addColumn('authors', 'updated_at', \yii\db\mysql\Schema::TYPE_TIMESTAMP);
    }

    public function down()
    {
        echo "m151013_125623_author_some_changes cannot be reverted.\n";

        return false;
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
