<?php

use yii\helpers\Html;


$this->title="Payments";

?>



<h2>
💰 Payment Management
</h2>


<p class="text-muted">
Hospital Financial Payment Transactions
</p>





<!-- ==========================
 SUMMARY CARDS
========================== -->


<div class="row mb-4">



<div class="col-md-3">


<div class="card border-0 shadow-sm">


<div class="card-body">


<h6 class="text-muted">
Total Payments
</h6>


<h3>
<?= count($payments) ?>
</h3>


</div>


</div>


</div>






<div class="col-md-3">


<div class="card border-0 shadow-sm">


<div class="card-body">


<h6 class="text-muted">
Paid Transactions
</h6>


<h3 class="text-success">


<?= count(array_filter($payments,function($p){

return $p->payment_status=="Paid";

})) ?>


</h3>


</div>


</div>


</div>







<div class="col-md-3">


<div class="card border-0 shadow-sm">


<div class="card-body">


<h6 class="text-muted">
Refunded
</h6>


<h3 class="text-danger">


<?= count(array_filter($payments,function($p){

return $p->payment_status=="Refunded";

})) ?>


</h3>


</div>


</div>


</div>







<div class="col-md-3">


<div class="card border-0 shadow-sm">


<div class="card-body">


<h6 class="text-muted">
Total Collection
</h6>


<h3 class="text-primary">


<?= number_format(

array_sum(
array_map(function($p){

return $p->amount_paid;

},$payments)

),

2

) ?>


</h3>


</div>


</div>


</div>



</div>









<!-- ==========================
 SEARCH & FILTER
========================== -->


<form method="get" class="mb-4">


<div class="row g-2">


<div class="col-md-5">


<input

type="text"

name="search"

class="form-control"

placeholder="Search receipt, patient, reference..."

>


</div>






<div class="col-md-3">


<select

name="status"

class="form-select"

>


<option value="">
All Status
</option>


<option value="Paid">
Paid
</option>


<option value="Pending">
Pending
</option>


<option value="Refunded">
Refunded
</option>


<option value="Failed">
Failed
</option>


</select>


</div>







<div class="col-md-3">


<select

name="method"

class="form-select"

>


<option value="">
All Methods
</option>


<option value="Cash">
Cash
</option>


<option value="Mobile Money">
Mobile Money
</option>


<option value="Bank">
Bank
</option>


<option value="Insurance">
Insurance
</option>


<option value="Card">
Card
</option>


</select>


</div>







<div class="col-md-1">


<button class="btn btn-primary w-100">

🔍

</button>


</div>



</div>


</form>










<!-- ==========================
 PAYMENT TABLE
========================== -->


<div class="table-responsive">


<table class="table table-bordered table-hover align-middle">



<tr class="table-light">


<th>ID</th>

<th>Receipt</th>

<th>Patient</th>

<th>Amount</th>

<th>Method</th>

<th>Status</th>

<th>Cashier</th>

<th>Date</th>

<th>Actions</th>


</tr>







<?php if(!empty($payments)): ?>



<?php foreach($dataProvider->models as $payment): ?>



<tr>



<td>

<?= $payment->id ?>

</td>





<td>


<strong>

<?= Html::encode(

$payment->receipt_number

) ?>


</strong>


</td>






<td>


<?= Html::encode(

$payment->patientName

) ?>


</td>






<td>


<strong>

<?= number_format(

$payment->amount_paid,

2

) ?>


</strong>


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








<td>


<div class="btn-group">


<?= Html::a(

'👁',

[

'view',

'id'=>$payment->id

],

[

'class'=>'btn btn-sm btn-primary',

'title'=>'View Payment'

]

) ?>






<?= Html::a(

'🧾',

[

'receipt',

'id'=>$payment->id

],

[

'class'=>'btn btn-sm btn-success',

'title'=>'Receipt'

]

) ?>






<?= Html::a(

'🖨',

[

'print',

'id'=>$payment->id

],

[

'class'=>'btn btn-sm btn-info',

'target'=>'_blank',

'title'=>'Print Receipt'

]

) ?>








<?= Html::a(

'↩',

[

'refund',

'id'=>$payment->id

],

[

'class'=>'btn btn-sm btn-danger',

'data-confirm'=>

'Are you sure you want to refund this payment?',

'title'=>'Refund'

]

) ?>



</div>


</td>



</tr>



<?php endforeach; ?>



<?php else: ?>



<tr>

<td colspan="9" class="text-center text-muted">


No payment records found.


</td>

</tr>



<?php endif; ?>




</table>
<?= \yii\widgets\LinkPager::widget([

    'pagination'=>$dataProvider->pagination,

    'options'=>[
        'class'=>'pagination justify-content-center'
    ],

    'linkOptions'=>[
        'class'=>'page-link'
    ]

]) ?>

</div>