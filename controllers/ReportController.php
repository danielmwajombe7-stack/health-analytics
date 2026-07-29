<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;

use app\models\Patient;
use app\models\Billing;
use app\models\Appointment;
use app\models\Admission;
use app\models\LabRequest;
use app\models\Prescription;
use app\models\PatientQueue;


class ReportController extends Controller
{


    public function actionIndex()
    {


        /*
        |--------------------------------------------------------------------------
        | PATIENT ANALYTICS
        |--------------------------------------------------------------------------
        */


        $totalPatients = Patient::find()->count();



        $malePatients = Patient::find()
            ->where(['gender'=>'Male'])
            ->count();



        $femalePatients = Patient::find()
            ->where(['gender'=>'Female'])
            ->count();





        /*
        |--------------------------------------------------------------------------
        | FINANCE
        |--------------------------------------------------------------------------
        */


        $totalRevenue = Billing::find()
            ->sum('amount') ?? 0;



        $paidAmount = Billing::find()
            ->where(['status'=>'Paid'])
            ->sum('amount') ?? 0;



        $pendingAmount = Billing::find()
            ->where(['status'=>'Pending'])
            ->sum('amount') ?? 0;







        /*
        |--------------------------------------------------------------------------
        | APPOINTMENTS
        |--------------------------------------------------------------------------
        */


        $totalAppointments = Appointment::find()
            ->count();



        $completedAppointments = Appointment::find()
            ->where(['status'=>'Completed'])
            ->count();



        $pendingAppointments = Appointment::find()
            ->where(['status'=>'Pending'])
            ->count();







        /*
        |--------------------------------------------------------------------------
        | ADMISSION
        |--------------------------------------------------------------------------
        */


        $totalAdmissions = Admission::find()
            ->count();








        /*
        |--------------------------------------------------------------------------
        | LAB + PHARMACY
        |--------------------------------------------------------------------------
        */


        $totalLabRequests = LabRequest::find()
            ->count();


        // FIX VARIABLE USED IN VIEW
        $labRequests = $totalLabRequests;



        $totalPrescriptions = Prescription::find()
            ->count();







        /*
        |--------------------------------------------------------------------------
        | QUEUE
        |--------------------------------------------------------------------------
        */


        $waitingPatients = PatientQueue::find()
            ->where(['status'=>'Waiting'])
            ->count();



        $consultingPatients = PatientQueue::find()
            ->where(['status'=>'Consulting'])
            ->count();



        $completedQueue = PatientQueue::find()
            ->where(['status'=>'Completed'])
            ->count();



        // FIX VIEW VARIABLE
        $waiting = $waitingPatients;

        $completed = $completedQueue;








        /*
        |--------------------------------------------------------------------------
        | GENDER CHART
        |--------------------------------------------------------------------------
        */


        $genderChart = [

            $malePatients,

            $femalePatients

        ];


        // FIX VIEW VARIABLE
        $genderData = $genderChart;








        /*
        |--------------------------------------------------------------------------
        | MONTHLY PATIENT TREND
        |--------------------------------------------------------------------------
        */


        $monthlyData = (new Query())

            ->select([

                "MONTH(created_at) month",

                "COUNT(id) total"

            ])

            ->from('patients')

            ->groupBy(
                "MONTH(created_at)"
            )

            ->orderBy([
                'month'=>SORT_ASC
            ])

            ->all();




        $months=[];

        $patientCounts=[];



        foreach($monthlyData as $row)
        {


            $months[] = date(
                "M",
                mktime(
                    0,
                    0,
                    0,
                    $row['month'],
                    1
                )
            );



            $patientCounts[] = (int)$row['total'];

        }



        // FIX CHART VARIABLE
        $monthlyPatients = $patientCounts;









        /*
        |--------------------------------------------------------------------------
        | DISEASE ANALYTICS
        |--------------------------------------------------------------------------
        */


        $diseaseStats = (new Query())


            ->select([

                'diseases.name AS disease',

                'COUNT(diagnoses.id) AS total'

            ])


            ->from('diagnoses')


            ->leftJoin(
                'diseases',
                'diseases.id = diagnoses.disease_id'
            )


            ->groupBy(
                'diseases.name'
            )


            ->orderBy([
                'total'=>SORT_DESC
            ])


            ->limit(10)


            ->all();





        $diseases=[];

        $diseaseCounts=[];



        foreach($diseaseStats as $row)
        {

            $diseases[] =
                $row['disease'] ?? 'Unknown';



            $diseaseCounts[] =
                (int)$row['total'];

        }









        /*
        |--------------------------------------------------------------------------
        | APPOINTMENT STATUS
        |--------------------------------------------------------------------------
        */


        $appointmentStatus=[

            'Completed'=>$completedAppointments,

            'Pending'=>$pendingAppointments

        ];









        /*
        |--------------------------------------------------------------------------
        | RECENT PATIENTS
        |--------------------------------------------------------------------------
        */


        $recentPatients = Patient::find()

            ->orderBy([
                'id'=>SORT_DESC
            ])

            ->limit(10)

            ->all();









        return $this->render(
            'index',
            [


                'totalPatients'=>$totalPatients,


                'malePatients'=>$malePatients,

                'femalePatients'=>$femalePatients,



                'totalRevenue'=>$totalRevenue,

                'paidAmount'=>$paidAmount,

                'pendingAmount'=>$pendingAmount,



                'totalAppointments'=>$totalAppointments,

                'completedAppointments'=>$completedAppointments,

                'pendingAppointments'=>$pendingAppointments,



                'totalAdmissions'=>$totalAdmissions,



                'totalLabRequests'=>$totalLabRequests,

                'labRequests'=>$labRequests,


                'totalPrescriptions'=>$totalPrescriptions,



                'waitingPatients'=>$waitingPatients,

                'consultingPatients'=>$consultingPatients,

                'completedQueue'=>$completedQueue,



                'waiting'=>$waiting,

                'completed'=>$completed,



                'genderChart'=>$genderChart,

                'genderData'=>$genderData,



                'months'=>$months,

                'patientCounts'=>$patientCounts,


                'monthlyPatients'=>$monthlyPatients,



                'diseases'=>$diseases,

                'diseaseCounts'=>$diseaseCounts,



                'appointmentStatus'=>$appointmentStatus,



                'recentPatients'=>$recentPatients,


            ]
        );


    }


}