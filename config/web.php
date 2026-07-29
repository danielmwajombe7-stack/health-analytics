<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';


$config = [

    'id' => 'health-analytics',

    'name' => 'myles Health Analytics System',


    'basePath' => dirname(__DIR__),


    'controllerNamespace' => 'app\controllers',


    'bootstrap' => [

        'log',

    ],



    'modules' => [

        'debug' => [

            'class' => 'yii\debug\Module',

        ],


        'gii' => [

            'class' => 'yii\gii\Module',

        ],

    ],





    'components' => [



        'request' => [

            'cookieValidationKey' => 'dv-MVpr-10cvpW_MTWT2AwOFC0eMdkWc',

            'enableCsrfValidation' => true,

        ],





        'user' => [

            'identityClass' => 'app\models\User',

            'enableAutoLogin' => false,

        ],





        'session' => [

            'class' => 'yii\web\Session',

            'timeout' => 3600,

        ],





        'cache' => [

            'class' => 'yii\caching\FileCache',

        ],





        /*
        |--------------------------------------------------------------------------
        | FIX YII2 ASSET MANAGER
        |--------------------------------------------------------------------------
        */

        'assetManager' => [

            'class' => 'yii\web\AssetManager',

            'basePath' => dirname(__DIR__) . '/web/assets',

            'baseUrl' => '@web/assets',

            'appendTimestamp' => true,

            'linkAssets' => false,


            'bundles' => [


                /*
                |--------------------------------------------------------------------------
                | Fix JQuery Missing vendor/bower/jquery/dist
                |--------------------------------------------------------------------------
                */

                'yii\web\JqueryAsset' => [

                    'sourcePath' => '@vendor/bower-asset/jquery/dist',

                    'js' => [

                        'jquery.min.js',

                    ],

                ],



                /*
                |--------------------------------------------------------------------------
                | Optional Disable Yii CSS conflicts
                |--------------------------------------------------------------------------
                */

                'yii\bootstrap5\BootstrapAsset' => [

                    'css' => [],

                ],


            ],

        ],






        'errorHandler' => [

            'errorAction' => 'site/error',

        ],





        'mailer' => [

            'class' => 'yii\symfonymailer\Mailer',

            'useFileTransport' => true,

        ],






        'log' => [

            'traceLevel' => YII_DEBUG ? 3 : 0,


            'targets' => [

                [

                    'class' => 'yii\log\FileTarget',

                    'levels' => [

                        'error',

                        'warning',

                    ],

                ],

            ],

        ],






        'db' => $db,








        'urlManager' => [

            'enablePrettyUrl' => true,

            'showScriptName' => false,

            'enableStrictParsing' => false,


            'rules' => [


                // Dashboard

                '' => 'site/index',




                // Laboratory

                'laboratory' => 'laboratory/index',


                'laboratory/create/<patient_id:\d+>' => 'laboratory/create',





                // Patients

                'patients' => 'patients/index',





                // Doctor

                'doctor' => 'doctor/index',





            ],

        ],



    ],





    'params' => $params,


];






if (YII_ENV_DEV) {


    $config['bootstrap'][] = 'debug';


    $config['bootstrap'][] = 'gii';


}



return $config;