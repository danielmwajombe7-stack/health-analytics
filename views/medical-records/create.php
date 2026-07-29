<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Doctor Consultation Workspace";

?>

<div class="consultation-wrapper">

    <div class="consultation-header">

        <div>
            <h2>🩺 Doctor Consultation Workspace</h2>
            <p>Clinical examination, diagnosis and treatment decision management</p>
        </div>

        <div class="online-status">
            🟢 Consultation Active
        </div>

    </div>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'modern-form'
    ]
]); ?>

<div class="row g-4">

    <!-- Patient -->

    <div class="col-lg-6">

        <div class="medical-card">

            <h4>👤 Patient Information</h4>

            <div class="patient-box">

                <div class="avatar">
                    👨‍⚕️
                </div>

                <div>
                    <h5>Patient ID: <?= Html::encode($model->patient_id) ?></h5>
                    <p>Current Clinical Examination</p>
                </div>

            </div>

            <?= $form->field($model,'patient_id')->textInput([
                'readonly'=>true
            ]) ?>

            <?= $form->field($model,'doctor_id')->textInput([
                'readonly'=>true,
                'value'=>Yii::$app->user->id
            ]) ?>

        </div>

    </div>


    <!-- Vital Signs -->

    <div class="col-lg-6">

        <div class="medical-card">

            <h4>❤️ Vital Signs Monitoring</h4>

            <div class="row">

                <div class="col-md-6">

                    <?= $form->field($model,'blood_pressure')->textInput([
                        'placeholder'=>'120 / 80'
                    ]) ?>

                </div>

                <div class="col-md-6">

                    <?= $form->field($model,'temperature')->textInput([
                        'placeholder'=>'36.5'
                    ]) ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <input
                        type="number"
                        id="weight"
                        class="form-control"
                        placeholder="Weight (KG)">

                </div>

                <div class="col-md-6">

                    <input
                        type="number"
                        id="height"
                        class="form-control"
                        placeholder="Height (CM)">

                </div>

            </div>

            <div class="bmi-box mt-3">

                BMI :
                <span id="bmi">0</span>

            </div>

        </div>

    </div>


    <!-- Complaint -->

    <div class="col-12">

        <div class="medical-card">

            <h4>📝 Patient Complaint</h4>

            <?= $form->field($model,'complaint')->textarea([
                'rows'=>4,
                'placeholder'=>'Patient symptoms and complaints'
            ]) ?>

        </div>

    </div>


    <!-- Diagnosis -->

    <div class="col-12">

        <div class="medical-card">

            <h4>🩺 Clinical Assessment</h4>

            <?= $form->field($model,'diagnosis')->textarea([
                'rows'=>5,
                'placeholder'=>'Doctor diagnosis'
            ]) ?>

            <hr>

            <h4 class="mb-3">
                🧪 Laboratory Investigation
            </h4>

            <?= Html::a(
                '<i class="fas fa-flask"></i> Request Laboratory Investigation',
                [
                    '/laboratory/create',
                    'patient_id'=>$model->patient_id
                ],
                [
                    'class'=>'btn btn-lab-modern',
                    'target'=>'_blank'
                ]
            ) ?>

        </div>

    </div>

    <!-- Action Buttons -->

    <div class="col-12">

        <div class="action-panel">

            <?= Html::submitButton(
                '💾 Save Consultation',
                [
                    'class'=>'btn btn-success btn-lg'
                ]
            ) ?>

            <?= Html::a(
                '⬅ Back To Queue',
                ['/patient-queue/index'],
                [
                    'class'=>'btn btn-outline-secondary btn-lg'
                ]
            ) ?>

        </div>

    </div>

</div>

<?php ActiveForm::end(); ?>

</div>
<style>

.consultation-wrapper{

    padding:30px;
    background:#f4f8f8;

}


/* HEADER */

.consultation-header{

    background:white;

    padding:30px;

    border-radius:25px;

    display:flex;

    justify-content:space-between;

    align-items:center;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

    margin-bottom:30px;

}


.consultation-header h2{

    color:#00695c;

    font-weight:900;

}


.consultation-header p{

    color:#64748b;

    font-weight:600;

}



/* STATUS */

.online-status{

    background:#dcfce7;

    color:#15803d;

    padding:15px 25px;

    border-radius:30px;

    font-weight:800;

}



/* CARD */

.medical-card{

    background:white;

    padding:25px;

    border-radius:25px;

    height:100%;

    box-shadow:

    0 8px 25px rgba(0,0,0,.07);

    transition:.3s;

}


.medical-card:hover{

    transform:translateY(-5px);

    box-shadow:

    0 15px 35px rgba(0,0,0,.12);

}



.medical-card h4{

    color:#00695c;

    font-weight:900;

    margin-bottom:20px;

}



/* PATIENT */

.patient-box{

    display:flex;

    gap:20px;

    align-items:center;

    background:#ecfeff;

    padding:20px;

    border-radius:20px;

}



.avatar{

    font-size:35px;

    background:white;

    padding:15px;

    border-radius:50%;

}



/* INPUTS */


.form-control,
.form-select{

    border-radius:15px;

    padding:14px;

    border:1px solid #cbd5e1;

}


.form-control:focus{

    border-color:#14b8a6;

    box-shadow:0 0 0 .2rem rgba(20,184,166,.15);

}



/* BMI */

.bmi-box{

    background:#f0fdf4;

    color:#166534;

    padding:15px;

    border-radius:15px;

    font-weight:900;

}



/* LAB BUTTON */

.lab-box{

    background:

    linear-gradient(

    135deg,

    #00695c,

    #14b8a6

    );

    padding:25px;

    border-radius:25px;

    color:white;

    text-align:center;

    margin-top:25px;

}



.lab-box h5{

    font-size:22px;

    font-weight:900;

}



.lab-box p{

    opacity:.9;

}



.lab-btn{


background:white;

color:#00695c;

padding:14px 25px;

border-radius:50px;

font-weight:900;

display:block;

transition:.3s;

text-decoration:none;

}



.lab-btn:hover{


background:#ecfeff;

color:#004d40;

transform:scale(1.05);

}





/* ACTION */


.action-panel{

    background:white;

    padding:25px;

    border-radius:20px;

    display:flex;

    justify-content:center;

    gap:20px;

}



.btn{

    border-radius:15px;

    padding:14px 35px;

    font-weight:900;

}




/* MOBILE */

@media(max-width:768px){


.consultation-header{

    flex-direction:column;

    gap:20px;

}


.action-panel{

    flex-direction:column;

}


}


</style>




<script>


function calculateBMI(){


let weight =
document.getElementById("weight").value;


let height =
document.getElementById("height").value / 100;



if(weight > 0 && height > 0){


document.getElementById("bmi").innerHTML =

(weight/(height*height)).toFixed(2);



}


}



document
.getElementById("weight")
.addEventListener(
"keyup",
calculateBMI
);



document
.getElementById("height")
.addEventListener(
"keyup",
calculateBMI
);



</script>