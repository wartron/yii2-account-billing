<?php

use yii\db\Schema;
use yii\db\Migration;

class m150816_21356_create_billing_account_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%billing_account}}', [
            'id'                =>  'BINARY(16) NOT NULL PRIMARY KEY',

            'account_id'        =>  'BINARY(16) NOT NULL',

            'status'            =>  Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',

            'full_name'         =>  Schema::TYPE_STRING,
            'cc_last4'          =>  Schema::TYPE_INTEGER,
            'cc_type'           =>  Schema::TYPE_INTEGER,
            'cc_year'           =>  Schema::TYPE_INTEGER,
            'cc_month'          =>  Schema::TYPE_INTEGER,

            'stripe_token'      =>  Schema::TYPE_STRING,
            'stripe_card_token' =>  Schema::TYPE_STRING,

            'created_at'        =>  Schema::TYPE_INTEGER,
            'created_by'        =>  'BINARY(16)',
        ]);

        $this->addForeignKey('fk_billing_account_account', '{{%billing_account}}', 'account_id', '{{%account}}', 'id', 'CASCADE', 'RESTRICT');

        $columns = ['id', 'account_id', 'status', 'full_name', 'cc_last4', 'cc_type', 'cc_year', 'cc_month'];
        $this->batchInsert('{{%billing_account}}', $columns, [
            [
                hex2bin('713c4ee24d2011e590e90242ac110002'),
                hex2bin('6043BACF4CF411E590E90242AC110002'),
                2,
                'Will Wharton',
                1234,
                1, //fake visa
                17,
                05,
            ],
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%billing_account}}');
    }

}