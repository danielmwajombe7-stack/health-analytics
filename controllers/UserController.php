<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\User;


class UserController extends Controller
{


    public function behaviors()
    {

        return [

            'access'=>[

                'class'=>AccessControl::class,

                'rules'=>[

                    [

                        'allow'=>true,

                        'roles'=>['@'],

                    ],

                ],

            ],

        ];

    }





    /**
     * Users Management Dashboard
     */
    public function actionIndex()
    {


        $query = User::find()
            ->with(['role'])
            ->orderBy([
                'id'=>SORT_DESC
            ]);



        $dataProvider = new ActiveDataProvider([

            'query'=>$query,

            'pagination'=>[

                'pageSize'=>10

            ]

        ]);




        return $this->render('index',[


            'dataProvider'=>$dataProvider,


            'users'=>$dataProvider->getModels(),



            // TOTAL USERS
            'totalUsers'=>User::find()->count(),




            // ACTIVE USERS
            'activeUsers'=>User::find()

                ->where([
                    'status'=>1
                ])

                ->count(),




            // DOCTORS
            'doctorCount'=>User::find()

                ->joinWith('role')

                ->where([
                    'roles.role_name'=>'Doctor'
                ])

                ->count(),





            // NURSES
            'nurseCount'=>User::find()

                ->joinWith('role')

                ->where([
                    'roles.role_name'=>'Nurse'
                ])

                ->count(),





            // ADMIN + SUPER ADMIN
            'adminCount'=>User::find()

                ->joinWith('role')

                ->where([

                    'roles.role_name'=>[
                        'Admin',
                        'Super Admin'
                    ]

                ])

                ->count(),



        ]);

    }









    /**
     * Create User
     */
    public function actionCreate()
    {


        $model=new User();



        if(
            $model->load(
                Yii::$app->request->post()
            )
        )
        {


            if(
                !empty($model->password)
            )
            {

                $model->password_hash =
                    Yii::$app->security
                    ->generatePasswordHash(
                        $model->password
                    );

            }



            $model->status = 1;



            if($model->save(false))
            {


                Yii::$app->session->setFlash(

                    'success',

                    'User created successfully'

                );


                return $this->redirect([
                    'index'
                ]);

            }


        }



        return $this->render('create',[

            'model'=>$model

        ]);

    }









    /**
     * View User
     */
    public function actionView($id)
    {


        return $this->render('view',[

            'model'=>$this->findModel($id)

        ]);

    }









    /**
     * Update User
     */
    public function actionUpdate($id)
    {


        $model=$this->findModel($id);



        if(
            $model->load(
                Yii::$app->request->post()
            )
        )
        {


            if(
                !empty($model->password)
            )
            {

                $model->password_hash =
                    Yii::$app->security
                    ->generatePasswordHash(
                        $model->password
                    );

            }



            if($model->save(false))
            {


                Yii::$app->session->setFlash(

                    'success',

                    'User updated successfully'

                );


                return $this->redirect([
                    'index'
                ]);

            }

        }




        return $this->render('update',[

            'model'=>$model

        ]);

    }









    /**
     * Delete User
     */
    public function actionDelete($id)
    {


        $model=$this->findModel($id);



        if($model->delete())
        {


            Yii::$app->session->setFlash(

                'success',

                'User deleted successfully'

            );

        }



        return $this->redirect([
            'index'
        ]);

    }









    protected function findModel($id)
    {


        if(
            ($model=User::findOne($id))
            !==null
        )
        {

            return $model;

        }



        throw new NotFoundHttpException(

            'User not found.'

        );


    }




}