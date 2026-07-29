<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title="Register New Patient";

?>


<style>


.patient-wrapper{

    padding:35px;

}



.patient-box{

    background:#fff;

    border-radius:25px;

    box-shadow:0 15px 40px rgba(0,0,0,.08);

    overflow:hidden;

}




.patient-top{

    background:linear-gradient(
        120deg,
        #00897b,
        #43a047
    );

    padding:35px;

    color:white;

}



.patient-avatar{

    width:80px;

    height:80px;

    background:white;

    color:#00897b;

    border-radius:50%;

    display:flex;

    justify-content:center;

    align-items:center;

    font-size:35px;

}




.patient-top h2{

    font-weight:700;

}



.patient-body{

    padding:40px;

}




.section-card{

    background:#f8fafb;

    border-radius:18px;

    padding:25px;

    margin-bottom:25px;

}



.section-title{

    font-size:17px;

    font-weight:700;

    color:#00897b;

    margin-bottom:20px;

}




.form-control{

    height:50px;

    border-radius:14px;

    border:1px solid #dfe6e9;

    padding-left:15px;

}



textarea.form-control{

    height:auto;

}




.form-control:focus{

    border-color:#00897b;

    box-shadow:0 0 0 .2rem rgba(0,137,123,.15);

}





label{

    font-weight:600;

    color:#455a64;

}





.btn-save{

    background:#00897b;

    border:none;

    color:white;

    padding:14px 35px;

    border-radius:15px;

    font-weight:600;

}



.btn-save:hover{

    background:#00695c;

    color:white;

}




.btn-cancel{

    padding:14px 30px;

    border-radius:15px;

}




</style>





<div class="container-fluid patient-wrapper">


<div class="patient-box">





<div class="patient-top">


<div class="d-flex align-items-center gap-4">


<div class="patient-avatar">

<i class="fa fa-user-plus"></i>

</div>



<div>

<h2>

Register New Patient

</h2>


<p class="mb-0">

Create and manage patient medical profile

</p>


</div>


</div>


</div>






<div class="patient-body">



<?php $form=ActiveForm::begin([
    
    'options'=>[
        'class'=>'row'
    ]

]); ?>





<!-- PERSONAL INFORMATION -->


<div class="section-card">


<h5 class="section-title">

<i class="fa fa-id-card"></i>

Personal Information

</h5>




<div class="row g-4">



<div class="col-md-4">

<?= $form->field($model,'first_name')

->textInput([

'class'=>'form-control',

'placeholder'=>'Enter first name'

])

?>

</div>





<div class="col-md-4">


<?= $form->field($model,'middle_name')

->textInput([

'class'=>'form-control',

'placeholder'=>'Enter middle name'

])

?>


</div>







<div class="col-md-4">


<?= $form->field($model,'last_name')

->textInput([

'class'=>'form-control',

'placeholder'=>'Enter last name'

])

?>


</div>







<div class="col-md-4">


<?= $form->field($model,'gender')

->dropDownList(

[

'Male'=>'Male',

'Female'=>'Female'

],

[

'class'=>'form-control',

'prompt'=>'Select Gender'

]

)

?>


</div>








<div class="col-md-4">


<?= $form->field($model,'dob')

->input('date',

[

'class'=>'form-control'

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

'class'=>'form-control',

'prompt'=>'Select Blood Group'

]

)

?>


</div>



</div>


</div>









<!-- CONTACT INFORMATION -->


<div class="section-card">


<h5 class="section-title">

<i class="fa fa-phone"></i>

Contact Information

</h5>




<div class="row g-4">



<div class="col-md-6">


<?= $form->field($model,'phone')

->textInput([

'class'=>'form-control',

'placeholder'=>'Phone number'

])

?>


</div>






<div class="col-md-6">


<?= $form->field($model,'email')

->input('email',

[

'class'=>'form-control',

'placeholder'=>'Email address'

])

?>


</div>






<div class="col-md-12">


<?= $form->field($model,'address')

->textarea([

'class'=>'form-control',

'rows'=>4,

'placeholder'=>'Patient residential address'

])

?>


</div>



</div>


</div>









<!-- BUTTONS -->


<div class="text-end">


<?= Html::submitButton(

'<i class="fa fa-save"></i> Register Patient',

[

'class'=>'btn btn-save'

]

)

?>




<?= Html::a(

'<i class="fa fa-arrow-left"></i> Cancel',

['index'],

[

'class'=>'btn btn-secondary btn-cancel ms-3'

]

)

?>


</div>






<?php ActiveForm::end(); ?>


</div>


</div>


</div>