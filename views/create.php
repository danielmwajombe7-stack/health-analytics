<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;


$this->title="Create Laboratory Request";

?>


<div class="card p-4">


<h2>
🧪 Laboratory Request
</h2>



<?php $form=ActiveForm::begin(); ?>


<?=

$form->field($model,'test_name')

->textInput([
'value'=>'General Laboratory Investigation'
])

?>



<?=

$form->field($model,'status')

->dropDownList([

'Pending'=>'Pending',
'Completed'=>'Completed'

])

?>



<div>

<?=Html::submitButton(
'Send To Laboratory',
[
'class'=>'btn btn-primary'
]
)?>

</div>


<?php ActiveForm::end(); ?>


</div>