<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

use app\models\VitalSigns;
use app\models\PatientQueue;
use app\models\MedicalRecords;
use app\models\LabRequest;
use app\models\LabResult;
use app\models\Prescription;
use app\models\Diagnosis;



class DoctorController extends Controller
{


/*
|--------------------------------------------------------------------------
| ACCESS CONTROL
|--------------------------------------------------------------------------
*/

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
| DOCTOR SMART DASHBOARD
|--------------------------------------------------------------------------
*/

public function actionIndex()
{


$dataProvider = new ActiveDataProvider([


'query'=>PatientQueue::find()

->with([

    'patient',

    'visit.vitalSigns'

])


->where([

'status'=>[

    'Ready For Doctor',

    'Consulting'

]

])


->orderBy([

'id'=>SORT_ASC

]),



'pagination'=>[

'pageSize'=>15

]


]);









return $this->render('index',[


'dataProvider'=>$dataProvider,



'todayPatients'=>

PatientQueue::find()

->where([

'between',

'created_at',

date('Y-m-d 00:00:00'),

date('Y-m-d 23:59:59')

])

->count(),





'waitingCount'=>

PatientQueue::find()

->where([

'status'=>'Waiting'

])

->count(),





'readyCount'=>

PatientQueue::find()

->where([

'status'=>'Ready For Doctor'

])

->count(),





'consultingCount'=>

PatientQueue::find()

->where([

'status'=>'Consulting'

])

->count(),





'completedCount'=>

PatientQueue::find()

->where([

'status'=>'Completed'

])

->count(),





'criticalCount'=>

VitalSigns::find()

->where([

'triage_level'=>'Critical'

])

->count(),





'notificationCount'=>

$this->getNotificationCount()


]);


}









/*
|--------------------------------------------------------------------------
| PATIENT WORKLIST
|--------------------------------------------------------------------------
*/

public function actionPatients()
{


$patients = PatientQueue::find()

->with([

'patient',

'visit.vitalSigns'

])


->where([

'status'=>[

'Ready For Doctor',

'Consulting'

]

])


->orderBy([

'id'=>SORT_ASC

])


->all();





return $this->render('patients',[

'patients'=>$patients

]);


}









/*
|--------------------------------------------------------------------------
| CALL PATIENT
|--------------------------------------------------------------------------
*/

public function actionCall($id)
{


$queue=$this->findQueue($id);



$queue->status='Consulting';





if($queue->hasAttribute('doctor_id'))
{

    $queue->doctor_id =
        Yii::$app->user->id;

}





if($queue->hasAttribute('called_time'))
{

    $queue->called_time =
        date('Y-m-d H:i:s');

}





$queue->save(false);





Yii::$app->session->setFlash(

'success',

'Patient moved to consultation'

);






return $this->redirect([

'consultation',

'id'=>$queue->id

]);


}









/*
|--------------------------------------------------------------------------
| DOCTOR WORKLIST
|--------------------------------------------------------------------------
*/

public function actionWorklist()
{


$dataProvider = new ActiveDataProvider([


'query'=>PatientQueue::find()

->with([

'patient',

'visit.vitalSigns'

])


->where([

'status'=>[

'Ready For Doctor',

'Consulting'

]

])


->orderBy([

'id'=>SORT_ASC

]),



'pagination'=>[

'pageSize'=>20

]


]);





return $this->render('worklist',[

'dataProvider'=>$dataProvider

]);


}









/*
|--------------------------------------------------------------------------
| ADVANCED LABORATORY COMMAND CENTER
|--------------------------------------------------------------------------
*/

public function actionLabResults()
{


/*
|--------------------------------------------------------------------------
| LIVE RESULTS TABLE
|--------------------------------------------------------------------------
*/


$dataProvider = new ActiveDataProvider([


'query'=>LabResult::find()

->with([

'test',

'test.request',

'test.request.patient'

])

->orderBy([

'id'=>SORT_DESC

]),



'pagination'=>[

'pageSize'=>20

]


]);









/*
|--------------------------------------------------------------------------
| LAB FLOW STATISTICS
|--------------------------------------------------------------------------
*/


$totalInvestigations = LabRequest::find()
->count();





$orderedTests = LabRequest::find()

->where([

'status'=>[

'Pending',

'Ordered'

]

])

->count();






$processingTests = LabRequest::find()

->where([

'status'=>[

'Processing',

'Running'

]

])

->count();







$completedTests = LabResult::find()
->count();







$criticalFindings = LabResult::find()

->where([

'status'=>'Critical'

])

->count();









/*
|--------------------------------------------------------------------------
| AI CLINICAL ALERTS
|--------------------------------------------------------------------------
*/


$criticalAlerts = LabResult::find()

->with([

'test.request.patient'

])

->where([

'status'=>'Critical'

])

->orderBy([

'id'=>SORT_DESC

])

->limit(5)

->all();









/*
|--------------------------------------------------------------------------
| LIVE LAB QUEUE
|--------------------------------------------------------------------------
*/


$labQueue = LabRequest::find()

->with([

'patient'

])

->orderBy([

'id'=>SORT_DESC

])

->limit(10)

->all();









/*
|--------------------------------------------------------------------------
| PATIENT JOURNEY
|--------------------------------------------------------------------------
*/


$timeline = [


[

'title'=>'Doctor Request',

'icon'=>'👨‍⚕️',

'status'=>'Completed'

],



[

'title'=>'Sample Collection',

'icon'=>'🩸',

'status'=>'Active'

],



[

'title'=>'Laboratory Processing',

'icon'=>'🧪',

'status'=>'Waiting'

],



[

'title'=>'Result Verification',

'icon'=>'✓',

'status'=>'Waiting'

],



[

'title'=>'Doctor Decision',

'icon'=>'📋',

'status'=>'Waiting'

]


];









return $this->render('lab-results',[


'dataProvider'=>$dataProvider,


'totalInvestigations'=>$totalInvestigations,


'orderedTests'=>$orderedTests,


'processingTests'=>$processingTests,


'completedTests'=>$completedTests,


'criticalFindings'=>$criticalFindings,


'criticalAlerts'=>$criticalAlerts,


'labQueue'=>$labQueue,


'timeline'=>$timeline


]);


}
/*
|--------------------------------------------------------------------------
| OPEN LAB RESULT DETAIL
|--------------------------------------------------------------------------
*/

public function actionViewLabResult($id)
{


$result = LabResult::find()

->with([

    'test',

    'test.request',

    'test.request.patient'

])

->where([

    'id'=>$id

])

->one();






if(!$result)
{

throw new NotFoundHttpException(

'Laboratory result not found'

);

}





return $this->render('view-lab-result',[

'result'=>$result

]);


}









/*
|--------------------------------------------------------------------------
| OPEN PATIENT EMR FROM LAB
|--------------------------------------------------------------------------
*/

public function actionOpenPatient($id)
{


$result = LabResult::find()

->with([

    'test',

    'test.request',

    'test.request.patient'

])

->where([

'id'=>$id

])

->one();







if(!$result)
{

throw new NotFoundHttpException(

'Laboratory result not found'

);

}







/*
|--------------------------------------------------------------------------
| FIND RELATED QUEUE
|--------------------------------------------------------------------------
*/


$queueId = null;



if(
$result->test
&&
$result->test->request
)
{

    $queueId =
    $result->test->request->queue_id;

}






if(!$queueId)
{

throw new NotFoundHttpException(

'Patient consultation queue not available'

);

}








return $this->redirect([

'consultation',

'id'=>$queueId

]);


}









/*
|--------------------------------------------------------------------------
| DOCTOR CONSULTATION EMR
|--------------------------------------------------------------------------
*/


public function actionConsultation($id)
{


$queue = $this->findQueue($id);





if(!$queue->patient)
{

throw new NotFoundHttpException(

'Patient not found'

);

}






$patient = $queue->patient;









/*
|--------------------------------------------------------------------------
| CURRENT VITAL SIGNS
|--------------------------------------------------------------------------
*/


$vitals = VitalSigns::find()

->where([

'visit_id'=>$queue->visit_id

])

->orderBy([

'id'=>SORT_DESC

])

->one();









/*
|--------------------------------------------------------------------------
| MEDICAL HISTORY
|--------------------------------------------------------------------------
*/


$history = MedicalRecords::find()

->where([

'patient_id'=>$patient->id

])

->orderBy([

'id'=>SORT_DESC

])

->limit(20)

->all();









/*
|--------------------------------------------------------------------------
| PREVIOUS DIAGNOSIS
|--------------------------------------------------------------------------
*/


$previousDiagnoses = Diagnosis::find()

->where([

'patient_id'=>$patient->id

])

->orderBy([

'id'=>SORT_DESC

])

->limit(20)

->all();









/*
|--------------------------------------------------------------------------
| PRESCRIPTION HISTORY
|--------------------------------------------------------------------------
*/


$prescriptions = Prescription::find()

->where([

'patient_id'=>$patient->id

])

->orderBy([

'id'=>SORT_DESC

])

->limit(20)

->all();






/*
|--------------------------------------------------------------------------
| LAB RESULT HISTORY
|--------------------------------------------------------------------------
*/

$labResults = LabResult::find()

->joinWith([

'test.patient'

])

->where([

'patients.id'=>$patient->id

])

->orderBy([

'lab_results.id'=>SORT_DESC

])

->limit(20)

->all();









/*
|--------------------------------------------------------------------------
| MEDICAL RECORD MODEL
|--------------------------------------------------------------------------
*/


$model = new MedicalRecords();


$model->patient_id =
$patient->id;





if($model->hasAttribute('visit_id'))
{

$model->visit_id =
$queue->visit_id;

}





if($model->hasAttribute('doctor_id'))
{

$model->doctor_id =
Yii::$app->user->id;

}









/*
|--------------------------------------------------------------------------
| DIAGNOSIS MODEL
|--------------------------------------------------------------------------
*/


$diagnosisModel = new Diagnosis();





if($diagnosisModel->hasAttribute('patient_id'))
{

$diagnosisModel->patient_id =
$patient->id;

}





if($diagnosisModel->hasAttribute('visit_id'))
{

$diagnosisModel->visit_id =
$queue->visit_id;

}






if($diagnosisModel->hasAttribute('doctor_id'))
{

$diagnosisModel->doctor_id =
Yii::$app->user->id;

}









/*
|--------------------------------------------------------------------------
| PRESCRIPTION MODEL
|--------------------------------------------------------------------------
*/


$prescriptionModel = new Prescription();






if($prescriptionModel->hasAttribute('patient_id'))
{

$prescriptionModel->patient_id =
$patient->id;

}






if($prescriptionModel->hasAttribute('visit_id'))
{

$prescriptionModel->visit_id =
$queue->visit_id;

}







if($prescriptionModel->hasAttribute('doctor_id'))
{

$prescriptionModel->doctor_id =
Yii::$app->user->id;

}









/*
|--------------------------------------------------------------------------
| LAB REQUEST MODEL
|--------------------------------------------------------------------------
*/


$labRequestModel = new LabRequest();






if($labRequestModel->hasAttribute('patient_id'))
{

$labRequestModel->patient_id =
$patient->id;

}







if($labRequestModel->hasAttribute('visit_id'))
{

$labRequestModel->visit_id =
$queue->visit_id;

}







if($labRequestModel->hasAttribute('doctor_id'))
{

$labRequestModel->doctor_id =
Yii::$app->user->id;

}






/*
|--------------------------------------------------------------------------
| POST EMR ACTIONS
|--------------------------------------------------------------------------
*/


if(Yii::$app->request->isPost)
{


$post = Yii::$app->request->post();



$transaction =
Yii::$app->db->beginTransaction();



try
{


/*
|--------------------------------------------------------------------------
| SAVE DIAGNOSIS
|--------------------------------------------------------------------------
*/


if(isset($post['save_diagnosis']))
{


$diagnosisModel->load($post);



if($diagnosisModel->hasAttribute('created_at'))
{

$diagnosisModel->created_at =
date('Y-m-d H:i:s');

}






if(!$diagnosisModel->save())
{

throw new \Exception(

'Diagnosis saving failed'

);

}





$transaction->commit();





Yii::$app->session->setFlash(

'success',

'Diagnosis saved successfully'

);





return $this->refresh();


}






/*
|--------------------------------------------------------------------------
| SAVE PRESCRIPTION
|--------------------------------------------------------------------------
*/


if(isset($post['save_prescription']))
{


$prescriptionModel->load($post);





if($prescriptionModel->hasAttribute('status'))
{

$prescriptionModel->status =
'Pending';

}





if($prescriptionModel->hasAttribute('created_at'))
{

$prescriptionModel->created_at =
date('Y-m-d H:i:s');

}






if(!$prescriptionModel->save())
{

throw new \Exception(

'Prescription saving failed'

);

}





$transaction->commit();





Yii::$app->session->setFlash(

'success',

'Prescription sent to pharmacy'

);





return $this->refresh();


}






/*
|--------------------------------------------------------------------------
| SAVE LAB REQUEST
|--------------------------------------------------------------------------
*/


if(isset($post['save_lab']))
{


$labRequestModel->load($post);





if($labRequestModel->hasAttribute('status'))
{

$labRequestModel->status =
'Pending';

}





if($labRequestModel->hasAttribute('request_date'))
{

$labRequestModel->request_date =
date('Y-m-d H:i:s');

}






if(!$labRequestModel->save())
{

throw new \Exception(

'Lab request failed'

);

}





$transaction->commit();





Yii::$app->session->setFlash(

'success',

'Laboratory request sent'

);





return $this->refresh();


}
/*
|--------------------------------------------------------------------------
| COMPLETE CONSULTATION
|--------------------------------------------------------------------------
*/

if(isset($post['save_consultation']))
{


$model->load($post);





if($model->hasAttribute('created_at'))
{

$model->created_at =
date('Y-m-d H:i:s');

}





if($model->hasAttribute('doctor_id'))
{

$model->doctor_id =
Yii::$app->user->id;

}





if(!$model->save())
{

throw new \Exception(

'Medical record saving failed'

);

}









/*
|--------------------------------------------------------------------------
| COMPLETE QUEUE
|--------------------------------------------------------------------------
*/


$queue->status =
'Completed';







if($queue->hasAttribute('finished_time'))
{

$queue->finished_time =
date('Y-m-d H:i:s');

}





if($queue->hasAttribute('consulted_at'))
{

$queue->consulted_at =
date('Y-m-d H:i:s');

}






$queue->save(false);









/*
|--------------------------------------------------------------------------
| UPDATE PATIENT VISIT
|--------------------------------------------------------------------------
*/


if($queue->visit)
{


if($queue->visit->hasAttribute('status'))
{

$queue->visit->status =
'Completed';

}





if($queue->visit->hasAttribute('completed_at'))
{

$queue->visit->completed_at =
date('Y-m-d H:i:s');

}





$queue->visit->save(false);


}









/*
|--------------------------------------------------------------------------
| AUDIT LOG
|--------------------------------------------------------------------------
*/


if(class_exists(\app\models\AuditLog::class))
{


$audit = new \app\models\AuditLog();




if($audit->hasAttribute('user_id'))
{

$audit->user_id =
Yii::$app->user->id;

}




if($audit->hasAttribute('action'))
{

$audit->action =
'Completed Consultation';

}




if($audit->hasAttribute('description'))
{

$audit->description =
'Doctor completed consultation for patient ID '
.$patient->id;

}





if($audit->hasAttribute('created_at'))
{

$audit->created_at =
date('Y-m-d H:i:s');

}





$audit->save(false);


}








$transaction->commit();





Yii::$app->session->setFlash(

'success',

'Consultation completed successfully'

);






return $this->redirect([

'index'

]);


}







throw new \Exception(

'Unknown EMR action'

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


}









/*
|--------------------------------------------------------------------------
| RENDER CONSULTATION
|--------------------------------------------------------------------------
*/


return $this->render('consultation',[


'queue'=>$queue,


'patient'=>$patient,


'vitals'=>$vitals,


'history'=>$history,


'previousDiagnoses'=>$previousDiagnoses,


'prescriptions'=>$prescriptions,


'labResults'=>$labResults,


'model'=>$model,


'diagnosisModel'=>$diagnosisModel,


'prescriptionModel'=>$prescriptionModel,


'labRequestModel'=>$labRequestModel


]);


}









/*
|--------------------------------------------------------------------------
| NOTIFICATION ENGINE
|--------------------------------------------------------------------------
*/


protected function getNotificationCount()
{


$queueNotifications = PatientQueue::find()

->where([

'status'=>'Ready For Doctor'

])

->count();







$labNotifications = LabRequest::find()

->where([

'status'=>'Pending'

])

->count();







return $queueNotifications + $labNotifications;


}









/*
|--------------------------------------------------------------------------
| COMPLETE PATIENT
|--------------------------------------------------------------------------
*/


public function actionComplete($id)
{


$queue =
$this->findQueue($id);





$queue->status =
'Completed';







if($queue->hasAttribute('finished_time'))
{

$queue->finished_time =
date('Y-m-d H:i:s');

}






if($queue->hasAttribute('consulted_at'))
{

$queue->consulted_at =
date('Y-m-d H:i:s');

}






$queue->save(false);









if($queue->visit)
{


if($queue->visit->hasAttribute('status'))
{

$queue->visit->status =
'Completed';

}





if($queue->visit->hasAttribute('completed_at'))
{

$queue->visit->completed_at =
date('Y-m-d H:i:s');

}





$queue->visit->save(false);


}







Yii::$app->session->setFlash(

'success',

'Patient consultation completed'

);







return $this->redirect([

'index'

]);


}









/*
|--------------------------------------------------------------------------
| PATIENT QUICK PROFILE
|--------------------------------------------------------------------------
*/


public function actionPatientProfile($id)
{


$queue =
$this->findQueue($id);







if(!$queue->patient)
{

throw new NotFoundHttpException(

'Patient profile unavailable'

);

}







return $this->render('patient-profile',[


'patient'=>$queue->patient,


'queue'=>$queue


]);


}









/*
|--------------------------------------------------------------------------
| LAB REPORT
|--------------------------------------------------------------------------
*/


public function actionReport($id)
{


$result =
LabResult::find()

->with([

'test',

'test.request',

'test.request.patient'

])

->where([

'id'=>$id

])

->one();







if(!$result)
{

throw new NotFoundHttpException(

'Laboratory report not found'

);

}







return $this->render('report',[

'result'=>$result

]);


}









/*
|--------------------------------------------------------------------------
| FIND QUEUE
|--------------------------------------------------------------------------
*/


protected function findQueue($id)
{


$model =
PatientQueue::find()

->with([


'patient',


'visit',


'visit.vitalSigns'


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

'Patient queue record not found'

);



}









/*
|--------------------------------------------------------------------------
| SECURITY
|--------------------------------------------------------------------------
*/


public function beforeAction($action)
{


return parent::beforeAction($action);


}



}