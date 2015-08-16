<?php

use yii\db\Schema;
use yii\db\Migration;

class m150816_212645_create_billable_item_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%billable_item}}', [
            'id'                => 'pk',

            'status'            => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'type'              => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',

            'amount'            => Schema::TYPE_INTEGER . ' NOT NULL',
            'name'              => Schema::TYPE_STRING . ' NOT NULL',
            'description'       => Schema::TYPE_TEXT,
            'data'              => Schema::TYPE_TEXT,

            'created_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at'        => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by'        => Schema::TYPE_INTEGER . ' NOT NULL',
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%billable_item}}');
    }

}