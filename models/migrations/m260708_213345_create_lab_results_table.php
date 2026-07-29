<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%lab_results}}`.
 */
class m260708_213345_create_lab_results_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%lab_results}}', [

            'id' => $this->primaryKey(),

            // Requested laboratory test
            'test_id' => $this->integer()->notNull(),

            // Main laboratory result
            'result' => $this->text()->notNull(),

            // Lab findings / observations
            'findings' => $this->text(),

            // Normal reference range
            'normal_range' => $this->string(),

            // Lab technician who entered result
            'created_by' => $this->integer()->notNull(),

            // Optional uploaded report
            'attachment' => $this->string(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Link result with laboratory test request
        $this->addForeignKey(
            'fk-lab_results-test_id',
            '{{%lab_results}}',
            'test_id',
            '{{%lab_tests}}',
            'id',
            'CASCADE'
        );


        // Link result with laboratory technician
        $this->addForeignKey(
            'fk-lab_results-created_by',
            '{{%lab_results}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

    }


    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-lab_results-created_by',
            '{{%lab_results}}'
        );


        $this->dropForeignKey(
            'fk-lab_results-test_id',
            '{{%lab_results}}'
        );


        $this->dropTable('{{%lab_results}}');
    }
}