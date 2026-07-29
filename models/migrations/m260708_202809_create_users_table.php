<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m260708_202809_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [

            'id' => $this->primaryKey(),

            'full_name' => $this->string(100)
                ->notNull(),

            'username' => $this->string(50)
                ->notNull()
                ->unique(),

            'password_hash' => $this->string(255)
                ->notNull(),

            'email' => $this->string(100)
                ->unique(),

            'phone' => $this->string(20),

            'role_id' => $this->integer()
                ->notNull(),

            'status' => $this->smallInteger()
                ->defaultValue(1),

            'last_login' => $this->datetime(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Relationship between users and roles
        $this->addForeignKey(
            'fk-users-role_id',
            '{{%users}}',
            'role_id',
            '{{%roles}}',
            'id',
            'CASCADE',
            'CASCADE'
        );


        // Create default admin account
        $this->insert('{{%users}}', [

            'full_name' => 'System Administrator',

            'username' => 'admin',

            // password: admin123
            'password_hash' => Yii::$app->security
                ->generatePasswordHash('admin123'),

            'email' => 'admin@healthanalytics.com',

            'role_id' => 1,

            'status' => 1,

        ]);

    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-users-role_id',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');

    }
}