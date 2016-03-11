<?php

use yii\db\Migration;

class m160307_191732_category_clor extends Migration
{
    public function up()
    {
        $this->addColumn('categories', 'color', \yii\db\Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('categories', 'color');

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
