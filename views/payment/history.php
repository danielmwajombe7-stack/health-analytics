<?php

use yii\helpers\Html;


$this->title="Payment History";


?>


<h2>
📊 Payment History & Audit Trail
</h2>



<p class="text-muted">

Complete hospital payment transaction monitoring

</p>





<!-- =========================
 SUMMARY
========================= -->


<table class="table table-bordered">


<tr>

<th>
Total Transactions
</th>


<th>
Today Collection
</th>


<th>
Weekly Collection
</th>


<th>
Monthly Collection
</th>


</tr>



<tr>


<td>

<?= $analytics['total'] ?>

</td>




<td>

<?= number_format(
$analytics['today'],
2
) ?>

</td>




<td>

<?= number_format(
$analytics['weekly'],
2
) ?>

</td>




<td>

<?= number_format(
$analytics['monthly'],
2
) ?>

</td>



</tr>


</table>








<!-- =========================
 TRANSACTION HISTORY
========================= -->


<h4>
💳 All Transactions
</h4>



<table class="table table-bordered">


<tr>

<th>
Receipt
</th>


<th>
Patient
</th>


<th>
Amount
</th>


<th>
Method
</th>


<th>
Status
</th>


<th>
Cashier
</th>


<th>
Date
</th>


</tr>





<?php foreach($payments as $payment): ?>


<tr>


<td>

<?= Html::encode(
$payment->receipt_number
) ?>

</td>




<td>

<?= Html::encode(
$payment->patientName
) ?>

</td>




<td>

<?= number_format(
$payment->amount_paid,
2
) ?>

</td>




<td>

<?= $payment->methodBadge ?>

</td>




<td>

<?= $payment->statusBadge ?>

</td>




<td>

<?= Html::encode(
$payment->cashierName
) ?>

</td>




<td>

<?= Yii::$app->formatter->asDatetime(
$payment->payment_date
) ?>

</td>



</tr>



<?php endforeach; ?>


</table>









<!-- =========================
 CASHIER PERFORMANCE
========================= -->


<h4>

👨‍💼 Cashier Performance

</h4>




<table class="table table-bordered">


<tr>

<th>
Cashier ID
</th>


<th>
Transactions
</th>


<th>
Collected Amount
</th>


</tr>




<?php foreach($analytics['cashiers'] as $cashier): ?>


<tr>


<td>

<?= $cashier['received_by'] ?>

</td>



<td>

<?= $cashier['total_transactions'] ?>

</td>




<td>

<?= number_format(
$cashier['total_amount'],
2
) ?>

</td>


</tr>



<?php endforeach; ?>


</table>









<!-- =========================
 DAILY COLLECTION TREND
========================= -->


<h4>

📈 Daily Collection History

</h4>




<table class="table table-bordered">


<tr>

<th>
Date
</th>


<th>
Revenue
</th>


</tr>



<?php foreach($analytics['trend'] as $day): ?>


<tr>


<td>

<?= $day['date'] ?>

</td>



<td>

<?= number_format(
$day['amount'],
2
) ?>

</td>


</tr>



<?php endforeach; ?>


</table>