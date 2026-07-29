<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Smart Laboratory Request";


?>


<style>

.lab-page{

    max-width:1100px;
    margin:35px auto;
    padding:20px;

}


.lab-header{

    background:linear-gradient(
        135deg,
        #0f766e,
        #14b8a6
    );

    color:white;
    padding:35px;
    border-radius:25px;
    margin-bottom:25px;

    box-shadow:
    0 15px 35px rgba(0,0,0,.12);

}


.lab-header h2{

    margin:0;
    font-size:32px;
    font-weight:700;

}


.lab-header p{

    margin-top:10px;
    opacity:.9;

}



.form-card{

    background:white;
    border-radius:25px;
    overflow:hidden;

    box-shadow:
    0 15px 40px rgba(0,0,0,.08);

}



.card-title{

    padding:25px 35px;

    background:#f1fffd;

    color:#00695c;

    font-size:22px;

    font-weight:bold;

}



.card-body{

    padding:35px;

}





.badges{

    display:flex;
    gap:15px;
    flex-wrap:wrap;
    margin-bottom:30px;

}



.badge-box{

    padding:10px 20px;
    border-radius:30px;
    font-weight:bold;

}



.pending{

    background:#fff8e1;
    color:#ef6c00;

}


.normal{

    background:#e8f5e9;
    color:#2e7d32;

}



.ai{

    background:#e3f2fd;
    color:#1565c0;

}





.summary-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));

    gap:20px;

    margin-bottom:35px;

}



.summary-box{

    background:#fafafa;

    padding:20px;

    border-radius:18px;

    border-left:5px solid #14b8a6;

}



.summary-box small{

    color:#78909c;

    display:block;

    margin-bottom:8px;

}


.summary-box strong{

    font-size:17px;

}





.section-title{

    color:#00695c;

    font-size:20px;

    font-weight:bold;

    margin-bottom:20px;

}



.form-control,
.form-select{

    min-height:52px;

    border-radius:15px!important;

}



textarea.form-control{

    min-height:120px;

}





.buttons{

    display:flex;

    justify-content:flex-end;

    gap:15px;

    margin-top:30px;

}



.save-btn{

    background:#0f766e;

    color:white;

    border:none;

    padding:14px 30px;

    border-radius:15px;

    font-weight:bold;

}



.cancel-btn{

    background:#eceff1;

    color:#37474f;

    padding:14px 30px;

    border-radius:15px;

    font-weight:bold;

}




</style>







<div class="lab-page">





<div class="lab-header">


<h2>

🧪 Smart Laboratory Request

</h2>


<p>

Create professional laboratory investigation request

for the patient.

</p>


</div>








<div class="form-card">





<div class="card-title">

🔬 Laboratory Investigation Form

</div>







<div class="card-body">






<div class="badges">


<div class="badge-box pending">

⏳ Status : Pending

</div>




<div class="badge-box normal">

🎯 Priority : Normal

</div>




<div class="badge-box ai">

🧠 AI Recommendation Ready

</div>



</div>









<div class="summary-grid">



<div class="summary-box">

<small>
Patient ID
</small>


<strong>

#<?= Html::encode($model->patient_id) ?>

</strong>


</div>







<div class="summary-box">

<small>
Requested By
</small>


<strong>

<?= Yii::$app->user->identity->username ?? 'Doctor' ?>

</strong>


</div>







<div class="summary-box">

<small>
Request Date
</small>


<strong>

<?= date('d M Y H:i') ?>

</strong>


</div>







<div class="summary-box">

<small>
Department
</small>


<strong>

General Medicine

</strong>


</div>




</div>










<?php $form = ActiveForm::begin(); ?>






<?= $form->field($model,'patient_id')

->hiddenInput()

->label(false)

?>










<div class="section-title">

🔬 Laboratory Test Details

</div>








<?= $form->field($model,'test_name')

->dropDownList(

[


'Complete Blood Count'=>
'🩸 Complete Blood Count',


'Malaria Test'=>
'🦟 Malaria Test',


'Urinalysis'=>
'🧪 Urinalysis',


'Blood Sugar'=>
'🍬 Blood Sugar',


'Liver Function Test'=>
'🫀 Liver Function Test',


'Kidney Function Test'=>
'💧 Kidney Function Test',


'COVID-19'=>
'🦠 COVID-19 Test',


'X-Ray'=>
'🩻 X-Ray'


],

[

'prompt'=>'Select Laboratory Test'

]

)

?>











<?= $form->field($model,'priority')

->dropDownList(

[

'Normal'=>'🟢 Normal',

'Medium'=>'🟡 Medium',

'High'=>'🔴 High'

]

)

?>











<?= $form->field($model,'status')

->dropDownList(

[

'Pending'=>'⏳ Pending',

'Processing'=>'🔬 Processing',

'Completed'=>'✅ Completed'

]

)

?>









<?= $form->field($model,'result')

->textarea(

[

'rows'=>5,

'placeholder'=>

'Clinical notes or laboratory information...'

]

)

?>









<div class="buttons">





<?= Html::a(

'Cancel',

Yii::$app->request->referrer,

[

'class'=>'btn cancel-btn'

]

) ?>








<?= Html::submitButton(

'🧪 Create Laboratory Request',

[

'class'=>'btn save-btn'

]

) ?>






</div>







<?php ActiveForm::end(); ?>






</div>


</div>




</div>