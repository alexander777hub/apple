<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m230627_131105_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->integer()->notNull()->defaultValue(1),
            'date_appear' => $this->timestamp()->null()->defaultValue(null),
            'date_fall' => $this->timestamp()->null()->defaultValue(null),
            'status' => $this->integer()->notNull()->defaultValue(1),
            'spent' => $this->integer()->notNull()->defaultValue(0),
            'size' => $this->decimal(5, 2)->notNull()->defaultValue(1.00),
            'initial_size' => $this->decimal(5, 2)->notNull()->defaultValue(1.00),
        ]);
        $this->execute("CREATE EVENT event_update_status
        ON SCHEDULE EVERY 50 SECOND
        DO
        UPDATE apple SET status = IF(apple.date_fall IS NOT NULL AND TIMESTAMPDIFF(HOUR, apple.date_fall, NOW()) >= 1, 3, apple.status);");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute("DROP EVENT IF EXISTS event_update_status");
        $this->dropTable('{{%apple}}');
    }
}
