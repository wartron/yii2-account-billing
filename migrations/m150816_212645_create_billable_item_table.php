<?php

use yii\db\Schema;
use yii\db\Migration;

class m150816_212645_create_billable_item_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%billable_item}}', [
            'id'                =>  'BINARY(16) NOT NULL PRIMARY KEY',

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

        $columns = ['id', 'type', 'status', 'amount', 'name', 'description'];
        $this->batchInsert('{{%billable_item}}', $columns, [
            [
                hex2bin('53f24b97aade11e2aced000c29ae5e1b'),
                1,
                1,
                500,
                'Gizmo',
                'This should cost $5'
            ],
            [
                hex2bin('fa411e44a7e711e2aced000c29ae5e1b'),
                1,
                1,
                1099,
                'Widget',
                'This should cost $10.99'
            ],
        ]);



    }

    public function down()
    {
        $this->dropTable('{{%billable_item}}');
    }

}