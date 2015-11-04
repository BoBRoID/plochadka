<?php

use yii\db\Schema;
use yii\db\Migration;

class m151013_101422_username_for_author extends Migration
{
    public function up()
    {
        $this->addColumn('authors', 'username', \yii\db\mysql\Schema::TYPE_STRING.' NOT NULL');
    }

    public function down()
    {
        echo "m151013_101422_username_for_author cannot be reverted.\n";

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
