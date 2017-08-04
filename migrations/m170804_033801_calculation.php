<?php

use yii\db\Migration;

class m170804_033801_calculation extends Migration
{
    public function safeUp()
    {
        $this->createTable('calculation', [
            'id' => $this->primaryKey(11),
            'user_id' => $this->integer(11),
            'title' => $this->string(255)->defaultValue(null),
            'calculation' => $this->text(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(). ' DEFAULT CURRENT_TIMESTAMP',
        ]);
    }

    public function safeDown()
    {
        echo "m170804_033801_calculation cannot be reverted.\n";
        $this->dropTable('calculation');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170804_033801_calculation cannot be reverted.\n";

        return false;
    }
    */
}
