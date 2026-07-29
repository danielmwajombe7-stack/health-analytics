<?php

use yii\helpers\Html;


$this->title="Payment Receipt";


?>



<div class="receipt-container">



<div style="text-align:center">


<h2>
🏥 <?= Html::encode(
$receipt['hospital']['name']
) ?>
</h2>



<p>

<?= Html::encode(
$receipt['hospital']['address']
) ?>

<br>

<?= Html::encode(
$receipt['hospital']['phone']
) ?>

</p>



<h3>

PAYMENT RECEIPT

</h3>


</div>






<table class="table table-bordered">


<tr>

<th>
Receipt Number
</th>


<td>

<?= Html::encode(
$receipt['receipt_number']
) ?>

</td>


</tr>





<tr>

<th>
Payment Date
</th>


<td>

<?= Yii::$app->formatter->asDatetime(
$receipt['payment_date']
) ?>

</td>


</tr>





<tr>

<th>
Patient
</th>


<td>

<?= Html::encode(
$receipt['patient']
) ?>

</td>


</tr>






<tr>

<th>
Billing ID
</th>


<td>

<?= $receipt['billing'] ?>

</td>


</tr>






<tr>

<th>
Amount Paid
</th>


<td>

<strong>

<?= $receipt['amount'] ?>

</strong>


</td>


</tr>






<tr>

<th>
Payment Method
</th>


<td>

<?= Html::encode(
$receipt['method']
) ?>

</td>


</tr>






<tr>

<th>
Transaction Reference
</th>


<td>

<?= Html::encode(
$receipt['reference']
) ?>

</td>


</tr>






<tr>

<th>
Cashier
</th>


<td>

<?= Html::encode(
$receipt['cashier']
) ?>

</td>


</tr>






<tr>

<th>
Status
</th>


<td>

<span class="badge bg-success">

<?= $receipt['status'] ?>

</span>

</td>


</tr>



</table>







<div style="text-align:center;margin-top:30px">


<p>

Thank you for choosing our hospital.

</p>



<?= Html::a(

'🖨 Print Receipt',

[

'print',

'id'=>$model->id

],

[

'class'=>'btn btn-primary',

'target'=>'_blank'

]

) ?>


</div>



</div>