<?php

use yii\helpers\Html;

$this->title = "User Profile";

?>


<div class="container-fluid">


<!-- PROFILE HEADER -->

<div class="card shadow-lg border-0 mb-4"
style="
border-radius:18px;
background:linear-gradient(135deg,#0f766e,#22c55e);
color:white;
">


<div class="card-body">


<div class="row align-items-center">


<div class="col-md-8">


<div class="d-flex align-items-center">


<div style="
width:90px;
height:90px;
border-radius:50%;
background:white;
color:#0f766e;
display:flex;
align-items:center;
justify-content:center;
font-size:45px;
">

👤

</div>


<div class="ms-4">


<h2>
<?= Html::encode($model->full_name) ?>
</h2>


<h5>
<?= Html::encode($model->roleName) ?>
</h5>


<span class="badge bg-light text-success">
🟢 Active User
</span>


</div>


</div>


</div>


<div class="col-md-4 text-end">


<button class="btn btn-light">

✏️ Edit Profile

</button>


</div>


</div>


</div>


</div>





<!-- ROLE INFORMATION TABLE -->


<div class="card shadow border-0 mb-4">


<div class="card-header"
style="
background:#f0fdfa;
color:#0f766e;
font-weight:bold;
">

👨‍⚕️ Professional Information

</div>


<div class="card-body p-0">


<table class="table table-hover mb-0">


<tr>

<th>
👨‍⚕️ Role
</th>

<td>
<span class="badge bg-primary">
Doctor
</span>
</td>

</tr>



<tr>

<th>
🏥 Department
</th>

<td>
Clinical Services
</td>


</tr>



<tr>

<th>
🔐 Access Level
</th>

<td>
Doctor
</td>


</tr>


</table>


</div>

</div>







<!-- ACCOUNT + PERMISSIONS HORIZONTAL -->


<div class="row">



<div class="col-md-6">


<div class="card shadow border-0">


<div class="card-header"
style="background:#eff6ff;color:#2563eb">

👤 Account Information

</div>



<div class="card-body p-0">


<table class="table table-striped mb-0">


<tr>
<th>🆔 User ID</th>
<td>#<?= $model->id ?></td>
</tr>


<tr>
<th>👤 Username</th>
<td><?= Html::encode($model->username) ?></td>
</tr>


<tr>
<th>📧 Email</th>
<td><?= Html::encode($model->email) ?></td>
</tr>


<tr>
<th>🏥 Status</th>
<td>

<span class="badge bg-success">
Active
</span>

</td>
</tr>


</table>


</div>


</div>


</div>







<div class="col-md-6">


<div class="card shadow border-0">


<div class="card-header"
style="background:#fef3c7;color:#92400e">

🔐 Permissions

</div>



<div class="card-body">


<table class="table">


<tr>
<td>
Doctor Dashboard
</td>

<td>
<span class="badge bg-success">
Enabled
</span>
</td>

</tr>



<tr>
<td>
Patient Records
</td>

<td>
<span class="badge bg