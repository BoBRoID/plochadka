<?php

use yii\db\Schema;
use yii\db\Migration;

class m151013_122753_auth_key extends Migration
{
    public function up()
    {
        $this->addColumn('authors', 'auth_key', \yii\db\mysql\Schema::TYPE_STRING.' DEFAULT NULL');
        $this->addColumn('authors', 'password_reset_token', \yii\db\mysql\Schema::TYPE_STRING.' DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('authors', 'auth_key');
        $this->dropColumn('authors', 'password_reset_token');

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
