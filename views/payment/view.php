<?php

use yii\helpers\Html;


$this->title = "Payment Details";


?>


<h2>
💰 Payment Details
</h2>



<div class="mb-3">


<?= Html::a(
    '← Back Payments',
    ['index'],
    [
        'class'=>'btn btn-secondary'
    ]
) ?>



<?= Html::a(
    '🧾 Receipt',
    [
        'receipt',
        'id'=>$model->id
    ],
    [
        'class'=>'btn btn-success'
    ]
) ?>



<?= Html::a(
    '🖨 Print',
    [
        'print',
        'id'=>$model->id
    ],
    [
        'class'=>'btn btn-info',
        'target'=>'_blank'
    ]
) ?>



<?= Html::a(
    '↩ Refund',
    [
        'refund',
        'id'=>$model->id
    ],
    [
        'class'=>'btn btn-danger',
        'data-confirm'=>
        'Are you sure you want to refund this payment?'
    ]
) ?>


</div>





<!-- ==========================
 PAYMENT INFORMATION
=========================== -->


<table class="table table-bordered">


<tr>

<th colspan="2">
💳 Payment Information
</th>

</tr>



<tr>

<td>
Payment ID
</td>

<td>

<?= $model->id ?>

</td>

</tr>




<tr>

<td>
Receipt Number
</td>

<td>

<?= Html::encode(
    $model->receipt_number
) ?>

</td>

</tr>





<tr>

<td>
Amount Paid
</td>

<td>

<strong>

<?= number_format(
    $model->amount_paid,
    2
) ?>

</strong>

</td>

</tr>





<tr>

<td>
Payment Method
</td>

<td>

<?= Html::encode(
    $model->payment_method
) ?>

</td>

</tr>





<tr>

<td>
Payment Status
</td>

<td>

<?= $model->statusBadge ?>

</td>

</tr>





<tr>

<td>
Transaction Reference
</td>

<td>

<?= Html::encode(
    $model->transaction_reference
) ?>

</td>

</tr>





<tr>

<td>
Payment Date
</td>

<td>

<?= Yii::$app->formatter->asDatetime(
    $model->payment_date
) ?>

</td>

</tr>



</table>








<!-- ==========================
 BILLING INFORMATION
=========================== -->


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

<?php

echo $model->billing_id ?? 'N/A';

?>

</td>


</tr>





<tr>

<td>
Invoice Amount
</td>


<td>


<?php

if($model->billing)
{

echo number_format(
    $model->billing->amount,
    2
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
Billing Status
</td>


<td>


<?php

if($model->billing)
{

echo Html::encode(
    $model->billing->status
);

}
else
{

echo "N/A";

}

?>


</td>


</tr>



</table>








<!-- ==========================
 PATIENT INFORMATION
=========================== -->


<table class="table table-bordered">


<tr>

<th colspan="2">

👤 Patient Information

</th>

</tr>




<tr>

<td>
Patient Name
</td>


<td>


<?php


if(
$model->billing &&
$model->billing->patient
)

{

echo Html::encode(
$model->billing->patient->full_name
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
Phone
</td>


<td>


<?php


if(
$model->billing &&
$model->billing->patient
)

{

echo Html::encode(
$model->billing->patient->phone
);

}

else

{

echo "N/A";

}


?>


</td>

</tr>



</table>










<!-- ==========================
 TRANSACTION TIMELINE
=========================== -->


<table class="table table-bordered">


<tr>

<th>

⏱ Transaction Timeline

</th>

</tr>




<tr>

<td>


<ul>


<li>

Payment Created:

<?= Yii::$app->formatter->asDatetime(
$model->created_at
) ?>


</li>



<li>

Received By:

<?php

if($model->receiver)
{

echo Html::encode(
$model->receiver->username
);

}

else

{

echo "N/A";

}

?>


</li>




<li>

Status:

<?= Html::encode(
$model->payment_status
) ?>


</li>



</ul>


</td>


</tr>



</table>








<!-- ==========================
 AUDIT TRAIL
=========================== -->


<table class="table table-bordered">


<tr>

<th colspan="2">

🔍 Payment Audit Trail

</th>

</tr>




<tr>


<td>

Last Updated

</td>


<td>

<?= Yii::$app->formatter->asDatetime(
$model->updated_at
) ?>

</td>


</tr>





<tr>

<td>

Transaction Status

</td>


<td>

<?= Html::encode(
$model->payment_status
) ?>

</td>


</tr>




<tr>

<td>

Reference

</td>


<td>

<?= Html::encode(
$model->transaction_reference
) ?>

</td>


</tr>



</table>