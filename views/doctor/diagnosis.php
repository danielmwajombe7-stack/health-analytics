<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Patient Diagnosis";

?>


<h2>
🩺 Patient Diagnosis
</h2>


<h4>

Patient:

<?= 
$queue->patient->first_name
?>

<?= 
$queue->patient->last_name
?>

</h4>




<?php $form=ActiveForm::begin(); ?>


<?= 
$form->field($model,'complaint')
->textarea([
'rows'=>3
])
?>



<?= 
$form->field($model,'symptoms')
->textarea([
'rows'=>3
])
?>



<?= 
$form->field($model,'diagnosis')
->textarea([
'rows'=>4
])
?>



<?= 
$form->field($model,'notes')
->textarea([
'rows'=>3
])
?>




<div>

<?= Html::submitButton(

'Save Diagnosis',

[
'class'=>'btn btn-success'
]

)

?>

</div>



<?php ActiveForm::end(); ?>