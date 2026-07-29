<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Update Laboratory Request";


?>

<style>


.lab-update-container{

    padding:40px;

}



.lab-card{

    background:#ffffff;

    border-radius:20px;

    box-shadow:0 15px 40px rgba(0,0,0,.12);

    overflow:hidden;

    transition:.3s ease;

}



.lab-card:hover{

    transform:translateY(-5px);

    box-shadow:0 20px 50px rgba(0,0,0,.18);

}



.lab-header{

    background:linear-gradient(
        135deg,
        #009688,
        #00695c
    );

    color:white;

    padding:25px 35px;

}



.lab-header h3{

    margin:0;

    font-weight:700;

}



.lab-body{

    padding:40px;

}



.form-control{

    height:50px;

    border-radius:12px;

    border:1px solid #d8e8e5;

    transition:.3s;

}



.form-control:focus{

    border-color:#009688;

    box-shadow:
    0 0 0 4px rgba(0,150,136,.15);

}



.control-label{

    font-weight:600;

    color:#37474f;

    margin-bottom:8px;

}



.btn-update{


    background:linear-gradient(
        135deg,
        #009688,
        #00796b
    );

    border:none;

    color:white;

    padding:13px 30px;

    border-radius:30px;

    font-weight:600;

    transition:.3s;

}



.btn-update:hover{


    transform:scale(1.05);

    box-shadow:
    0 8px 20px rgba(0,150,136,.4);


    color:white;

}



.btn-back{


    padding:13px 30px;

    border-radius:30px;

    font-weight:600;

    margin-left:10px;


}



.section-title{


    color:#00695c;

    font-size:18px;

    font-weight:700;

    margin-bottom:25px;

}



.icon-box{


    width:55px;

    height:55px;

    background:#e0f2f1;

    color:#00897b;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:25px;

    margin-right:15px;


}


.title-area{

    display:flex;

    align-items:center;

}


</style>





<div class="lab-update-container">


<div class="lab-card">



<div class="lab-header">


<div class="title-area">


<div class="icon-box">

🧪

</div>


<div>

<h3>

Update Laboratory Request

</h3>


<small>

Modify patient investigation details

</small>


</div>


</div>


</div>





<div class="lab-body">


<div class="section-title">

Laboratory Information

</div>





<?php $form = ActiveForm::begin(); ?>





<div class="row">


<div class="col-md-6">


<?= $form->field($model,'patient_id')

->textInput([

'readonly'=>true,

'class'=>'form-control'

])

->label('👤 Patient ID')

?>


</div>





<div class="col-md-6">


<?= $form->field($model,'test_name')

->textInput([

'class'=>'form-control',

'placeholder'=>'Enter laboratory test'

])

->label('🧪 Laboratory Test')

?>


</div>



</div>









<div class="row">



<div class="col-md-6">


<?= $form->field($model,'status')

->dropDownList([


'Pending'=>'⏳ Pending',

'Processing'=>'⚙ Processing',

'Completed'=>'✔ Completed'


],

[

'class'=>'form-control'

])

->label('📌 Request Status')

?>



</div>







<div class="col-md-6">



<?= $form->field($model,'priority')

->dropDownList([


'Normal'=>'🟢 Normal',

'Urgent'=>'🔴 Urgent'


],

[

'class'=>'form-control'

])

->label('🚨 Priority Level')

?>



</div>



</div>









<div class="mt-4">


<?= Html::submitButton(

'💾 Save Changes',

[

'class'=>'btn btn-update'

]

) ?>




<?= Html::a(

'↩ Cancel',

['index'],

[

'class'=>'btn btn-outline-secondary btn-back'

]

) ?>



</div>





<?php ActiveForm::end(); ?>



</div>



</div>



</div>