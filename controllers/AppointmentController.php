<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\Appointment;

class AppointmentController extends Controller
{

    public function behaviors()
    {
        return [

            'access' => [

                'class' => AccessControl::class,

                'rules' => [

                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],

            ],

        ];
    }

    /**
     * Appointment List
     */
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([

            'query' => Appointment::find()
                ->with([
                    'patient',
                    'doctor',
                    'department',
                    'createdBy',
                ])
                ->orderBy([
                    'id' => SORT_DESC
                ]),

            'pagination' => [
                'pageSize' => 10,
            ],

        ]);

        return $this->render('index', [

            'dataProvider' => $dataProvider

        ]);

    }

    /**
     * Create Appointment
     */
    public function actionCreate()
    {

        $model = new Appointment();

        if ($model->load(Yii::$app->request->post())) {

            // Logged in user
            if (!Yii::$app->user->isGuest) {
                $model->created_by = Yii::$app->user->id;
            }

            // timestamps
            $model->created_at = date('Y-m-d H:i:s');

            if (empty($model->status)) {
                $model->status = Appointment::STATUS_PENDING;
            }

            if ($model->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'Appointment created successfully.'
                );

                return $this->redirect(['index']);
            }

            // show validation errors
            Yii::$app->session->setFlash(
                'error',
                json_encode($model->errors, JSON_PRETTY_PRINT)
            );
        }

        return $this->render('create', [

            'model' => $model

        ]);

    }

    /**
     * View Appointment
     */
    public function actionView($id)
    {

        return $this->render('view', [

            'model' => $this->findModel($id)

        ]);

    }

    /**
     * Update Appointment
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->updated_at = date('Y-m-d H:i:s');

            if ($model->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'Appointment updated successfully.'
                );

                return $this->redirect(['index']);
            }

            Yii::$app->session->setFlash(
                'error',
                json_encode($model->errors, JSON_PRETTY_PRINT)
            );
        }

        return $this->render('update', [

            'model' => $model

        ]);

    }

    /**
     * Delete Appointment
     */
    public function actionDelete($id)
    {

        $this->findModel($id)->delete();

        Yii::$app->session->setFlash(
            'success',
            'Appointment deleted successfully.'
        );

        return $this->redirect(['index']);

    }

    /**
     * Find Appointment
     */
    protected function findModel($id)
    {

        if (($model = Appointment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Appointment not found.');

    }

}