<?php

use yii\db\Schema;
use yii\db\Migration;

class m150818_121056_create_billing_account_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%billing_account}}', [
            'id'                =>  'BINARY(16) NOT NULL PRIMARY KEY',

            'account_id'        =>  'BINARY(16) NOT NULL',

            'status'            =>  Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 1',

            'full_name'         =>  Schema::TYPE_STRING,
            'cc_last4'          =>  Schema::TYPE_STRING,
            'cc_type'           =>  Schema::TYPE_INTEGER,
            'cc_year'           =>  Schema::TYPE_INTEGER,
            'cc_month'          =>  Schema::TYPE_INTEGER,

            'stripe_token'      =>  Schema::TYPE_STRING,
            'stripe_card_token' =>  Schema::TYPE_STRING,

            'created_at'        =>  Schema::TYPE_INTEGER,
            'created_by'        =>  'BINARY(16)',
        ]);

        $this->addForeignKey('fk_billing_account_account', '{{%billing_account}}', 'account_id', '{{%account}}', 'id', 'CASCADE', 'RESTRICT');


    }

    public function down()
    {
        $this->dropTable('{{%billing_account}}');
    }

}