<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%audit_logs}}`.
 */
class m260708_223841_create_audit_logs_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%audit_logs}}', [

            'id' => $this->primaryKey(),

            // User aliyefanya action
            'user_id' => $this->integer()->notNull(),

            // Action performed
            // CREATE, UPDATE, DELETE, LOGIN, LOGOUT
            'action' => $this->string(50)->notNull(),

            // Module affected
            // Patients, Lab, Diagnosis, Billing etc.
            'module' => $this->string(100)->notNull(),

            // ID ya record iliyobadilishwa
            'record_id' => $this->integer(),

            // Maelezo ya tukio
            'description' => $this->text(),

            // Computer/IP address
            'ip_address' => $this->string(50),

            // Time
            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Relationship with users table
        $this->addForeignKey(
            'fk-audit_logs-user_id',
            '{{%audit_logs}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-audit_logs-user_id',
            '{{%audit_logs}}'
        );

        $this->dropTable('{{%audit_logs}}');
    }
}