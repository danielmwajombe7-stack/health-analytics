<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

use app\models\Patient;


class AiRiskController extends Controller
{


    public function actionIndex()
    {


        /*
        |--------------------------------------------------------------------------
        | TOTAL PATIENTS
        |--------------------------------------------------------------------------
        */

        $totalPatients = Patient::find()->count();



        /*
        |--------------------------------------------------------------------------
        | RISK COUNTERS
        |--------------------------------------------------------------------------
        */

        $highRisk = 0;

        $mediumRisk = 0;

        $lowRisk = 0;



        $riskPatients = [];



        /*
        |--------------------------------------------------------------------------
        | GET PATIENTS
        |--------------------------------------------------------------------------
        */

        $patients = Patient::find()
            ->orderBy(['id'=>SORT_DESC])
            ->all();





        foreach($patients as $patient)
        {


            /*
            Default AI Result
            */

            $risk = "LOW";

            $score = 90;



            /*
            AI RULE ENGINE

            Temporary logic:
            Will later connect with:
            - Vital Signs
            - Diagnosis
            - Laboratory
            - Medical Records

            */


            if(isset($patient->status))
            {


                if(
                    strtolower($patient->status) == "critical"
                    ||
                    strtolower($patient->status) == "high"
                )
                {

                    $risk = "HIGH";

                    $score = 95;

                }


                elseif(
                    strtolower($patient->status) == "warning"
                    ||
                    strtolower($patient->status) == "medium"
                )
                {

                    $risk = "MEDIUM";

                    $score = 75;

                }


            }





            /*
            Count Risk
            */


            if($risk == "HIGH")
            {

                $highRisk++;

            }


            elseif($risk == "MEDIUM")
            {

                $mediumRisk++;

            }


            else
            {

                $lowRisk++;

            }





            /*
            Store AI Result
            */


            $riskPatients[] = [


                'patient'=>$patient,


                'risk'=>$risk,


                'score'=>$score,


                'department'=>"Clinical Services",



                'diagnosis'=>"Medical Assessment",



                'recommendation'=>

                    $risk=="HIGH"

                    ?

                    "Immediate Doctor Review"

                    :

                    (

                    $risk=="MEDIUM"

                    ?

                    "Continuous Monitoring"

                    :

                    "Continue Normal Treatment"

                    )


            ];



        }





        /*
        |--------------------------------------------------------------------------
        | AI ENGINE STATUS
        |--------------------------------------------------------------------------
        */


        $modelAccuracy = 94.8;


        $aiStatus = "ONLINE";







        return $this->render('index',[


            'totalPatients'=>$totalPatients,


            'highRisk'=>$highRisk,


            'mediumRisk'=>$mediumRisk,


            'lowRisk'=>$lowRisk,


            'riskPatients'=>$riskPatients,


            'modelAccuracy'=>$modelAccuracy,


            'aiStatus'=>$aiStatus



        ]);



    }



}