<?php

use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Receive Payment";

?>


<div class="payment-wrapper">



<div class="payment-card">



<div class="payment-header">


<h1>
💳 Receive Patient Payment
</h1>


<p>
Complete payment for hospital services
</p>


</div>







<div class="invoice-box">


<h3>
🧾 Invoice #<?=$billing->id?>
</h3>



<div class="patient-info">


<div class="patient-avatar">

👤

</div>



<div>


<h4>

<?php if($billing->patient): ?>


<?=$billing->patient->first_name?>

<?=$billing->patient->last_name?>


<?php else: ?>


Unknown Patient


<?php endif; ?>


</h4>



<p>

Patient ID:

<?=$billing->patient->id ?? '-'?>

</p>


</div>


</div>







<div class="amount-box">


<span>
Amount Due
</span>


<h2>

TZS <?=number_format($billing->amount)?>

</h2>


</div>



</div>









<form method="post">



<input type="hidden"
name="_csrf"
value="<?=Yii::$app->request->csrfToken?>">






<div class="form-group">


<label>
💰 Payment Method
</label>



<select name="payment_method"
class="form-control"
required>


<option value="">
Select Method
</option>



<option value="Cash">

💵 Cash

</option>



<option value="Mobile Money">

📱 Mobile Money

</option>




<option value="Bank Transfer">

🏦 Bank Transfer

</option>




<option value="Insurance">

🛡 Insurance

</option>



</select>


</div>









<div class="form-group">


<label>
Amount Paid (TZS)
</label>


<input type="number"

name="amount_paid"

class="form-control"

value="<?=$billing->amount?>"

required>


</div>









<div class="form-group">


<label>

Transaction Reference

</label>



<input type="text"

name="transaction_reference"

class="form-control"

placeholder="Example: MPESA-123456">


</div>









<div class="payment-actions">


<a href="<?=Url::to(['index'])?>"

class="cancel-btn">

← Cancel

</a>




<button type="submit"

class="pay-btn">


💳 PAY NOW


</button>



</div>






</form>






</div>


</div>











<style>


.payment-wrapper{


padding:40px;

background:#f4f8f7;

min-height:100vh;

display:flex;

justify-content:center;


}





.payment-card{


width:600px;

background:white;

border-radius:25px;

padding:35px;

box-shadow:0 15px 35px rgba(0,0,0,.12);


}







.payment-header{


text-align:center;

margin-bottom:30px;


}




.payment-header h1{


color:#00695c;

font-size:30px;


}





.payment-header p{


color:#777;


}







.invoice-box{


background:#e0f2f1;

padding:25px;

border-radius:20px;

margin-bottom:30px;


}






.patient-info{


display:flex;

align-items:center;

gap:15px;

margin-top:20px;


}







.patient-avatar{


width:55px;

height:55px;

border-radius:50%;

background:white;

display:flex;

align-items:center;

justify-content:center;

font-size:25px;


}







.amount-box{


margin-top:25px;

background:white;

padding:20px;

border-radius:15px;

text-align:center;

border:2px solid #00897b;


}



.amount-box span{


color:#777;


}




.amount-box h2{


color:#00897b;

font-size:32px;


}







.form-group{


margin-bottom:20px;


}




.form-group label{


font-weight:bold;

display:block;

margin-bottom:8px;

color:#00695c;


}





.form-control{


width:100%;

padding:14px;

border-radius:12px;

border:1px solid #ccc;

font-size:15px;


}





.payment-actions{


display:flex;

justify-content:space-between;

margin-top:30px;


}





.cancel-btn{


background:#777;

color:white;

padding:14px 25px;

border-radius:30px;

text-decoration:none;


}






.pay-btn{


background:#00897b;

border:none;

color:white;

padding:14px 35px;

border-radius:30px;

font-size:16px;

font-weight:bold;

cursor:pointer;


}




.pay-btn:hover{


background:#00695c;


}



</style>