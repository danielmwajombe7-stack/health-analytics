<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Register Patient";

?>


<div class="container-fluid">


<div class="d-flex justify-content-between align-items-center mb-4">


<div>

<h2>
👤 Register New Patient
</h2>

<p class="text-muted">
Reception patient registration
</p>

</div>



<?= Html::a(
    '← Back Dashboard',
    [
        'index'
    ],
    [
        'class'=>'btn btn-secondary'
    ]
) ?>


</div>







<div class="card shadow border-0">


<div class="card-header bg-success text-white">

<h4>
Patient Information
</h4>


</div>





<div class="card-body">



<?php $form = ActiveForm::begin(); ?>



<div class="row">


<div class="col-md-4">

<?= $form->field($model,'first_name')
    ->textInput([
        'placeholder'=>'Enter first name'
    ])
?>

</div>



<div class="col-md-4">

<?= $form->field($model,'middle_name')
    ->textInput([
        'placeholder'=>'Enter middle name'
    ])
?>

</div>




<div class="col-md-4">

<?= $form->field($model,'last_name')
    ->textInput([
        'placeholder'=>'Enter last name'
    ])
?>

</div>


</div>







<div class="row">



<div class="col-md-4">


<?= $form->field($model,'gender')
->dropDownList(
    [
        'Male'=>'Male',
        'Female'=>'Female'
    ],
    [
        'prompt'=>'Select Gender'
    ]
)
?>


</div>







<div class="col-md-4">


<?= $form->field($model,'phone')
->textInput([
    'placeholder'=>'Phone number'
])
?>


</div>







<div class="col-md-4">


<?= $form->field($model,'blood_group')
->dropDownList(
    [
        'A+'=>'A+',
        'A-'=>'A-',
        'B+'=>'B+',
        'B-'=>'B-',
        'AB+'=>'AB+',
        'AB-'=>'AB-',
        'O+'=>'O+',
        'O-'=>'O-'
    ],
    [
        'prompt'=>'Blood Group'
    ]
)
?>


</div>




</div>









<div class="row">



<div class="col-md-6">


<?= $form->field($model,'date_of_birth')
->input('date')
?>


</div>







<div class="col-md-6">


<?= $form->field($model,'address')
->textarea([
    'rows'=>3,
    'placeholder'=>'Patient address'
])
?>


</div>




</div>








<div class="mt-4">


<?= Html::submitButton(
    '💾 Register Patient & Generate Queue',
    [
        'class'=>'btn btn-success btn-lg'
    ]
) ?>


</div>





<?php ActiveForm::end(); ?>



</div>


</div>


</div>