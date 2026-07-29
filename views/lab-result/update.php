<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = "Update Laboratory Result";


?>


<style>


.update-page{

    padding:25px;

    background:#f5f8fa;

    min-height:100vh;

}



.update-card{

    background:white;

    padding:35px;

    border-radius:28px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

}



.update-header{

    background:
    linear-gradient(
        135deg,
        #00695c,
        #14b8a6
    );

    padding:30px;

    border-radius:22px;

    color:white;

    margin-bottom:30px;

}



.update-header h2{

    font-weight:900;

    margin-bottom:10px;

}



.update-header p{

    opacity:.9;

}





.form-control{

    border-radius:15px;

    padding:13px;

    border:1px solid #d1d5db;

}



.form-label{

    font-weight:800;

    color:#334155;

}



.btn-custom{

    border-radius:15px;

    padding:12px 25px;

    font-weight:900;

}



.info-box{

    background:#f8fafc;

    padding:20px;

    border-radius:18px;

    margin-bottom:25px;

}



.info-title{

    color:#64748b;

    font-weight:800;

}



.info-value{

    color:#0f172a;

    font-weight:900;

    font-size:18px;

}



</style>







<div class="update-page">



<div class="update-card">






<div class="update-header">


<h2>

🧪 Update Laboratory Result

</h2>


<p>

Edit laboratory investigation report and save changes.

</p>


</div>









<div class="info-box">


<div class="info-title">

Laboratory Test

</div>


<div class="info-value">


<?= Html::encode(

$model->testName

) ?>


</div>


</div>








<?php $form = ActiveForm::begin(); ?>









<?= $form->field($model,'result')

->textarea(

[

'rows'=>6,

'class'=>'form-control',

'placeholder'=>'Enter laboratory result'

]

)

?>











<?= $form->field($model,'findings')

->textarea(

[

'rows'=>5,

'class'=>'form-control',

'placeholder'=>'Enter clinical findings'

]

)

?>









<?= $form->field($model,'normal_range')

->textInput(

[

'class'=>'form-control',

'placeholder'=>'Example: 70-100 mg/dL'

]

)

?>









<?= $form->field($model,'status')

->dropDownList(

[

'Pending'=>'Pending',

'Processing'=>'Processing',

'Completed'=>'Completed'

],

[

'class'=>'form-control',

'prompt'=>'Select Status'

]

)

?>









<?= $form->field($model,'attachment')

->textInput(

[

'class'=>'form-control',

'placeholder'=>'Attachment filename'

]

)

?>









<br>





<div>


<?= Html::submitButton(

'💾 Save Laboratory Result',

[

'class'=>'btn btn-success btn-custom'

]

) ?>






<?= Html::a(

'⬅ Back',

[

'view',

'id'=>$model->id

],

[

'class'=>'btn btn-secondary btn-custom'

]

) ?>



</div>






<?php ActiveForm::end(); ?>








</div>


</div>