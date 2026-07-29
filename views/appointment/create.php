<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Patient;
use app\models\User;
use app\models\Department;


$this->title = "Create Appointment";

?>


<style>


.appointment-wrapper{

padding:30px;

background:#f8fafc;

min-height:100vh;

}



/* HEADER */

.appointment-header{

background:

linear-gradient(
135deg,
#0f766e,
#115e59
);

border-radius:30px;

padding:35px;

color:white;

box-shadow:
0 20px 50px rgba(0,0,0,.15);

margin-bottom:30px;

}


.appointment-header h1{

font-size:34px;

font-weight:900;

margin:0;

}


.appointment-header p{

color:#ccfbf1;

margin-top:10px;

}





/* CARD */


.appointment-card{

background:white;

border-radius:30px;

padding:35px;

box-shadow:

0 15px 40px rgba(0,0,0,.08);

}





.section-title{

font-weight:900;

color:#0f766e;

border-bottom:2px solid #ccfbf1;

padding-bottom:10px;

margin-bottom:25px;

}





.form-control,
.form-select{

border-radius:15px;

padding:14px;

border:1px solid #cbd5e1;

}



.form-control:focus,
.form-select:focus{

border-color:#0f766e;

box-shadow:0 0 0 .2rem rgba(15,118,110,.15);

}






.field-icon{

font-size:20px;

color:#0f766e;

}





.save-btn{

background:#0f766e;

border:none;

color:white;

font-weight:900;

padding:15px 35px;

border-radius:18px;

}




.save-btn:hover{

background:#115e59;

}




.cancel-btn{

padding:15px 30px;

border-radius:18px;

font-weight:800;

}





.info-box{

background:#ecfdf5;

border-radius:20px;

padding:20px;

margin-top:20px;

}



.info-box h5{

font-weight:900;

color:#065f46;

}





</style>







<div class="appointment-wrapper">





<div class="appointment-header">


<h1>
📅 New Patient Appointment
</h1>


<p>
Create and manage hospital consultation schedules.
</p>


</div>









<div class="appointment-card">





<?php $form = ActiveForm::begin(); ?>






<h4 class="section-title">
👤 Patient Information
</h4>





<?= $form->field($model,'patient_id')
->label('Patient Name')
->dropDownList(

ArrayHelper::map(

Patient::find()
->orderBy(['first_name'=>SORT_ASC])
->all(),

'id',

function($patient){

return $patient->fullName .
" (" .
$patient->patient_number .
")";

}

),

[

'class'=>'form-select',

'prompt'=>'🔍 Search patient...'

]

)

?>








<h4 class="section-title mt-5">
🏥 Clinical Appointment Details
</h4>






<div class="row">


<div class="col-md-6">


<?= $form->field($model,'department_id')

->label('Department')

->dropDownList(

ArrayHelper::map(

Department::find()
->where(['status'=>1])
->all(),

'id',

'department_name'

),

[

'prompt'=>'Select department'

]

)

?>

</div>





<div class="col-md-6">


<?= $form->field($model,'doctor_id')

->label('Consulting Doctor')

->dropDownList(

ArrayHelper::map(

User::find()
->all(),

'id',

'username'

),

[

'prompt'=>'Select doctor'

]

)

?>


</div>



</div>









<h4 class="section-title mt-5">
⏰ Appointment Schedule
</h4>





<div class="row">


<div class="col-md-6">


<?= $form->field($model,'appointment_date')

->label('Appointment Date')

->input('date')

?>


</div>




<div class="col-md-6">


<?= $form->field($model,'appointment_time')

->label('Appointment Time')

->input('time')

?>


</div>


</div>










<h4 class="section-title mt-5">
📝 Consultation Reason
</h4>






<?= $form->field($model,'reason')

->textarea([

'rows'=>4,

'placeholder'=>
'Describe patient complaint or reason for visit...'

])

?>









<h4 class="section-title mt-5">
📌 Appointment Status
</h4>






<?= $form->field($model,'status')

->dropDownList(

$model::statusList(),

[

'class'=>'form-select'

]

)

?>








<div class="info-box">


<h5>
💡 Appointment Workflow
</h5>


<p class="mb-0">

Pending → Confirmed → Consultation → Completed

</p>


</div>










<div class="mt-4">


<?= Html::submitButton(

'💾 Create Appointment',

[

'class'=>'save-btn'

]

)

?>




<?= Html::a(

'← Cancel',

['index'],

[

'class'=>'btn btn-secondary cancel-btn ms-2'

]

)

?>



</div>






<?php ActiveForm::end(); ?>



</div>



</div>