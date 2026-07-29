<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\Medicine;
use app\models\Prescription;
use app\models\MedicineStock;
use app\models\MedicineDispensing;


class PharmacyController extends Controller
{


    public function behaviors()
    {
        return [

            'access'=>[

                'class'=>AccessControl::class,

                'rules'=>[

                    [
                        'allow'=>true,
                        'roles'=>['@']
                    ]

                ]

            ]

        ];
    }







    /*
    |--------------------------------------------------------------------------
    | PHARMACY DASHBOARD
    |--------------------------------------------------------------------------
    */


    public function actionIndex()
    {


        $dataProvider = new ActiveDataProvider([


            'query'=>Prescription::find()
                ->with([
                    'patient',
                    'doctor',
                    'medicine',
                    'visit'
                ])
                ->orderBy([
                    'id'=>SORT_DESC
                ]),


            'pagination'=>[

                'pageSize'=>10

            ]

        ]);

return $this->render('index',[


    'dataProvider'=>$dataProvider,


    'total'=>$totalCount = Prescription::find()
        ->count(),



    'waiting'=>$waiting = Prescription::find()
        ->where([
            'status'=>[
                'Waiting Pharmacy',
                'Active',
                'Pending'
            ]
        ])
        ->count(),



    'dispensed'=>Prescription::find()
        ->where([
            'status'=>'Dispensed'
        ])
        ->count(),



    'cancelled'=>Prescription::find()
        ->where([
            'status'=>'Cancelled'
        ])
        ->count(),



    'lowStockCount'=>MedicineStock::find()
        ->where([
            '<=',
            'quantity',
            50
        ])
        ->count(),



    'expiredMedicine'=>MedicineStock::find()
        ->where([
            '<',
            'expiry_date',
            date('Y-m-d')
        ])
        ->count(),



    'todayPrescription'=>Prescription::find()
        ->where([
            '>=',
            'created_at',
            date('Y-m-d 00:00:00')
        ])
        ->count(),


]);
}


    /*
    |--------------------------------------------------------------------------
    | ALL PRESCRIPTIONS
    |--------------------------------------------------------------------------
    */


    public function actionPrescriptions()
    {


        $status = Yii::$app->request->get('status');


        $search = Yii::$app->request->get('search');



        $query = Prescription::find()

            ->with([

                'patient',
                'doctor',
                'medicine',
                'visit'

            ]);







        /*
        STATUS FILTER
        */


        if(!empty($status))
        {

            $query->andWhere([

                'status'=>$status

            ]);

        }








        /*
        SEARCH
        */


        if(!empty($search))
        {

            $query->joinWith('patient');


            $query->andFilterWhere([

                'or',

                [
                    'like',
                    'patients.first_name',
                    $search
                ],


                [
                    'like',
                    'patients.last_name',
                    $search
                ],


                [
                    'like',
                    'patients.phone',
                    $search
                ]

            ]);

        }







        $dataProvider = new ActiveDataProvider([


            'query'=>$query
                ->orderBy([

                    'id'=>SORT_DESC

                ]),


            'pagination'=>[

                'pageSize'=>20

            ]

        ]);










        /*
        STATISTICS
        */


        $total =
            Prescription::find()
            ->count();





       $waiting =
    Prescription::find()
    ->where([

        'status'=>[
            'Waiting Pharmacy',
            'Active',
            'Pending'
        ]

    ])
    ->count();





        $dispensed =
            Prescription::find()
            ->where([

                'status'=>'Dispensed'

            ])
            ->count();





        $cancelled =
            Prescription::find()
            ->where([

                'status'=>'Cancelled'

            ])
            ->count();







        return $this->render('prescriptions',[


            'dataProvider'=>$dataProvider,


            'total'=>$total,


            'waiting'=>$waiting,


            'dispensed'=>$dispensed,


            'cancelled'=>$cancelled,


            'status'=>$status,


            'search'=>$search


        ]);

    }

/*
|--------------------------------------------------------------------------
| CANCEL PRESCRIPTION
|--------------------------------------------------------------------------
*/

public function actionCancel($id)
{

    $prescription = $this->findModel($id);


    if($prescription->status != Prescription::STATUS_DISPENSED)
    {

        $prescription->status = Prescription::STATUS_CANCELLED;

        $prescription->save(false);


        Yii::$app->session->setFlash(
            'success',
            'Prescription cancelled successfully.'
        );

    }
    else
    {

        Yii::$app->session->setFlash(
            'error',
            'Dispensed prescription cannot be cancelled.'
        );

    }


    return $this->redirect([
        'prescriptions'
    ]);

}






/*
|--------------------------------------------------------------------------
| CREATE PRESCRIPTION
|--------------------------------------------------------------------------
*/

public function actionCreate()
{

    $model = new Prescription();


    if($model->load(Yii::$app->request->post()))
    {


        $model->doctor_id = Yii::$app->user->id;


        if(empty($model->status))
        {
            $model->status = 'Active';
        }


        $model->created_at = date('Y-m-d H:i:s');



        // CHECK MEDICINE EXISTS

        $medicine = \app\models\Medicine::findOne($model->medicine_id);


        if(!$medicine)
        {

            Yii::$app->session->setFlash(
                'error',
                'Selected medicine does not exist in pharmacy database.'
            );


            return $this->render('create',[
                'model'=>$model
            ]);

        }




        // CHECK VISIT EXISTS

        $visit = \app\models\PatientVisit::findOne($model->visit_id);


        if(!$visit)
        {

            Yii::$app->session->setFlash(
                'error',
                'Patient visit record does not exist.'
            );


            return $this->render('create',[
                'model'=>$model
            ]);

        }





        // SAVE PRESCRIPTION

        if($model->save())
        {


            Yii::$app->session->setFlash(
                'success',
                'Prescription created successfully'
            );


            return $this->redirect([
                'prescriptions'
            ]);

        }



        Yii::$app->session->setFlash(
            'error',
            json_encode($model->errors)
        );

    }



    return $this->render('create',[

        'model'=>$model

    ]);

}

/*
|--------------------------------------------------------------------------
| MEDICINE INVENTORY
|--------------------------------------------------------------------------
*/

public function actionInventory()
{

    $medicines = Medicine::find()

   ->with('medicineStock')

        ->orderBy([
            'id'=>SORT_DESC
        ])

        ->all();



    return $this->render('inventory',[

        'medicines'=>$medicines

    ]);

}



    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */


    public function actionUpdate($id)
    {


        $model=$this->findModel($id);



        if(
            $model->load(Yii::$app->request->post())
            &&
            $model->save()
        )
        {


            return $this->redirect([
                'prescriptions'
            ]);

        }



        return $this->render('update',[

            'model'=>$model

        ]);

    }










    /*
    |--------------------------------------------------------------------------
    | VIEW
    |--------------------------------------------------------------------------
    */


    public function actionView($id)
    {


        return $this->render('view',[

            'model'=>$this->findModel($id)

        ]);

    }









    /*
    |--------------------------------------------------------------------------
    | DISPENSE MEDICINE
    |--------------------------------------------------------------------------
    */


    public function actionDispense($id)
    {


        $prescription=$this->findModel($id);



        if($prescription->status=='Dispensed')
        {


            Yii::$app->session->setFlash(
                'warning',
                'Medicine already dispensed'
            );


            return $this->redirect([
                'prescriptions'
            ]);

        }





        $transaction =
            Yii::$app->db->beginTransaction();


        try
        {


            $stock =
                MedicineStock::find()
                ->where([
                    'medicine_id'=>$prescription->medicine_id
                ])
                ->one();




            if(!$stock)
            {
                throw new \Exception(
                    'Medicine stock unavailable'
                );
            }




            if(
                $stock->quantity <
                $prescription->quantity
            )
            {
                throw new \Exception(
                    'Not enough medicine stock'
                );
            }






            $stock->quantity -=
                $prescription->quantity;


            $stock->save(false);







            $dispense =
                new MedicineDispensing();



            $dispense->prescription_id =
                $prescription->id;


            $dispense->medicine_id =
                $prescription->medicine_id;


            $dispense->quantity =
                $prescription->quantity;


            $dispense->dispensed_by =
                Yii::$app->user->id;


            $dispense->dispensed_at =
                date('Y-m-d H:i:s');



            $dispense->save(false);







            $prescription->status =
                'Dispensed';



            $prescription->dispensed_at =
                date('Y-m-d H:i:s');



            $prescription->save(false);






            $transaction->commit();



            Yii::$app->session->setFlash(
                'success',
                '💊 Medicine dispensed successfully'
            );


        }
        catch(\Exception $e)
        {


            $transaction->rollBack();


            Yii::$app->session->setFlash(
                'error',
                $e->getMessage()
            );


        }





        return $this->redirect([
            'prescriptions'
        ]);

    }









    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */


    public function actionDelete($id)
    {


        $this->findModel($id)->delete();



        return $this->redirect([
            'prescriptions'
        ]);

    }










    /*
    |--------------------------------------------------------------------------
    | FIND MODEL
    |--------------------------------------------------------------------------
    */


    protected function findModel($id)
    {


        $model =
            Prescription::find()
            ->with([
                'patient',
                'doctor',
                'medicine',
                'visit'
            ])
            ->where([
                'id'=>$id
            ])
            ->one();



        if($model)
        {

            return $model;

        }



        throw new NotFoundHttpException(
            'Prescription not found'
        );

    }


}