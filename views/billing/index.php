<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Billing Management";

?>


<div class="billing-wrapper">


<div class="page-header">


<div>

<h1>
💰 Billing & Finance Center
</h1>


<p>
Hospital revenue monitoring and patient payment management
</p>


</div>



<a href="<?=Url::to(['create'])?>"
class="new-btn">

➕ Create Invoice

</a>


</div>









<!-- SUMMARY CARDS -->


<div class="summary-grid">



<div class="finance-card revenue">

<div class="icon">
💵
</div>


<div>

<span>
Total Revenue
</span>


<h2>
TZS <?=number_format($totalAmount)?>
</h2>


<small>
All invoices
</small>


</div>


</div>







<div class="finance-card paid">


<div class="icon">
✅
</div>


<div>

<span>
Paid Amount
</span>


<h2>
TZS <?=number_format($paid)?>
</h2>


<small>
Completed payments
</small>


</div>


</div>








<div class="finance-card pending">


<div class="icon">
⏳
</div>


<div>

<span>
Pending Amount
</span>


<h2>
TZS <?=number_format($pending)?>
</h2>


<small>
Awaiting payment
</small>


</div>


</div>








<div class="finance-card total">


<div class="icon">
🧾
</div>


<div>

<span>
Total Invoices
</span>


<h2>
<?=count($billing)?>
</h2>


<small>
Generated bills
</small>


</div>


</div>



</div>









<!-- BILLING TABLE -->


<div class="billing-card">


<div class="card-title">

<h2>
💳 Billing Transactions
</h2>

</div>





<table>


<thead>


<tr>


<th>
Invoice
</th>


<th>
Patient
</th>


<th>
Service
</th>


<th>
Amount
</th>


<th>
Date
</th>


<th>
Payment Status
</th>


<th>
Action
</th>


</tr>


</thead>






<tbody>



<?php foreach($billing as $bill): ?>



<tr>



<td>

<strong class="invoice">

#<?=$bill->id?>

</strong>


</td>







<td>


<div class="patient">


<div class="avatar">

👤

</div>



<div>


<?php if($bill->patient): ?>


<strong>

<?=Html::encode(

$bill->patient->first_name.' '.
$bill->patient->last_name

)?>

</strong>


<br>


<small>

Patient ID:
<?=$bill->patient->id?>

</small>



<?php else: ?>


<strong>
Unknown Patient
</strong>



<?php endif; ?>


</div>


</div>


</td>









<td>


<?=Html::encode(

$bill->description ?? 
'Medical Service'

)?>


</td>









<td>


<strong>

TZS <?=number_format($bill->amount)?>

</strong>


</td>









<td>


<?=$bill->created_at ?? '-'?>


</td>








<td>


<?php


$status = $bill->payment_status
??
$bill->status
??
'Pending';


?>


<span class="status <?=strtolower($status)?>">


<?=Html::encode($status)?>


</span>



</td>









<td>



<a href="<?=Url::to([
'view',
'id'=>$bill->id
])?>"

class="action view">

👁

</a>





<?php if(strtolower($status)!="paid"): ?>


<a href="<?=Url::to([
'pay',
'id'=>$bill->id
])?>"

class="action pay">


💳 Pay Now


</a>



<?php else: ?>


<span class="paid-label">

✅ Paid

</span>



<?php endif; ?>







<a href="<?=Url::to([
'update',
'id'=>$bill->id
])?>"

class="action edit">


✏


</a>



</td>






</tr>



<?php endforeach; ?>







<?php if(empty($billing)): ?>


<tr>

<td colspan="7"
class="empty">

No billing records found

</td>

</tr>


<?php endif; ?>





</tbody>


</table>



</div>



</div>









<style>


.billing-wrapper{

padding:30px;

background:#f4f8f7;

min-height:100vh;

}





.page-header{

display:flex;

justify-content:space-between;

align-items:center;

margin-bottom:30px;

}




.page-header h1{

color:#00695c;

font-size:32px;

}





.page-header p{

color:#777;

}





.new-btn{

background:#00897b;

color:white;

padding:14px 25px;

border-radius:30px;

text-decoration:none;

font-weight:bold;

}







.summary-grid{

display:grid;

grid-template-columns:repeat(4,1fr);

gap:20px;

}







.finance-card{


background:white;

padding:25px;

border-radius:20px;

display:flex;

gap:20px;

align-items:center;

box-shadow:0 10px 25px rgba(0,0,0,.08);

border-left:6px solid #00897b;


}



.finance-card .icon{

font-size:38px;

}



.finance-card h2{

color:#00695c;

}





.finance-card.paid{

border-color:#2e7d32;

}



.finance-card.pending{

border-color:#f9a825;

}



.finance-card.total{

border-color:#0277bd;

}








.billing-card{


margin-top:35px;

background:white;

padding:25px;

border-radius:20px;

box-shadow:0 10px 25px rgba(0,0,0,.08);


}







.card-title h2{

color:#00695c;

}





table{

width:100%;

border-collapse:collapse;

}



thead{

background:#e0f2f1;

}



th{

padding:15px;

text-align:left;

}



td{

padding:15px;

border-bottom:1px solid #eee;

}





tr:hover{

background:#f8ffff;

}





.patient{

display:flex;

gap:12px;

align-items:center;

}





.avatar{

width:40px;

height:40px;

border-radius:50%;

background:#e0f2f1;

display:flex;

align-items:center;

justify-content:center;

}






.invoice{

color:#00897b;

}







.status{


padding:7px 14px;

border-radius:20px;

font-size:12px;

font-weight:bold;

}




.status.paid{

background:#c8e6c9;

color:#256029;

}





.status.pending{

background:#fff3cd;

color:#856404;

}







.action{


padding:8px 12px;

border-radius:8px;

color:white;

text-decoration:none;

margin-right:5px;

font-size:13px;

}



.view{

background:#0277bd;

}



.pay{

background:#00897b;

}




.edit{

background:#f9a825;

}





.paid-label{


background:#2e7d32;

color:white;

padding:8px 14px;

border-radius:20px;

font-size:12px;

font-weight:bold;

}





.empty{

text-align:center;

padding:30px;

}





@media(max-width:1200px){


.summary-grid{

grid-template-columns:repeat(2,1fr);

}


}




</style>