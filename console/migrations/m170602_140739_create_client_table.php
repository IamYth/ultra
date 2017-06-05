<?php

use yii\db\Migration;

/**
 * Handles the creation of table `client`.
 */
class m170602_140739_create_client_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('client', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'phone' => $this->string(32)->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'nickmane' => $this->string()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('client');
    }
}
