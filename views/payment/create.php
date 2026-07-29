<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Create Payment";

?>


<h2>
💰 Create Payment
</h2>



<?php $form = ActiveForm::begin(); ?>



<table class="table table-bordered">


<tr>

<th colspan="2">
Payment Information
</th>

</tr>




<tr>

<td>

<?= $form->field(
$model,
'receipt_number'
)->textInput([
'placeholder'=>'Auto generated receipt'
]) ?>

</td>


</tr>





<tr>

<td>

<?= $form->field(
$model,
'amount_paid'
)->textInput([
'type'=>'number'
]) ?>

</td>

</tr>





<tr>

<td>

<?= $form->field(
$model,
'payment_method'
)->dropDownList([


'Cash'=>'Cash',

'Mobile Money'=>'Mobile Money',

'Bank'=>'Bank',

'Card'=>'Card',

'Insurance'=>'Insurance'


],


[
'prompt'=>'Select Method'
]

) ?>


</td>

</tr>






<tr>

<td>


<?= $form->field(
$model,
'transaction_reference'
)->textInput([
'placeholder'=>'Transaction ID / Reference'
]) ?>


</td>

</tr>



</table>




<?= Html::submitButton(
'💾 Save Payment',
[
'class'=>'btn btn-success'
]
) ?>



<?php ActiveForm::end(); ?>