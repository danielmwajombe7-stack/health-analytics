<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Patient;


$this->title = "Create Patient Visit";

?>


<style>


body{

    background:#f6f9fb;

}


/* HEADER */

.page-header{

    background:linear-gradient(
        135deg,
        #00897b,
        #26a69a
    );

    color:white;

    padding:35px;

    border-radius:22px;

    margin-bottom:30px;

    box-shadow:0 15px 35px rgba(0,0,0,.12);

}


.page-header h2{

    font-weight:700;

    font-size:30px;

}


.page-header p{

    opacity:.9;

}



/* FORM CARD */

.visit-form-card{

    background:white;

    border-radius:22px;

    padding:40px;

    box-shadow:0 12px 35px rgba(0,0,0,.08);

}



/* LABEL */

.control-label{

    font-weight:700;

    color:#37474f;

    margin-bottom:8px;

}



/* INPUT */

.form-control{

    height:50px;

    border-radius:14px;

    border:1px solid #dfe7e9;

    padding-left:18px;

}


.form-control:focus{

    border-color:#009688;

    box-shadow:0 0 10px rgba(0,150,136,.15);

}



/* BUTTON */

.btn-save{

    background:#00897b;

    color:white;

    border-radius:14px;

    padding:13px 30px;

    font-weight:700;

    border:none;

    transition:.3s;

}



.btn-save:hover{

    background:#00695c;

    color:white;

    transform:translateY(-3px);

}



.btn-cancel{

    border-radius:14px;

    padding:13px 25px;

    font-weight:600;

}




/* SECTION */

.form-section{

    font-size:18px;

    font-weight:700;

    color:#00695c;

    margin-bottom:20px;

    border-bottom:2px solid #e0f2f1;

    padding-bottom:10px;

}



</style>






<div class="container-fluid">





<!-- HEADER -->

<div class="page-header">


<h2>

<i class="fa fa-calendar-plus-o"></i>

Create Patient Visit

</h2>


<p>

Register new patient consultation and clinical workflow record.

</p>


</div>







<div class="visit-form-card">



<div class="form-section">

<i class="fa fa-user-md"></i>

Visit Information

</div>





<?php $form = ActiveForm::begin(); ?>







<!-- PATIENT -->

<?= $form->field($model,'patient_id')->dropDownList(

    ArrayHelper::map(

        Patient::find()->all(),

        'id',

        'fullName'

    ),

    [

        'prompt'=>'Select Patient'

    ]

) ?>








<!-- DATE -->

<?= $form->field($model,'visit_date')->textInput(

[

'type'=>'datetime-local'

]

) ?>








<!-- STATUS -->

<?= $form->field($model,'status')->dropDownList(

[

'Waiting'=>'Waiting',

'In Progress'=>'In Progress',

'Completed'=>'Completed',

'Critical'=>'Critical',

'Cancelled'=>'Cancelled'

],

[

'prompt'=>'Select Visit Status'

]

) ?>








<!-- NOTES -->

<?= $form->field($model,'notes')->textarea(

[

'rows'=>4,

'placeholder'=>'Enter clinical notes, symptoms or observations...'

]

) ?>







<div class="mt-4">



<?= Html::submitButton(

'<i class="fa fa-save"></i> Save Visit',

[

'class'=>'btn btn-save'

]

) ?>





<?= Html::a(

'<i class="fa fa-arrow-left"></i> Cancel',

['index'],

[

'class'=>'btn btn-secondary btn-cancel ms-2'

]

) ?>



</div>





<?php ActiveForm::end(); ?>



</div>



</div>