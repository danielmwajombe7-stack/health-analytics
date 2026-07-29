<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%patient_queue}}`.
 */
class m260709_031244_create_patient_queue_table extends Migration
{

    public function safeUp()
    {

        $this->createTable('{{%patient_queue}}', [


            'id' => $this->primaryKey(),


            'patient_id' => $this->integer()->notNull(),


            'queue_number' => $this->string(20)->notNull(),


            'department' => $this->string(100)
                ->defaultValue('General OPD'),


            'priority' => $this->string(20)
                ->defaultValue('Normal'),


            'status' => $this->string(50)
                ->defaultValue('Waiting'),


            'notes' => $this->text(),


            'arrival_time' => $this->dateTime()
                ->defaultExpression('CURRENT_TIMESTAMP'),


            'called_time' => $this->dateTime()
                ->null(),


            'finished_time' => $this->dateTime()
                ->null(),


            'created_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),


            'updated_at' => $this->timestamp()
                ->defaultExpression('CURRENT_TIMESTAMP'),

        ]);





        /**
         * Relationship with patients table
         */
        $this->addForeignKey(

            'fk_queue_patient',

            '{{%patient_queue}}',

            'patient_id',

            '{{%patients}}',

            'id',

            'CASCADE',

            'CASCADE'

        );




        /**
         * Indexes for faster searching
         */
        $this->createIndex(

            'idx_queue_patient',

            '{{%patient_queue}}',

            'patient_id'

        );


        $this->createIndex(

            'idx_queue_status',

            '{{%patient_queue}}',

            'status'

        );


        $this->createIndex(

            'idx_queue_department',

            '{{%patient_queue}}',

            'department'

        );


    }




    public function safeDown()
    {


        $this->dropForeignKey(

            'fk_queue_patient',

            '{{%patient_queue}}'

        );



        $this->dropIndex(

            'idx_queue_patient',

            '{{%patient_queue}}'

        );



        $this->dropIndex(

            'idx_queue_status',

            '{{%patient_queue}}'

        );



        $this->dropIndex(

            'idx_queue_department',

            '{{%patient_queue}}'

        );



        $this->dropTable('{{%patient_queue}}');

    }

}