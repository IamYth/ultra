<?php

use yii\db\Migration;

/**
 * Handles the creation of table `journal`.
 * Has foreign keys to the tables:
 *
 * - `client`
 * - `user`
 */
class m170602_140848_create_journal_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('journal', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull(),
            'update_time' => $this->integer()->notNull(),
            'updated_by_type' => $this->string()->notNull(),
            'updated_by' => $this->integer(),
        ]);

        // creates index for column `client_id`
        $this->createIndex(
            'idx-journal-client_id',
            'journal',
            'client_id'
        );

        // add foreign key for table `client`
        $this->addForeignKey(
            'fk-journal-client_id',
            'journal',
            'client_id',
            'client',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            'idx-journal-updated_by',
            'journal',
            'updated_by'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-journal-updated_by',
            'journal',
            'updated_by',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `client`
        $this->dropForeignKey(
            'fk-journal-client_id',
            'journal'
        );

        // drops index for column `client_id`
        $this->dropIndex(
            'idx-journal-client_id',
            'journal'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-journal-updated_by',
            'journal'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            'idx-journal-updated_by',
            'journal'
        );

        $this->dropTable('journal');
    }
}
