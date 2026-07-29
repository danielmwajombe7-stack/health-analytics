<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Update Patient Visit";

$status = strtolower($model->status);

$statusClass = match(true){

    str_contains($status,'waiting') 
        => 'waiting',

    str_contains($status,'progress') 
        => 'progress',

    str_contains($status,'completed') 
        => 'completed',

    str_contains($status,'critical') 
        => 'critical',

    default => 'default'

};

?>


<div class="container-fluid py-4">


<!-- PAGE HEADER -->

<div class="page-header mb-4">


<div>


<h1>
<i class="fa fa-stethoscope"></i>

Update Patient Visit
</h1>


<p>
Manage patient consultation workflow, doctor assignment and clinical status
</p>


</div>



<div class="system-badge">

<i class="fa fa-circle"></i>

MHAS Clinical System Online

</div>


</div>





<?php $form = ActiveForm::begin(); ?>



<div class="row g-4">





<!-- PATIENT PROFILE -->


<div class="col-xl-5">


<div class="modern-card">


<div class="card-header-modern">

<i class="fa fa-user-circle"></i>

Patient Profile


</div>



<div class="profile-main">


<div class="avatar">


<?= strtoupper(substr(
$model->patient 
? $model->patient->fullName
:"UN",
0,
2
)) ?>


</div>




<div>


<h2>

<?= $model->patient
?
$model->patient->fullName
:
"Unknown Patient"

?>

</h2>


<span class="mrn">

<i class="fa fa-id-card"></i>

MRN:

PT-<?=str_pad(
$model->patient_id,
5,
"0",
STR_PAD_LEFT
)?>


</span>



</div>


</div>





<div class="info-grid">


<div class="info-box">


<i class="fa fa-calendar"></i>

<div>

<small>Visit Date</small>

<strong>

<?=Yii::$app->formatter
->asDatetime($model->visit_date)?>

</strong>

</div>


</div>




<div class="info-box">


<i class="fa fa-hashtag"></i>

<div>

<small>Visit ID</small>

<strong>
#<?=$model->id?>
</strong>

</div>


</div>



</div>


</div>


</div>







<!-- CLINICAL STATUS -->


<div class="col-xl-7">


<div class="modern-card">


<div class="card-header-modern">

<i class="fa fa-heartbeat"></i>

Clinical Status


</div>




<?= $form->field($model,'status')
->dropDownList(

[
'Waiting'=>'Waiting',
'In Progress'=>'In Progress',
'Completed'=>'Completed',
'Critical'=>'Critical'

],

[
'class'=>'form-select modern-input'
]

)

?>





<div class="status-area">


<label>
Current Status
</label>


<div class="status-pill <?=$statusClass?>">


<i class="fa fa-circle"></i>

<?=$model->status?>


</div>


</div>



</div>


</div>







<!-- DOCTOR CARD -->


<div class="col-12">


<div class="modern-card">


<div class="card-header-modern">


<i class="fa fa-user-md"></i>

Doctor Assignment


</div>





<div class="doctor-profile">


<div class="doctor-icon">

<i class="fa fa-user-md"></i>

</div>



<div>


<h3>

<?= $model->doctor
?
$model->doctor->username
:
"Not Assigned"

?>

</h3>


<p>
Assigned Clinical Doctor
</p>



<span class="active-doctor">

<i class="fa fa-check-circle"></i>

Active Assignment

</span>


</div>


</div>



<?=$form->field($model,'doctor_id')
->hiddenInput()
->label(false)

?>


</div>


</div>



</div>






<div class="footer-actions">


<?=Html::a(

'<i class="fa fa-arrow-left"></i> Cancel',

['index'],

[
'class'=>'btn cancel-btn'
]

)?>


<button class="btn save-btn">

<i class="fa fa-save"></i>

Save Changes

</button>


</div>



<?php ActiveForm::end(); ?>


</div>





<style>


body{

font-family:'Inter','Segoe UI',sans-serif;

background:#f4fbfa;

}





/* HEADER */

.page-header{

background:linear-gradient(
135deg,
#00897b,
#26a69a
);

padding:30px;

border-radius:22px;

color:white;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:0 15px 35px rgba(0,0,0,.15);

}



.page-header h1{

font-size:32px;

font-weight:700;

margin:0;

}



.page-header p{

opacity:.9;

}





.system-badge{

background:white;

color:#00897b;

padding:12px 20px;

border-radius:50px;

font-weight:600;

}



.system-badge i{

color:#22c55e;

}





/* CARD */


.modern-card{

background:white;

border-radius:22px;

padding:28px;

height:100%;

box-shadow:
0 10px 35px rgba(0,0,0,.08);

transition:.3s;

}



.modern-card:hover{

transform:translateY(-5px);

box-shadow:
0 18px 45px rgba(0,0,0,.12);

}



.card-header-modern{

font-size:20px;

font-weight:700;

color:#00796b;

border-bottom:1px solid #e5eeee;

padding-bottom:15px;

margin-bottom:25px;

}



.card-header-modern i{

margin-right:10px;

}






/* PROFILE */


.profile-main{

display:flex;

align-items:center;

gap:20px;

}



.avatar{

width:90px;

height:90px;

border-radius:50%;

background:linear-gradient(
135deg,
#009688,
#4db6ac
);

color:white;

display:flex;

align-items:center;

justify-content:center;

font-size:32px;

font-weight:bold;

}



.profile-main h2{

margin:0;

font-size:24px;

}



.mrn{

background:#e0f2f1;

padding:8px 15px;

border-radius:20px;

color:#00695c;

font-weight:600;

display:inline-block;

margin-top:10px;

}





.info-grid{

display:grid;

grid-template-columns:1fr 1fr;

gap:20px;

margin-top:30px;

}



.info-box{

background:#f8ffff;

padding:18px;

border-radius:15px;

display:flex;

gap:15px;

align-items:center;

}



.info-box i{

font-size:25px;

color:#009688;

}



.info-box small{

display:block;

color:#777;

}





/* STATUS */


.modern-input{

height:55px;

border-radius:15px;

font-size:17px;

}



.status-area{

margin-top:25px;

}



.status-pill{

padding:12px 25px;

border-radius:50px;

display:inline-block;

font-weight:700;

}



.waiting{

background:#fff3cd;
color:#856404;

}



.progress{

background:#cff4fc;
color:#055160;

}



.completed{

background:#d1e7dd;
color:#0f5132;

}



.critical{

background:#f8d7da;
color:#842029;

}





/* DOCTOR */


.doctor-profile{

display:flex;

align-items:center;

gap:25px;

}



.doctor-icon{

width:75px;

height:75px;

background:#e0f2f1;

border-radius:50%;

display:flex;

align-items:center;

justify-content:center;

font-size:30px;

color:#00897b;

}



.doctor-profile h3{

margin:0;

}



.active-doctor{

background:#dcfce7;

color:#15803d;

padding:8px 15px;

border-radius:20px;

font-weight:600;

}





/* BUTTONS */


.footer-actions{

margin-top:30px;

display:flex;

justify-content:flex-end;

gap:15px;

}



.save-btn{

background:#00897b;

color:white;

padding:14px 30px;

border-radius:15px;

font-size:17px;

border:none;

}



.save-btn:hover{

background:#00695c;

}



.cancel-btn{

background:white;

border:1px solid #ddd;

padding:14px 30px;

border-radius:15px;

}




@media(max-width:768px){


.page-header{

display:block;

}



.info-grid{

grid-template-columns:1fr;

}



.profile-main,
.doctor-profile{

flex-direction:column;

align-items:flex-start;

}



.footer-actions{

flex-direction:column;

}



}




</style>