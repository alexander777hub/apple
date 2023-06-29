<?php

use yii\db\Migration;

/**
 * Class m230628_053629_add_admin_user
 */
class m230628_053629_add_admin_user extends Migration
{
    // @codingStandardsIgnoreEnd

    /**
     * Table name
     *
     * @var string
     */
    private $_user = "{{%user}}";

    /**
     * @var string
     */


    /**
     * Runs for the migate/up command
     *
     * @return null
     */
    public function safeUp()
    {
        $time = time();
        $password_hash = Yii::$app->getSecurity()->generatePasswordHash('pass12345');
        $auth_key = Yii::$app->security->generateRandomString();
        $table = $this->_user;

        $sql = <<<SQL
        INSERT INTO {$table}
        (`username`, `email`,`password_hash`, `auth_key`, `created_at`, `updated_at`)
        VALUES
        ('admin', 'admin@yoursite.com',  '$password_hash', '$auth_key', {$time}, {$time})
        SQL;
        Yii::$app->db->createCommand($sql)->execute();
    }

    /**
     * Runs for the migate/down command
     *
     * @return null
     */
    public function safeDown()
    {
        $table = $this->_user;
        $sql = <<<SQL
        SELECT id from {$table}
        where username='admin'
        SQL;
        $this->delete($this->_user, ['username' => 'admin']);
    }
}
