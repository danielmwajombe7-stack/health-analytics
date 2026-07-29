<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title="Receive Payment";


?>


<h2>
💳 Receive Payment
</h2>




<table class="table table-bordered">


<tr>

<th colspan="2">

🧾 Billing Information

</th>

</tr>




<tr>

<td>
Billing ID
</td>


<td>

<?= $billing->id ?>

</td>

</tr>




<tr>

<td>
Patient
</td>


<td>


<?php

if($billing->patient)
{

echo Html::encode(
$billing->patient->full_name
);

}

else
{

echo "N/A";

}

?>

</td>

</tr>




<tr>

<td>
Invoice Amount
</td>


<td>

<strong>

<?= number_format(
$billing->amount,
2
) ?>

</strong>


</td>

</tr>



<tr>

<td>
Outstanding Balance
</td>


<td>


<?= number_format(
$billing->balance,
2
) ?>


</td>


</tr>


</table>







<?php $form = ActiveForm::begin(); ?>




<table class="table table-bordered">


<tr>

<th colspan="2">

💰 Payment Details

</th>

</tr>





<tr>

<td>


<?= $form->field(
$model,
'amount_paid'
)->textInput([

'type'=>'number',

'value'=>$billing->balance

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

'prompt'=>'Select Payment Method'

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

'placeholder'=>
'Mobile transaction ID / Bank reference'

]) ?>


</td>

</tr>





</table>





<?= Html::submitButton(

'✅ Confirm Payment',

[

'class'=>'btn btn-success'

]

) ?>




<?php ActiveForm::end(); ?>