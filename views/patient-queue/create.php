<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = "Patient Queue Registration";



/*
|--------------------------------------------------------------------------
| PATIENT LIST
|--------------------------------------------------------------------------
*/


$patients = ArrayHelper::map(

    \app\models\Patient::find()
    ->orderBy([
        'id'=>SORT_DESC
    ])
    ->all(),

    'id',

    function($model){

        return

        $model->first_name.' '.

        ($model->middle_name ?? '').' '.

        $model->last_name.

        ' - '.

        ($model->patient_number ?? '');

    }

);




/*
|--------------------------------------------------------------------------
| DOCTOR LIST
|--------------------------------------------------------------------------
*/


$doctors = ArrayHelper::map(

    \app\models\User::find()
    ->all(),

    'id',

    function($model){

        return

        $model->full_name

        ??

        $model->username;

    }

);



?>



<style>


.queue-create-page{

background:
linear-gradient(
135deg,
#f0fdfa,
#f8fafc
);

min-height:100vh;

padding:35px;

}




.page-header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

}



.page-header h1{

font-size:32px;

font-weight:800;

color:#00695c;

}



.page-header p{

color:#607d8b;

}




.back-btn{


background:white;

padding:14px 25px;

border-radius:18px;

text-decoration:none;

color:#00695c;

font-weight:700;

box-shadow:
0 8px 20px rgba(0,0,0,.08);

transition:.3s;


}


.back-btn:hover{


transform:translateY(-3px);

background:#00695c;

color:white;

}





.form-container{


background:white;

padding:40px;

border-radius:35px;


box-shadow:

0 20px 50px rgba(0,0,0,.08);


}




.section-title{


font-size:20px;

font-weight:800;

color:#00695c;


border-bottom:

2px solid #e0f2f1;


padding-bottom:12px;

margin:

30px 0 20px;


}




.grid{


display:grid;

grid-template-columns:

repeat(2,1fr);


gap:25px;


}





.control-label{


font-weight:700;

color:#37474f;


}




.form-control{


border-radius:16px!important;

padding:14px!important;

border:

1px solid #cfd8dc!important;


font-size:15px;


}





.form-control:focus{


border-color:#00897b!important;


box-shadow:

0 0 0 3px rgba(0,137,123,.15)!important;


}





.submit-btn{


margin-top:30px;


background:

linear-gradient(
135deg,
#00695c,
#26a69a
);


color:white;


padding:16px 45px;


border:none;


border-radius:20px;


font-size:16px;


font-weight:800;


cursor:pointer;


box-shadow:

0 12px 25px rgba(0,105,92,.3);


transition:.3s;


}




.submit-btn:hover{


transform:translateY(-4px);


}





@media(max-width:900px){


.grid{

grid-template-columns:1fr;

}



.page-header{

flex-direction:column;

align-items:flex-start;

gap:20px;

}



}


</style>






<div class="queue-create-page">






<div class="page-header">


<div>


<h1>

🎫 Patient Queue Registration

</h1>


<p>

Register patient into OPD consultation workflow

</p>


</div>





<?= Html::a(

'← Back Queue',

['index'],

[

'class'=>'back-btn'

]

) ?>



</div>










<div class="form-container">



<?php $form = ActiveForm::begin(); ?>







<div class="section-title">

👤 Patient Information

</div>






<?=

$form->field($model,'patient_id')

->label('Patient Name')

->dropDownList(

$patients,

[

'prompt'=>'🔍 Select Patient Name',

'class'=>'form-control'

]

)

?>












<div class="section-title">

🩺 Doctor Assignment

</div>







<div class="grid">





<div>


<?=

$form->field($model,'doctor_id')

->label('Doctor Name')

->dropDownList(

$doctors,

[

'prompt'=>'Select Doctor',

'class'=>'form-control'

]

)

?>


</div>







<div>


<?=

$form->field($model,'department')

->dropDownList(

[


'General OPD'=>
'General OPD',


'Emergency'=>
'Emergency',


'Laboratory'=>
'Laboratory',


'Pharmacy'=>
'Pharmacy'


],

[

'prompt'=>'Select Department',

'class'=>'form-control'

]

)

?>


</div>






</div>









<div class="section-title">

🎫 Queue Information

</div>









<div class="grid">






<div>


<?=

$form->field($model,'priority')

->dropDownList(

[


'Normal'=>
'🟢 Normal',


'Urgent'=>
'🟡 Urgent',


'Emergency'=>
'🔴 Emergency'


],

[

'value'=>'Normal',

'class'=>'form-control'

]

)

?>


</div>









<div>


<?=

$form->field($model,'status')

->dropDownList(

[


'Waiting'=>
'⏳ Waiting',


'Called'=>
'📢 Called',


'Consulting'=>
'🩺 Consulting',


'Completed'=>
'✅ Completed'


],

[

'value'=>'Waiting',

'class'=>'form-control'

]

)

?>


</div>





</div>









<div class="section-title">

📝 Notes

</div>







<?=

$form->field($model,'notes')

->textarea([


'rows'=>5,


'placeholder'=>

'Patient complaint or additional notes...'


])

?>











<?= Html::submitButton(

'🎫 Add Patient To Queue',

[

'class'=>'submit-btn'

]

) ?>








<?php ActiveForm::end(); ?>




</div>




</div>