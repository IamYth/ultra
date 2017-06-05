<?php

use yii\db\Migration;

/**
 * Handles the creation of table `room`.
 */
class m170605_074407_create_room_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('room', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->string()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('room');
    }
}
