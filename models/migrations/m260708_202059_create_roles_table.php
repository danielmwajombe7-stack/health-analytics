<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%roles}}`.
 */
class m260708_202059_create_roles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%roles}}', [

            'id' => $this->primaryKey(),

            'role_name' => $this->string(50)
                ->notNull()
                ->unique(),

            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);


        // Insert default hospital roles
        $this->batchInsert('{{%roles}}',
            [
                'role_name'
            ],
            [

                ['Super Admin'],
                ['Admin'],
                ['Receptionist'],
                ['Doctor'],
                ['Nurse'],
                ['Laboratory Technician'],
                ['Pharmacist'],
                ['Radiologist'],
                ['Cashier'],
                ['Store Keeper'],

            ]
        );
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%roles}}');
    }
}