<?php

use yii\db\Migration;

class m170804_033837_calculation_codes extends Migration
{
    public function safeUp()
    {
        $this->createTable('calculation_codes', [
           'id' => $this->primaryKey(),
           'calculation_id' => $this->integer(11)->notNull(),
           'code' => $this->integer(20)->notNull()
        ]);

        $this->createIndex('calculation_codes_code', 'calculation_codes', 'code');
        $this->createIndex('calculation_codes_calculation_code', 'calculation_codes', ['calculation_id','code']);
        $this->addForeignKey('calculation_codes_calculation', 'calculation_codes', 'calculation_id', 'calculation', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        echo "m170804_033837_calculation_codes cannot be reverted.\n";
        $this->dropTable('calculation_codes');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170804_033837_calculation_codes cannot be reverted.\n";

        return false;
    }
    */
}
