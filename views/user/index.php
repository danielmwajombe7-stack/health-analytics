<?php

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = "Users Management";

$users = $dataProvider->getModels();

?>


<style>

.user-page{

padding:25px;
font-family:'Inter','Segoe UI',sans-serif;

}


/* HEADER */

.user-header{

background:
linear-gradient(
135deg,
#0f766e,
#14b8a6
);

padding:35px;

border-radius:28px;

color:white;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:
0 20px 45px rgba(0,0,0,.15);

}


.user-header h1{

font-size:34px;

font-weight:900;

margin:0;

}


.user-header p{

color:#ccfbf1;

}




.add-user{

background:white;

color:#0f766e!important;

padding:14px 25px;

border-radius:18px;

font-weight:900;

text-decoration:none;

}



/* CARDS */

.stats{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(200px,1fr));

gap:20px;

margin-top:30px;

}



.stat-card{

background:white;

padding:25px;

border-radius:22px;

box-shadow:
0 15px 35px rgba(0,0,0,.08);

}


.stat-icon{

font-size:35px;

}



.stat-number{

font-size:32px;

font-weight:900;

color:#0f766e;

}




/* TABLE */

.user-box{

margin-top:30px;

background:white;

padding:25px;

border-radius:25px;

box-shadow:
0 15px 40px rgba(0,0,0,.08);

}



.user-table{

width:100%;

border-collapse:separate;

border-spacing:0 12px;

}



.user-table th{

padding:16px;

background:#ecfdf5;

color:#065f46;

}



.user-table td{

padding:18px;

background:white;

box-shadow:
0 5px 15px rgba(0,0,0,.05);

}




.avatar{

width:45px;

height:45px;

border-radius:50%;

background:#ccfbf1;

display:flex;

align-items:center;

justify-content:center;

font-size:22px;

}



.role{

background:#dbeafe;

color:#1e40af;

padding:7px 15px;

border-radius:20px;

font-size:12px;

font-weight:800;

}



.active{

background:#dcfce7;

color:#166534;

padding:7px 15px;

border-radius:20px;

font-weight:800;

font-size:12px;

}



.inactive{

background:#fee2e2;

color:#991b1b;

padding:7px 15px;

border-radius:20px;

font-weight:800;

font-size:12px;

}


.action-btn{

border-radius:12px!important;

font-weight:700;

}


</style>





<div class="user-page">





<div class="user-header">


<div>

<h1>

👤 Users Management

</h1>


<p>

Manage hospital employees, permissions and system access.

</p>


</div>



<?= Html::a(

'➕ Add New User',

['create'],

[
'class'=>'add-user'
]

) ?>


</div>







<div class="stats">



<div class="stat-card">

<div class="stat-icon">
👥
</div>

<div class="stat-number">

<?= $totalUsers ?>

</div>

<p>
Total Users
</p>


</div>





<div class="stat-card">

<div class="stat-icon">
🟢
</div>


<div class="stat-number">

<?= $activeUsers ?>

</div>


<p>
Active Users
</p>


</div>






<div class="stat-card">

<div class="stat-icon">
👨‍⚕️
</div>


<div class="stat-number">

<?= $doctorCount ?>

</div>


<p>
Doctors
</p>


</div>






<div class="stat-card">

<div class="stat-icon">
👩‍⚕️
</div>


<div class="stat-number">

<?= $nurseCount ?>

</div>


<p>
Nurses
</p>


</div>





<div class="stat-card">

<div class="stat-icon">
🛡
</div>


<div class="stat-number">

<?= $adminCount ?>

</div>


<p>
Administrators
</p>


</div>




</div>









<div class="user-box">


<h3>
🏥 Hospital System Users
</h3>


<p class="text-muted">

Registered staff accounts.

</p>






<table class="user-table">


<thead>

<tr>

<th>ID</th>

<th>User</th>

<th>Email</th>

<th>Role</th>

<th>Status</th>

<th>Action</th>

</tr>


</thead>



<tbody>



<?php foreach($users as $user): ?>


<tr>


<td>

<?= $user->id ?>

</td>




<td>


<div style="display:flex;align-items:center;gap:12px">


<div class="avatar">

👤

</div>


<div>

<strong>

<?= Html::encode($user->username) ?>

</strong>


<br>

<small>

<?= Html::encode($user->full_name ?? '') ?>

</small>


</div>


</div>


</td>






<td>

<?= Html::encode($user->email ?? '-') ?>

</td>






<td>


<span class="role">

<?=

$user->role

?

Html::encode($user->role->role_name)

:

'No Role'

?>


</span>


</td>






<td>


<?php if(($user->status ?? 1)==1): ?>


<span class="active">

🟢 Active

</span>


<?php else: ?>


<span class="inactive">

🔴 Disabled

</span>


<?php endif; ?>


</td>






<td>


<?= Html::a(

'👁',

['view','id'=>$user->id],

[
'class'=>'btn btn-success btn-sm action-btn'
]

) ?>



<?= Html::a(

'✏',

['update','id'=>$user->id],

[
'class'=>'btn btn-primary btn-sm action-btn'
]

) ?>



<?= Html::a(

'🗑',

['delete','id'=>$user->id],

[
'class'=>'btn btn-danger btn-sm action-btn',
'data'=>[
'confirm'=>'Delete this user?'
]
]

) ?>


</td>



</tr>


<?php endforeach; ?>



</tbody>



</table>





<div class="mt-4">


<?= LinkPager::widget([

'pagination'=>$dataProvider->pagination

]) ?>


</div>




</div>




</div>