<?php

use yii\helpers\Html;

$this->title = "Print Receipt";

?>


<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">


<title>
Payment Receipt
</title>


<style>


body{

    font-family: Arial, sans-serif;
    font-size:14px;
    color:#000;

}



.receipt{

    width:80mm;
    margin:auto;
    padding:10px;

}



.header{

    text-align:center;

}



.header h2{

    margin:5px 0;

}



.line{

    border-top:1px dashed #000;

    margin:10px 0;

}



table{

    width:100%;
    border-collapse:collapse;

}



td{

    padding:5px 0;

}



.total{

    font-size:18px;
    font-weight:bold;

}



.center{

    text-align:center;

}



.footer{

    margin-top:20px;
    text-align:center;
    font-size:12px;

}




@media print{


    .no-print{

        display:none;

    }


    body{

        margin:0;

    }


}



</style>


</head>


<body>



<div class="receipt">





<div class="header">


<h2>

🏥 <?= Html::encode(
$data['hospital']['name']
) ?>

</h2>



<p>

<?= Html::encode(
$data['hospital']['address']
) ?>

<br>

<?= Html::encode(
$data['hospital']['phone']
) ?>


</p>


<h3>

PAYMENT RECEIPT

</h3>


</div>







<div class="line"></div>







<table>


<tr>

<td>
Receipt No:
</td>


<td align="right">

<?= Html::encode(
$data['receipt_number']
) ?>

</td>

</tr>





<tr>

<td>
Date:
</td>


<td align="right">

<?= Yii::$app->formatter->asDatetime(
$data['payment_date']
) ?>

</td>

</tr>






<tr>

<td>
Patient:
</td>


<td align="right">

<?= Html::encode(
$data['patient']
) ?>

</td>

</tr>






<tr>

<td>
Billing ID:
</td>


<td align="right">

<?= $data['billing'] ?>

</td>

</tr>





</table>







<div class="line"></div>







<table>


<tr>

<td>
Payment Method
</td>


<td align="right">

<?= Html::encode(
$data['method']
) ?>

</td>

</tr>





<tr>

<td>
Reference
</td>


<td align="right">

<?= Html::encode(
$data['reference']
) ?>

</td>

</tr>





<tr>

<td>
Cashier
</td>


<td align="right">

<?= Html::encode(
$data['cashier']
) ?>

</td>

</tr>



</table>








<div class="line"></div>







<table>


<tr>


<td class="total">

TOTAL PAID

</td>



<td align="right" class="total">


<?= $data['amount'] ?>


</td>


</tr>


</table>








<div class="line"></div>







<div class="footer">


<p>

Payment Status:

<strong>

<?= Html::encode(
$data['status']
) ?>

</strong>

</p>




<p>

Thank you for choosing our hospital.

</p>


<p>

System generated receipt

</p>



</div>






<div class="center no-print">


<br>


<button onclick="window.print()"

style="padding:10px 20px;">

🖨 PRINT

</button>


</div>





</div>


</body>


</html>