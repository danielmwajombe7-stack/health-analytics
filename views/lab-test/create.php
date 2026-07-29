<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Request Laboratory Test";


?>


<style>

.box{

padding:30px;

background:#f4f8fb;

}



.form-card{

background:white;

padding:30px;

border-radius:20px;

box-shadow:0 10px 25px rgba(0,0,0,.08);

}



</style>





<div class="box">


<div class="form-card">


<h1>
🧪 Request Laboratory Test
</h1>



<?php $form = ActiveForm::begin(); ?>




<?= $form->field($model,'test_name')
->textInput([
'placeholder'=>'Example: Blood Test, Malaria Test'
])
?>





<?= $form->field($model,'priority')
->dropDownList([


'Normal'=>'Normal',


'Urgent'=>'Urgent'


])

?>






<?= $form->field($model,'doctor_note')
->textarea([
'rows'=>5
])

?>






<?= Html::submitButton(
'Submit Test Request',
[
'class'=>'btn btn-success'
]
)

?>




<?php ActiveForm::end(); ?>



</div>


</div>