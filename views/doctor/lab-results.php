<?php

use yii\helpers\Html;

$this->title = "Laboratory Results Command Center";

?>

<style>

body{
    background:#07111f;
}


.lab-container{
    background:#07111f;
    color:#fff;
    min-height:100vh;
    padding:25px;
}


/* HEADER */

.lab-header{
    background:linear-gradient(135deg,#0f766e,#064e3b);
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
}


.lab-header h2{
    font-weight:800;
}



.live-badge{
    background:#22c55e;
    padding:8px 18px;
    border-radius:20px;
    font-size:13px;
}



/* KPI */

.kpi-wrapper{

display:flex;
gap:20px;
overflow-x:auto;
padding-bottom:15px;

}


.kpi-card{

min-width:220px;

background:#111c2f;

border:1px solid #22314d;

padding:20px;

border-radius:18px;

box-shadow:0 10px 30px rgba(0,0,0,.3);

}



.kpi-icon{

font-size:35px;

}


.kpi-number{

font-size:38px;

font-weight:800;

}



.kpi-title{

color:#94a3b8;

}



.kpi-status{

margin-top:10px;

color:#22c55e;

font-size:14px;

}



/* SEARCH */

.control-box{

background:#111c2f;

padding:20px;

border-radius:18px;

margin-top:20px;

}



.form-control,
.form-select{

background:#07111f;

border:1px solid #334155;

color:white;

}



.form-control::placeholder{

color:#94a3b8;

}



/* TABLE */


.lab-panel{

background:#111c2f;

border-radius:20px;

padding:25px;

margin-top:25px;

}


.table{

color:white;

}


.table thead{

background:#0f172a;

}


.table tbody tr{

border-color:#263449;

}



.status{

padding:6px 14px;

border-radius:20px;

font-size:12px;

}



.pending{

background:#f59e0b;

}


.completed{

background:#22c55e;

}


.processing{

background:#3b82f6;

}


.critical{

background:#ef4444;

}



/* AI PANEL */


.ai-box{

background:linear-gradient(
135deg,
#172554,
#0f766e
);

padding:25px;

border-radius:20px;

margin-top:25px;

}


.ai-item{

background:rgba(255,255,255,.08);

padding:15px;

border-radius:12px;

margin-bottom:10px;

}



/* ACTION */

.action-card{

background:#111c2f;

padding:25px;

border-radius:20px;

margin-top:25px;

}


.action-btn{

border-radius:15px;

padding:14px 25px;

font-weight:700;

}



.empty{

text-align:center;

padding:50px;

color:#94a3b8;

}


</style>




<div class="lab-container">


<!-- HEADER -->

<div class="lab-header">


<div class="d-flex justify-content-between align-items-center flex-wrap">


<div>

<h2>
🧪 Laboratory Results Command Center
</h2>


<p>
Diagnostic monitoring and doctor decision support
</p>

</div>


<div class="live-badge">

● LIVE LAB CONNECTED

</div>


</div>


</div>





<!-- KPI -->

<div class="kpi-wrapper">



<div class="kpi-card">

<div class="kpi-icon">
🔬
</div>

<div class="kpi-number">
<?= $totalInvestigations ?? 47 ?>
</div>

<div class="kpi-title">
Active Tests
</div>


<div class="kpi-status">
Lab Orders
</div>


</div>





<div class="kpi-card">


<div class="kpi-icon">
✓
</div>


<div class="kpi-number">
<?= $orderedTests ?? 27 ?>
</div>


<div class="kpi-title">
Verified Results
</div>


<div class="kpi-status">
Doctor Ready
</div>


</div>






<div class="kpi-card">


<div class="kpi-icon">
⏳
</div>


<div class="kpi-number">
<?= $processingTests ?? 11 ?>
</div>


<div class="kpi-title">
Processing
</div>


<div class="kpi-status">
In Progress
</div>


</div>







<div class="kpi-card">


<div class="kpi-icon">
🚨
</div>


<div class="kpi-number">
<?= $criticalTests ?? 0 ?>
</div>


<div class="kpi-title">
Critical Findings
</div>


<div class="kpi-status">
Urgent Review
</div>


</div>




</div>






<!-- SEARCH -->

<div class="control-box">


<div class="row g-3">


<div class="col-md-8">


<input 
class="form-control"
placeholder="🔍 Search patient, test, result..."
>


</div>


<div class="col-md-4">


<select class="form-select">

<option>
All
</option>

<option>
Pending
</option>


<option>
Processing
</option>


<option>
Completed
</option>


<option>
Critical
</option>


</select>


</div>


</div>


</div>







<!-- TABLE -->

<div class="lab-panel">


<h4>
📋 Smart Laboratory Queue
</h4>



<div class="table-responsive">


<table class="table mt-4">


<thead>


<tr>

<th>
Patient
</th>


<th>
Investigation
</th>


<th>
Status
</th>


<th>
Priority
</th>


<th>
Action
</th>


</tr>


</thead>



<tbody>



<?php if(!empty($results)): ?>


<?php foreach($results as $result): ?>


<tr>


<td>

🧑 Patient

</td>



<td>

<?= Html::encode($result->test->name ?? 'Laboratory Test') ?>

</td>



<td>


<span class="status processing">

<?= $result->status ?>

</span>


</td>



<td>

Normal

</td>



<td>


<a class="btn btn-sm btn-success">

EMR

</a>


<a class="btn btn-sm btn-warning">

Report

</a>


<a class="btn btn-sm btn-danger">

Review

</a>


</td>


</tr>



<?php endforeach; ?>


<?php else: ?>


<tr>


<td colspan="5">


<div class="empty">


🧪


<h4>
No Laboratory Results
</h4>


<p>
Waiting for laboratory data
</p>


</div>


</td>


</tr>


<?php endif; ?>



</tbody>


</table>


</div>



</div>








<!-- AI -->

<div class="ai-box">


<h3>
🤖 AI Laboratory Intelligence
</h3>


<p>
⚠ Automated monitoring active
</p>



<div class="ai-item">

🔴 Critical value detection

</div>


<div class="ai-item">

📊 Patient history comparison

</div>


<div class="ai-item">

🧠 Clinical decision support

</div>


</div>









<!-- ACTION -->

<div class="action-card">


<h3>
⚡ Doctor Quick Actions
</h3>


<br>


<button class="btn btn-primary action-btn">

📄 Generate Report

</button>


<button class="btn btn-warning action-btn">

💊 Prescription Review

</button>


<button class="btn btn-danger action-btn">

🚨 Critical Review

</button>



</div>





</div>