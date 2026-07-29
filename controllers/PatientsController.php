<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

use app\models\Patient;
use app\models\PatientQueue;
use app\models\PatientVisit;
use app\models\MedicalRecords;
use app\models\LabRequest;
use app\models\Prescription;

class PatientsController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | BEHAVIORS
    |--------------------------------------------------------------------------
    */

    public function behaviors()
    {
        return [

            'access' => [

                'class' => AccessControl::class,

                'rules' => [

                    [

                        'allow' => true,

                        'roles' => ['@']

                    ]

                ]

            ],

            'verbs' => [

                'class' => VerbFilter::class,

                'actions' => [

                    'delete' => ['POST']

                ]

            ]

        ];
    }



    /*
    |--------------------------------------------------------------------------
    | PATIENT LIST
    |--------------------------------------------------------------------------
    */

    public function actionIndex()
    {

        $query = Patient::find()

            ->where([
                '!=',
                'status',
                'Deleted'
            ])

            ->orderBy([
                'id' => SORT_DESC
            ]);


        $search = Yii::$app->request->get('search');
        $status = Yii::$app->request->get('status');
        $gender = Yii::$app->request->get('gender');


        if (!empty($search)) {

            $query->andFilterWhere([

                'or',

                ['like', 'first_name', $search],
                ['like', 'middle_name', $search],
                ['like', 'last_name', $search],
                ['like', 'patient_number', $search],
                ['like', 'phone', $search],

            ]);

        }


        if (!empty($status)) {

            $query->andWhere([
                'status' => $status
            ]);

        }


        if (!empty($gender)) {

            $query->andWhere([
                'gender' => $gender
            ]);

        }


        $dataProvider = new ActiveDataProvider([

            'query' => $query,

            'pagination' => [

                'pageSize' => 20

            ]

        ]);


        return $this->render(

            'index',

            [

                'dataProvider' => $dataProvider,

                'search' => $search,

                'status' => $status,

                'gender' => $gender

            ]

        );

    }   
    /*
    |--------------------------------------------------------------------------
    | PATIENT PROFILE
    |--------------------------------------------------------------------------
    */

    public function actionView($id)
    {

        $patient = $this->findModel($id);

        /*
        |--------------------------------------------------------------------------
        | Patient Visits
        |--------------------------------------------------------------------------
        */
        $visits = PatientVisit::find()

            ->where([
                'patient_id' => $id
            ])

            ->orderBy([
                'id' => SORT_DESC
            ])

            ->all();



        /*
        |--------------------------------------------------------------------------
        | Medical Records
        |--------------------------------------------------------------------------
        */
        $medicalRecords = MedicalRecords::find()

            ->where([
                'patient_id' => $id
            ])

            ->orderBy([
                'id' => SORT_DESC
            ])

            ->all();



        /*
        |--------------------------------------------------------------------------
        | Laboratory Requests
        |--------------------------------------------------------------------------
        */
        $labRequests = LabRequest::find()

            ->where([
                'patient_id' => $id
            ])

            ->with([
                'doctor'
            ])

            ->orderBy([
                'id' => SORT_DESC
            ])

            ->all();



        /*
        |--------------------------------------------------------------------------
        | Queue History
        |--------------------------------------------------------------------------
        */
        $queues = PatientQueue::find()

            ->where([
                'patient_id' => $id
            ])

            ->orderBy([
                'id' => SORT_DESC
            ])

            ->all();



        /*
        |--------------------------------------------------------------------------
        | Prescriptions
        |--------------------------------------------------------------------------
        */
        $prescriptions = [];

        if (class_exists(\app\models\Prescription::class)) {

            $prescriptions = \app\models\Prescription::find()

                ->where([
                    'patient_id' => $id
                ])

                ->orderBy([
                    'id' => SORT_DESC
                ])

                ->all();
        }



        /*
        |--------------------------------------------------------------------------
        | Render Patient Profile
        |--------------------------------------------------------------------------
        */

        return $this->render(

            'view',

            [

                'model' => $patient,

                'visits' => $visits,

                'medicalRecords' => $medicalRecords,

                'labRequests' => $labRequests,

                'queues' => $queues,

                'prescriptions' => $prescriptions,

            ]

        );

    } 
    /*
    |--------------------------------------------------------------------------
    | CREATE PATIENT
    |--------------------------------------------------------------------------
    */

    public function actionCreate()
    {

        $model = new Patient();

        if ($model->load(Yii::$app->request->post())) {

            if (empty($model->patient_number)) {

                $model->patient_number =
                    'PAT-' .
                    date('Ymd') .
                    '-' .
                    rand(1000, 9999);

            }

            if ($model->hasAttribute('status') && empty($model->status)) {

                $model->status = 'Active';

            }

            if ($model->hasAttribute('created_by')) {

                $model->created_by = Yii::$app->user->id;

            }

            if ($model->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'Patient registered successfully.'
                );

                return $this->redirect([
                    'view',
                    'id' => $model->id
                ]);

            }

        }

        return $this->render(
            'create',
            [
                'model' => $model
            ]
        );

    }



    /*
    |--------------------------------------------------------------------------
    | UPDATE PATIENT
    |--------------------------------------------------------------------------
    */

    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if (
            $model->load(Yii::$app->request->post())
            &&
            $model->save()
        ) {

            Yii::$app->session->setFlash(
                'success',
                'Patient profile updated successfully.'
            );

            return $this->redirect([
                'view',
                'id' => $model->id
            ]);

        }

        return $this->render(
            'update',
            [
                'model' => $model
            ]
        );

    }



    /*
    |--------------------------------------------------------------------------
    | CREATE PATIENT VISIT
    |--------------------------------------------------------------------------
    */

    public function actionCreateVisit($id)
    {

        $patient = $this->findModel($id);

        $visit = new PatientVisit();

        $visit->patient_id = $patient->id;

        if ($visit->hasAttribute('visit_date')) {

            $visit->visit_date = date('Y-m-d H:i:s');

        }

        if (
            $visit->load(Yii::$app->request->post())
            &&
            $visit->save()
        ) {

            Yii::$app->session->setFlash(
                'success',
                'Patient visit created successfully.'
            );

            return $this->redirect([
                'view',
                'id' => $patient->id
            ]);

        }

        return $this->render(
            'create-visit',
            [
                'model' => $visit,
                'patient' => $patient
            ]
        );

    }
    /*
    |--------------------------------------------------------------------------
    | DELETE PATIENT
    |--------------------------------------------------------------------------
    */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->hasAttribute('status')) {

            $model->status = 'Deleted';
            $model->save(false);

        } else {

            $model->delete();

        }

        Yii::$app->session->setFlash(
            'success',
            'Patient removed successfully.'
        );

        return $this->redirect([
            'index'
        ]);
    }



    /*
    |--------------------------------------------------------------------------
    | FIND PATIENT
    |--------------------------------------------------------------------------
    */
    protected function findModel($id)
    {
        $model = Patient::findOne($id);

        if ($model !== null) {
            return $model;
        }

        throw new NotFoundHttpException(
            'The requested patient does not exist.'
        );
    }

}