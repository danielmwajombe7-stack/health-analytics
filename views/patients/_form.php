<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$form = ActiveForm::begin();

?>



<?= $form->field($model,'patient_number')
->textInput([
    'placeholder'=>'PT-0001'
])
?>



<?= $form->field($model,'first_name')
->textInput()
?>



<?= $form->field($model,'middle_name')
->textInput()
?>



<?= $form->field($model,'last_name')
->textInput()
?>



<?= $form->field($model,'gender')
->dropDownList([

    'Male'=>'Male',

    'Female'=>'Female'

])

?>



<?= $form->field($model,'date_of_birth')
->input('date')
?>



<?= $form->field($model,'phone')
->textInput()
?>



<?= $form->field($model,'email')
->textInput()
?>



<?= $form->field($model,'address')
->textarea()
?>



<?= $form->field($model,'blood_group')
->textInput()
?>



<?= $form->field($model,'status')
->dropDownList([

    'Active'=>'Active',

    'Critical'=>'Critical',

    'Recovered'=>'Recovered',

    'Discharged'=>'Discharged'

])

?>





<div class="form-group">


<?= Html::submitButton(

    '💾 Save Patient',

    [

        'class'=>'btn btn-primary'

    ]

)

?>


</div>



<?php ActiveForm::end(); ?>