<?php

use yii\db\Schema;
use yii\db\Migration;

class m150816_212645_create_billable_item_table extends Migration
{
    public function up()
    {
        return;
        $this->createTable('{{%billable_item}}', [
            'id'                =>  'BINARY(16) NOT NULL'

            'status'            =>  Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'type'              =>  Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',

            'amount'            =>  Schema::TYPE_INTEGER . ' NOT NULL',
            'name'              =>  Schema::TYPE_STRING . ' NOT NULL',
            'description'       =>  Schema::TYPE_TEXT,
            'data'              =>  Schema::TYPE_TEXT,

            'created_at'        =>  Schema::TYPE_INTEGER,
            'created_by'        =>  'BINARY(16)',
            'updated_at'        =>  Schema::TYPE_INTEGER,
            'updated_by'        =>  'BINARY(16)',
        ]);

    }

    public function down()
    {
        return;
        $this->dropTable('{{%billable_item}}');
    }

}