<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Update Medical Record";


?>


<div class="container">


<div class="card shadow">

<div class="card-body">


<?php $form=ActiveForm::begin(); ?>


<?= $form->field($model,'diagnosis')
->textarea()
?>


<?= $form->field($model,'notes')
->textarea()
?>



<?= Html::submitButton(

'Update',

[
'class'=>'btn btn-primary'
]

)

?>



<?php ActiveForm::end(); ?>


</div>


</div>


</div>