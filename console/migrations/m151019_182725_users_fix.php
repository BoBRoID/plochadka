<?php

use yii\db\Schema;
use yii\db\Migration;

class m151019_182725_users_fix extends Migration
{
    public function up()
    {
        $this->addColumn('authors', 'username', \yii\db\mysql\Schema::TYPE_STRING);
        $this->addColumn('authors', 'auth_key', \yii\db\mysql\Schema::TYPE_STRING);
        $this->addColumn('authors', 'created_at', \yii\db\mysql\Schema::TYPE_TIMESTAMP);
        $this->addColumn('authors', 'updated_at', \yii\db\mysql\Schema::TYPE_TIMESTAMP);
    }

    public function down()
    {
        $this->dropColumn('authors', 'username');
        $this->dropColumn('authors', 'auth_key');
        $this->dropColumn('authors', 'created_at');
        $this->dropColumn('authors', 'updated_at');

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
