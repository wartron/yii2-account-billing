<?php

use yii\db\Schema;
use yii\db\Migration;

class m150816_223011_create_payment_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%billing_payment}}', [
            'id'                =>  'BINARY(16) NOT NULL PRIMARY KEY',

            'account_id'        =>  'BINARY(16) NOT NULL',
            'status'            =>  Schema::TYPE_INTEGER . ' NOT NULL',
            'amount'            =>  Schema::TYPE_INTEGER . ' NOT NULL',
            'description'       =>  Schema::TYPE_STRING . ' NOT NULL',

            'created_at'        =>  Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by'        =>  'BINARY(16)',
        ]);

        $this->addForeignKey('fk_payment_account', '{{%billing_payment}}', 'account_id', '{{%account}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%billing_payment_item}}', [
            'payment_id'        =>  'BINARY(16) NOT NULL',
            'billable_item_id'  =>  'BINARY(16) NOT NULL',
        ]);

        $this->createIndex('payment_item_index', '{{%billing_payment_item}}', ['payment_id', 'billable_item_id'], true);

        $this->addForeignKey('fk_payment_item_payment', '{{%billing_payment_item}}', 'payment_id', '{{%billing_payment}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk_payment_item_billable_item', '{{%billing_payment_item}}', 'billable_item_id', '{{%billable_item}}', 'id', 'CASCADE', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%billing_payment_item}}');
        $this->dropTable('{{%billing_payment}}');
    }

}