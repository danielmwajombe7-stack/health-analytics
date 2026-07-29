<?php

use yii\helpers\Html;

$this->title = "Medicine Inventory";

?>

<link 
href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" 
rel="stylesheet">


<style>

/* =====================================================
   MYLES HEALTH ANALYTICS SYSTEM
   PHARMACY INVENTORY PROFESSIONAL UI
===================================================== */


.page-container{

    padding:25px;

    color:white;

    font-family:'Inter','Segoe UI',sans-serif;

}


/* HEADER */

.inventory-header{

    background:
    linear-gradient(
        135deg,
        #064e3b,
        #0f766e,
        #115e59
    );

    padding:32px;

    border-radius:22px;

    color:white;

    box-shadow:
    0 20px 45px rgba(0,0,0,.45);

}


.inventory-header h1{

    font-size:34px;

    font-weight:900;

    margin-bottom:8px;

}


.inventory-header p{

    font-size:15px;

    font-weight:600;

    opacity:.9;

}


/* ADD BUTTON */

.add-btn{

    background:white;

    color:#065f46;

    padding:12px 24px;

    border-radius:14px;

    font-weight:900;

    text-decoration:none;

    box-shadow:

    0 6px 0 #064e3b,

    0 12px 25px rgba(0,0,0,.3);

    transition:.3s;

}


.add-btn:hover{

    transform:translateY(-3px);

    color:#065f46;

}



/* STATISTICS */


.stats-row{

    display:grid;

    grid-template-columns:
    repeat(3,1fr);

    gap:20px;

    margin-top:25px;

}



.stat-card{

    background:

    linear-gradient(
        145deg,
        #111827,
        #1f2937
    );

    padding:25px;

    border-radius:20px;

    border:

    1px solid rgba(255,255,255,.08);


    box-shadow:

    0 15px 35px rgba(0,0,0,.45);

}



.stat-content{

    display:flex;

    align-items:center;

    gap:18px;

}



.stat-icon{

    width:65px;

    height:65px;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:30px;

    border-radius:18px;


    background:

    linear-gradient(
        135deg,
        #14b8a6,
        #0f766e
    );

}



.stat-title{

    color:#cbd5e1;

    font-size:13px;

    font-weight:900;

    text-transform:uppercase;

}



.stat-number{

    font-size:34px;

    font-weight:950;

    margin-top:5px;

}



/* TABLE */

.table-container{


    margin-top:30px;


    background:

    linear-gradient(
        145deg,
        #111827,
        #0f172a
    );


    padding:25px;


    border-radius:22px;


    box-shadow:

    0 20px 40px rgba(0,0,0,.45);


}



.table-title{

    font-size:22px;

    font-weight:900;

    margin-bottom:20px;

}



#medicineTable{


    width:100%!important;

    color:white!important;

    table-layout:fixed;

    font-size:13px;


}



#medicineTable thead th{


    background:#065f46!important;

    color:white;


    padding:12px 8px!important;


    font-size:12px;


    font-weight:900;


    text-transform:uppercase;


}



#medicineTable tbody tr{


    background:#1e293b;

    transition:.25s;

}



#medicineTable tbody tr:hover{


    background:#334155;

}



#medicineTable td{


    padding:10px 8px!important;

    color:#e5e7eb;

    font-weight:600;

    vertical-align:middle;

}



.medicine-name{


    color:#5eead4;

    font-weight:900;

}



/* BADGES */


.available-badge{


    background:

    linear-gradient(
        135deg,
        #166534,
        #15803d
    );


    color:#dcfce7;


    padding:6px 14px;


    border-radius:30px;


    font-size:12px;


    font-weight:900;


}



.low-badge{


    background:

    linear-gradient(
        135deg,
        #991b1b,
        #dc2626
    );


    color:#fee2e2;


    padding:6px 14px;


    border-radius:30px;


    font-size:12px;


    font-weight:900;


}



/* BUTTON */

.btn-3d{


    display:inline-flex;

    align-items:center;

    gap:5px;


    padding:7px 12px;


    border-radius:10px;


    color:white;

    text-decoration:none;


    font-size:12px;


    font-weight:900;


}



.view-btn{


    background:

    linear-gradient(
        135deg,
        #0284c7,
        #0369a1
    );

}



.edit-btn{


    background:

    linear-gradient(
        135deg,
        #f59e0b,
        #d97706
    );

}


</style>


<div class="page-container">


<div class="inventory-header">


<div class="d-flex justify-content-between align-items-center">


<div>


<h1>
💊 Medicine Inventory
</h1>


<p>
Monitor medicine stock quantity, expiry dates and availability.
</p>


</div>


<div>

<?= Html::a(
    '➕ Add Medicine',
    ['create'],
    [
        'class'=>'add-btn'
    ]
) ?>


</div>


</div>


</div>



<!-- STATISTICS -->


<div class="stats-row">


<div class="stat-card">


<div class="stat-content">


<div class="stat-icon">
💊
</div>


<div>

<div class="stat-title">
Total Medicines
</div>


<div class="stat-number">

<?= count($medicines) ?>

</div>


</div>


</div>


</div>





<div class="stat-card">


<div class="stat-content">


<div class="stat-icon">
📦
</div>


<div>

<div class="stat-title">
Total Stock
</div>


<div class="stat-number">


<?= array_sum(
    array_map(
        function($m){

            return $m->medicineStock
                ? $m->medicineStock->quantity
                : 0;

        },
        $medicines
    )
) ?>


</div>


</div>


</div>


</div>





<div class="stat-card">


<div class="stat-content">


<div class="stat-icon">
⚠️
</div>


<div>


<div class="stat-title">
Low Stock Alert
</div>


<div class="stat-number">


<?= count(
    array_filter(
        $medicines,

        function($m){

            return $m->medicineStock
            &&
            $m->medicineStock->quantity <= 50;

        }
    )
) ?>


</div>


</div>


</div>


</div>


</div>
<!-- MEDICINE TABLE -->

<div class="table-container">


<h3 class="table-title">
💊 Available Medicines
</h3>



<table id="medicineTable" class="table table-hover align-middle">


<thead>

<tr>

<th>#</th>

<th>Medicine Name</th>

<th>Type</th>

<th>Strength</th>

<th>Stock</th>

<th>Manufacturer</th>

<th>Expiry Date</th>

<th>Status</th>

<th>Action</th>


</tr>

</thead>



<tbody>


<?php foreach($medicines as $i=>$medicine): ?>


<?php

$stock = $medicine->medicineStock
    ? $medicine->medicineStock->quantity
    : 0;


$expiry = strtotime($medicine->expiry_date);

$today = strtotime(date('Y-m-d'));


$isExpired = $expiry < $today;


$expiringSoon = 
$expiry <= strtotime('+6 months');



?>


<tr>


<td class="text-center">

<?= $i + 1 ?>

</td>




<td>

<span class="medicine-name">

💊 <?= Html::encode($medicine->name) ?>

</span>

</td>




<td>

<?= Html::encode($medicine->type) ?>

</td>




<td>

<?= Html::encode($medicine->strength) ?>

</td>




<!-- STOCK -->

<td class="text-center">


<?php if($stock <= 50): ?>


<span class="low-badge">

⚠ <?= $stock ?> Low

</span>


<?php else: ?>


<span class="available-badge">

✔ <?= $stock ?> Available

</span>


<?php endif; ?>


</td>





<td>

<?= Html::encode($medicine->manufacturer) ?>

</td>





<!-- EXPIRY -->

<td>


<?php if($isExpired): ?>


<span class="low-badge">

Expired

</span>


<?php elseif($expiringSoon): ?>


<span class="low-badge">

<?= Yii::$app->formatter
->asDate($medicine->expiry_date) ?>

</span>


<?php else: ?>


<span class="available-badge">

<?= Yii::$app->formatter
->asDate($medicine->expiry_date) ?>

</span>


<?php endif; ?>


</td>





<!-- STATUS -->


<td class="text-center">


<?php


if($stock <= 0){

$status = "Out of Stock";

}

elseif($stock <= 50){

$status = "Low Stock";

}

else{

$status = "Available";

}


?>



<?php if($status == "Available"): ?>


<span class="available-badge">

✔ Available

</span>


<?php elseif($status == "Low Stock"): ?>


<span class="low-badge">

⚠ Low Stock

</span>


<?php else: ?>


<span class="low-badge">

❌ Out of Stock

</span>


<?php endif; ?>


</td>





<!-- ACTION -->


<td class="text-center">


<?= Html::a(

'👁 View',

['view','id'=>$medicine->id],

[

'class'=>'btn-3d view-btn'

]

) ?>




<?= Html::a(

'✏ Edit',

['update','id'=>$medicine->id],

[

'class'=>'btn-3d edit-btn'

]

) ?>



</td>



</tr>


<?php endforeach; ?>


</tbody>


</table>


</div>


</div>




<!-- DATATABLES -->


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>


<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>




<style>


.dataTables_wrapper{

color:white;

margin-top:20px;

}



.dataTables_filter label,

.dataTables_length label,

.dataTables_info{

color:#cbd5e1!important;

font-weight:700;

}




.dataTables_filter input,

.dataTables_length select{


background:#0f172a!important;


color:white!important;


border:1px solid #334155!important;


border-radius:10px;


padding:6px 12px;


}



.dataTables_paginate{

margin-top:15px;

}



.dataTables_paginate .paginate_button{


background:#1e293b!important;


color:white!important;


border-radius:10px!important;


margin:3px;


}



.dataTables_paginate .paginate_button.current{


background:

linear-gradient(

135deg,

#14b8a6,

#0f766e

)!important;


color:white!important;


}



</style>





<script>


$(document).ready(function(){


$('#medicineTable').DataTable({


responsive:true,


pageLength:10,


lengthMenu:[

[10,25,50,100],

[10,25,50,100]

],



order:[

[0,'asc']

],




language:{


search:"🔍 Search Medicine:",


lengthMenu:"Show _MENU_ medicines",


info:

"Showing _START_ to _END_ of _TOTAL_ medicines",



zeroRecords:

"No matching medicine found",



emptyTable:

"No medicine records available",



paginate:{


previous:"← Previous",


next:"Next →"


}



}



});



});


</script>