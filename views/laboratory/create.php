<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Patient;
use app\models\LabTest;

$this->title = "Request Laboratory Investigation";

// GET PATIENT
$patientName = "Unknown Patient";
if(!empty($model->patient_id)){
    $patient = Patient::findOne($model->patient_id);
    if($patient){
        $patientName = trim(($patient->first_name ?? '')." ".($patient->last_name ?? ''));
    }
}
?>

<div class="container-fluid">

<div class="lab-header">
    <h2>🧪 Laboratory Investigation Request</h2>
    <p>Send patient laboratory examination request to laboratory department.</p>
</div>

<?php $form = ActiveForm::begin([
    'id'=>'lab-request-form',
    'action'=>['laboratory/create'], // route to controller
    'method'=>'post',
    'enableClientValidation'=>true,
]); ?>

<div class="row g-4">

<!-- PATIENT INFORMATION -->
<div class="col-lg-6">
<div class="medical-card">
    <h4>👤 Patient Information</h4>
    <?= $form->field($model,'patient_id')->hiddenInput(['value'=>$model->patient_id])->label(false) ?>
    <div class="patient-box">👤 <?= Html::encode($patientName) ?></div>
    <?= $form->field($model,'doctor_id')->hiddenInput(['value'=>Yii::$app->user->id])->label(false) ?>
    <div class="doctor-box">🩺 Doctor ID: <?= Yii::$app->user->id ?></div>
</div>
</div>

<!-- TEST INFORMATION -->
<div class="col-lg-6">
<div class="medical-card">
    <h4>🧪 Test Information</h4>
    <?= $form->field($model,'test_name')->dropDownList(
        ArrayHelper::map(
            LabTest::find()->select(['test_name'])->distinct()->orderBy(['test_name'=>SORT_ASC])->all(),
            'test_name','test_name'
        ),
        ['prompt'=>'Select Laboratory Test']
    ) ?>
    <?= $form->field($model,'priority')->dropDownList(
        ['Normal'=>'🟢 Normal','Urgent'=>'🟡 Urgent','Critical'=>'🔴 Critical'],
        ['prompt'=>'Select Priority']
    ) ?>
</div>
</div>

<!-- STATUS HIDDEN -->
<?= $form->field($model,'status')->hiddenInput(['value'=>'Pending'])->label(false) ?>

<!-- CREATED DATE -->
<?= $form->field($model,'created_at')->hiddenInput(['value'=>date('Y-m-d H:i:s')])->label(false) ?>

<!-- WORKFLOW -->
<div class="col-12">
<div class="medical-card">
    <h4>📝 Laboratory Workflow</h4>
    <div class="clinical-box">
        🧪 Laboratory technician will receive this request, process examination and upload results for doctor review.
    </div>
</div>
</div>

<!-- ONLY BACK BUTTON -->
<div class="col-12">
<div class="action-box">
    <?= Html::a('⬅ Back',['doctor/index'],['class'=>'btn btn-secondary btn-lg']) ?>
</div>
</div>

</div>
<?php ActiveForm::end(); ?>
</div>
