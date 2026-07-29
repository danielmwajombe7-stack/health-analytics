<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Add Prescription";

?>


<style>


.prescription-container{

background:#f4f9f8;
padding:35px;
min-height:100vh;

}



.prescription-header{

background:white;
border-radius:25px;
padding:25px 30px;
display:flex;
align-items:center;
gap:20px;
box-shadow:0 10px 30px rgba(0,0,0,.06);
margin-bottom:25px;

}



.header-icon{

width:70px;
height:70px;
border-radius:20px;
background:linear-gradient(
135deg,
#00897b,
#004d40
);

display:flex;
align-items:center;
justify-content:center;
color:white;
font-size:35px;

}



.prescription-header h2{

margin:0;
font-weight:800;
color:#00695c;

}


.prescription-header p{

color:#78909c;

}




.form-card{

background:white;
border-radius:25px;
padding:35px;
box-shadow:0 10px 30px rgba(0,0,0,.06);

}




.section-title{

font-size:20px;
font-weight:800;
color:#00695c;
margin-bottom:20px;

}



.section-title i{

background:#e0f2f1;
padding:12px;
border-radius:15px;
margin-right:10px;

}




.form-control,
.form-select{

height:52px;
border-radius:15px;

}



textarea.form-control{

height:120px;

}



.control-label{

font-weight:700;

}



.patient-box{

background:#e0f2f1;
padding:20px;
border-radius:20px;
margin-bottom:25px;

}



.btn-save{

height:55px;
border-radius:18px;
background:linear-gradient(
135deg,
#00897b,
#00695c
);

border:none;
color:white;
font-weight:800;
font-size:17px;

}



</style>






<div class="prescription-container">





<div class="prescription-header">


<div class="header-icon">

<i class="bi bi-capsule-pill"></i>

</div>


<div>

<h2>
Create Prescription
</h2>


<p>
Doctor medication order for pharmacy dispensing
</p>


</div>


</div>









<div class="form-card">





<div class="section-title">

<i class="bi bi-person-circle"></i>

Patient Information

</div>





<div class="patient-box">


<div class="row">


<div class="col-md-6">


<?= $form->field($model,'patient_id')

->textInput([

'class'=>'form-control',

'placeholder'=>'Patient ID'

])

->label('Patient') ?>


</div>




<div class="col-md-6">


<?= $form->field($model,'visit_id')

->textInput([

'class'=>'form-control',

'placeholder'=>'Visit ID'

])

->label('Patient Visit') ?>


</div>



</div>


</div>










<div class="section-title">

<i class="bi bi-capsule"></i>

Medication Information

</div>





<?php $form=ActiveForm::begin(); ?>






<div class="row">



<div class="col-md-6">


<?= $form->field($model,'drug_name')

->textInput([

'class'=>'form-control',

'placeholder'=>'Example: Amoxicillin 500mg'

])

->label('Medicine Name')

?>


</div>






<div class="col-md-6">


<?= $form->field($model,'medicine_id')

->textInput([

'class'=>'form-control',

'placeholder'=>'Medicine Reference ID'

])

->label('Medicine ID')

?>


</div>




</div>









<div class="row">



<div class="col-md-6">


<?= $form->field($model,'dosage')

->textInput([

'class'=>'form-control',

'placeholder'=>'Example: 500mg'

])


?>


</div>







<div class="col-md-6">


<?= $form->field($model,'frequency')

->dropDownList(

[

'Once daily'=>'Once daily',

'Twice daily'=>'Twice daily',

'Three times daily'=>'Three times daily',

'When needed'=>'When needed'

],

[

'class'=>'form-select',

'prompt'=>'Select frequency'

]

)


?>


</div>


</div>










<div class="row">


<div class="col-md-6">


<?= $form->field($model,'duration')

->textInput([

'class'=>'form-control',

'placeholder'=>'Example: 5 days'

])


?>


</div>






<div class="col-md-6">


<?= $form->field($model,'status')

->dropDownList(

[

'Pending'=>'⏳ Pending Pharmacy Review',

'Dispensed'=>'✅ Dispensed',

'Cancelled'=>'❌ Cancelled'

],

[

'class'=>'form-select'

]

)


?>


</div>



</div>









<div class="section-title mt-4">


<i class="bi bi-chat-left-text"></i>

Doctor Instructions


</div>






<?= $form->field($model,'instructions')

->textarea([

'class'=>'form-control',

'placeholder'=>
'Example: Take after meals, complete full dose...'

])

?>







<div class="row mt-4">


<div class="col-md-6">


<?= Html::a(

'Cancel',

['index'],

[

'class'=>'btn btn-outline-secondary w-100',

'style'=>'height:55px;border-radius:18px'

]

) ?>


</div>





<div class="col-md-6">


<?= Html::submitButton(

'<i class="bi bi-save"></i> Save Prescription',

[

'class'=>'btn-save w-100'

]

)

?>


</div>



</div>





<?php ActiveForm::end(); ?>



</div>




</div>