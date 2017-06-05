<?php

use yii\db\Migration;

/**
 * Handles the creation of table `event`.
 * Has foreign keys to the tables:
 *
 * - `room`
 */
class m170605_075103_create_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'description' => $this->string()->notNull(),
            'room_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'time_start' => $this->integer()->notNull(),
            'time_end' => $this->integer()->notNull(),
            'date' => $this->integer()->notNull(),
        ]);

        // creates index for column `room_id`
        $this->createIndex(
            'idx-event-room_id',
            'event',
            'room_id'
        );

        // add foreign key for table `room`
        $this->addForeignKey(
            'fk-event-room_id',
            'event',
            'room_id',
            'room',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `room`
        $this->dropForeignKey(
            'fk-event-room_id',
            'event'
        );

        // drops index for column `room_id`
        $this->dropIndex(
            'idx-event-room_id',
            'event'
        );

        $this->dropTable('event');
    }
}
