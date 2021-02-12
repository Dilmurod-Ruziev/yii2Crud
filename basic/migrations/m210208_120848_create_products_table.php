<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 */
class m210208_120848_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'cost' => $this->integer()->notNull(),
            'category' => $this->string()->notNull(),
            'rating' => $this->integer(),
            'user_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-products-user_id}}',
            '{{%products}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-products-user_id}}',
            '{{%products}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-products-user_id}}',
            '{{%products}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-products-user_id}}',
            '{{%products}}'
        );

        $this->dropTable('{{%products}}');
    }
}
