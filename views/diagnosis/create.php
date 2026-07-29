<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Doctor Diagnosis";

?>


<h1>
<?= Html::encode($this->title) ?>
</h1>



<?php $form=ActiveForm::begin(); ?>



<?= $form->field(
$model,
'disease_id'
)
->textInput()
?>



<?= $form->field(
$model,
'diagnosis_note'
)
->textarea([
'rows'=>5
])
?>



<?= $form->field(
$model,
'severity'
)
->dropDownList(

[
'Mild'=>'Mild',
'Moderate'=>'Moderate',
'Severe'=>'Severe',
'Critical'=>'Critical'

]

)

?>



<?= $form->field(
$model,
'doctor_advice'
)
->textarea([
'rows'=>5
])
?>





<?= Html::submitButton(

'Save Diagnosis',

[
'class'=>'btn btn-success'
]

)

?>



<?php ActiveForm::end(); ?>