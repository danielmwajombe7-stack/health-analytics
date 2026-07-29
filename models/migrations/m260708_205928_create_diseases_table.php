<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%diseases}}`.
 */
class m260708_205928_create_diseases_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%diseases}}', [

            'id' => $this->primaryKey(),

            // Disease name
            'disease_name' => $this->string()
                ->notNull(),

            // Disease description
            'description' => $this->text(),

            // Active or Inactive
            'status' => $this->string()
                ->defaultValue('Active'),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%diseases}}');
    }
}