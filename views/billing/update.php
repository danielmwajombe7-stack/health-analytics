<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Update Billing";

?>


<style>


.billing-wrapper{

    padding:35px;

    background:#f4f8f7;

    min-height:100vh;

    font-family:'Inter','Segoe UI',sans-serif;

}



/* Header */


.billing-header{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:30px;

}


.billing-header h1{

    font-size:32px;

    font-weight:800;

    color:#124559;

    margin:0;

}



.billing-header p{

    margin-top:8px;

    color:#64748b;

}



/* Card */


.billing-card{

    background:white;

    border-radius:25px;

    padding:35px;

    max-width:950px;

    margin:auto;


    box-shadow:

    0 15px 40px rgba(0,0,0,.08);

}



/* Banner */


.patient-banner{


background:

linear-gradient(
135deg,
#0f766e,
#14b8a6
);


padding:28px;

border-radius:20px;

color:white;

margin-bottom:35px;


}



.patient-banner h2{

margin:0;

font-size:26px;

font-weight:800;

}



.patient-banner span{

opacity:.9;

}



/* Form */


.form-group{

margin-bottom:25px;

}



.control-label{

font-weight:700;

color:#334155;

font-size:14px;

}



.form-control{

height:52px;

border-radius:14px;

border:1px solid #cbd5e1;

padding:12px 18px;

font-size:15px;

transition:.3s;

}



.form-control:focus{

border-color:#14b8a6;

box-shadow:

0 0 0 4px rgba(20,184,166,.15);

}



/* Input icons area */


.field-card{


background:#f8fafc;

padding:20px;

border-radius:18px;

border-left:5px solid #14b8a6;

}



/* Buttons */


.action-area{

display:flex;

gap:15px;

margin-top:35px;

}




.btn-save{


background:#0f766e;

color:white;

padding:14px 35px;

border-radius:14px;

border:none;

font-weight:700;

font-size:16px;

transition:.3s;

}



.btn-save:hover{


background:#115e59;

transform:translateY(-2px);

color:white;

}



.btn-back{


background:#64748b;

color:white;

padding:14px 30px;

border-radius:14px;

text-decoration:none;

font-weight:700;

}



.btn-back:hover{


background:#475569;

color:white;

}




/* Responsive */


@media(max-width:700px){


.billing-wrapper{

padding:15px;

}


.billing-header{

flex-direction:column;

align-items:flex-start;

gap:15px;

}



.billing-card{

padding:20px;

}


}



</style>






<div class="billing-wrapper">





<div class="billing-header">


<div>


<h1>

<i class="bi bi-pencil-square"></i>

Update Billing

</h1>


<p>
Modify hospital financial transaction information
</p>


</div>




<?= Html::a(

'<i class="bi bi-arrow-left"></i> Back',

['index'],

[
'class'=>'btn-back'
]

) ?>


</div>








<div class="billing-card">






<div class="patient-banner">


<h2>

<i class="bi bi-receipt-cutoff"></i>

Billing Update Form

</h2>


<span>

Transaction ID #<?= $model->id ?>

</span>


</div>










<?php $form = ActiveForm::begin(); ?>





<div class="field-card">


<?= $form->field($model,'patient_id')

->textInput([

'class'=>'form-control',

'placeholder'=>'Enter Patient ID'

])

?>

</div>








<div class="field-card">


<?= $form->field($model,'amount')

->textInput([

'class'=>'form-control',

'placeholder'=>'Enter Amount'

])

?>

</div>








<div class="field-card">


<?= $form->field($model,'status')

->dropDownList(

[

'Pending'=>'Pending',

'Paid'=>'Paid',

'Cancelled'=>'Cancelled'

],

[

'class'=>'form-control'

]

)

?>

</div>








<div class="action-area">



<button class="btn-save">


<i class="bi bi-check-circle"></i>

Save Changes


</button>






<?= Html::a(

'<i class="bi bi-x-circle"></i> Cancel',

['index'],

[

'class'=>'btn-back'

]

) ?>




</div>







<?php ActiveForm::end(); ?>








</div>




</div>