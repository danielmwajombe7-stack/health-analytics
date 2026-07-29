<?php

$this->title = "AI Risk Intelligence Center";

?>

<style>


.ai-page{

background:#06111f;

min-height:100vh;

padding:25px;

color:#fff;

}



/* GLOBAL CARD */

.ai-panel{

background:
rgba(255,255,255,0.06);

border:1px solid rgba(255,255,255,.12);

border-radius:24px;

padding:25px;

box-shadow:
0 15px 40px rgba(0,0,0,.35);

backdrop-filter:blur(15px);

}



/* HEADER */


.ai-header{

background:
linear-gradient(135deg,#064e3b,#0f766e,#22c55e);

border-radius:25px;

padding:35px;

margin-bottom:30px;

}



.ai-header h1{

font-size:35px;

font-weight:800;

}



.ai-header p{

color:#d1fae5;

font-size:17px;

}




/* STAT CARDS */


.stat-card{

height:180px;

display:flex;

justify-content:space-between;

align-items:center;

}



.stat-title{

color:#94a3b8;

font-size:14px;

}



.stat-value{

font-size:40px;

font-weight:800;

margin-top:10px;

}



.stat-icon{

font-size:55px;

}




/* COLORS */


.green{

color:#4ade80;

}


.red{

color:#f87171;

}


.orange{

color:#fbbf24;

}


.blue{

color:#38bdf8;

}




.section-title{

font-size:22px;

font-weight:700;

margin-bottom:20px;

}




.table-ai{

color:white;

}


.table-ai thead{

background:#0f766e;

}


.table-ai tbody tr{

border-bottom:1px solid rgba(255,255,255,.1);

}


.table-ai td,
.table-ai th{

padding:18px;

}





.badge-risk{

padding:8px 15px;

border-radius:20px;

}



.high{

background:#450a0a;

color:#fca5a5;

}



.medium{

background:#451a03;

color:#fed7aa;

}



.low{

background:#052e16;

color:#86efac;

}



</style>






<div class="ai-page">





<!-- HEADER -->

<div class="ai-header">


<div class="d-flex justify-content-between align-items-center">


<div>


<h1>

🤖 AI RISK INTELLIGENCE CENTER

</h1>


<p>

MHAS Smart Hospital Clinical Decision Support System

</p>


</div>



<div>


<span class="badge bg-success p-3 rounded-pill">

🟢 AI ENGINE ONLINE

</span>


</div>


</div>


</div>







<!-- PATIENT OVERVIEW -->


<div class="section-title">

📊 Patient Risk Overview

</div>


<div class="row g-4 mb-5">



<div class="col-lg-3 col-md-6">


<div class="ai-panel stat-card">


<div>


<div class="stat-title">

TOTAL ANALYZED PATIENTS

</div>


<div class="stat-value blue">

0

</div>


<small>

AI monitored records

</small>


</div>


<div class="stat-icon">

🧠

</div>


</div>


</div>







<div class="col-lg-3 col-md-6">


<div class="ai-panel stat-card">


<div>


<div class="stat-title">

HIGH RISK PATIENTS

</div>


<div class="stat-value red">

0

</div>


<small>

Immediate doctor review

</small>


</div>


<div class="stat-icon">

🚨

</div>


</div>


</div>







<div class="col-lg-3 col-md-6">


<div class="ai-panel stat-card">


<div>


<div class="stat-title">

MEDIUM RISK

</div>


<div class="stat-value orange">

0

</div>


<small>

Requires monitoring

</small>


</div>


<div class="stat-icon">

⚠️

</div>


</div>


</div>







<div class="col-lg-3 col-md-6">


<div class="ai-panel stat-card">


<div>


<div class="stat-title">

STABLE PATIENTS

</div>


<div class="stat-value green">

0

</div>


<small>

Normal condition

</small>


</div>


<div class="stat-icon">

✅

</div>


</div>


</div>




</div>









<!-- AI ENGINE -->


<div class="row g-4 mb-5">



<div class="col-lg-5">


<div class="ai-panel">


<div class="section-title">

🧠 AI Engine Performance

</div>



<div class="mb-4">


<p>

Model Status

</p>


<h5 class="green">

● Active

</h5>


</div>



<div class="mb-4">


<p>

Prediction Accuracy

</p>


<h2>

94.8%

</h2>


<div class="progress">

<div class="progress-bar bg-success"

style="width:94%">

</div>


</div>


</div>





<h6>

Analyzed Factors

</h6>


<ul>


<li>Vital Signs</li>

<li>Laboratory Results</li>

<li>Diagnosis History</li>

<li>Medical Records</li>

<li>Prescription History</li>


</ul>



</div>


</div>









<!-- ALERT -->

<div class="col-lg-7">


<div class="ai-panel">


<div class="section-title">

🚨 Risk Alert Monitoring

</div>



<div class="text-center p-5">


<div style="font-size:70px">

🛡️

</div>


<h4>

No Critical Patient Alert

</h4>


<p class="text-secondary">

AI system is monitoring patient records continuously.

</p>


</div>



</div>


</div>



</div>









<!-- TABLE -->


<div class="ai-panel mb-5">


<div class="section-title">

📋 Patient Risk Analysis

</div>



<div class="table-responsive">


<table class="table table-ai">


<thead>


<tr>

<th>Patient</th>

<th>Age</th>

<th>Department</th>

<th>Diagnosis</th>

<th>Risk</th>

<th>AI Confidence</th>

<th>Recommendation</th>


</tr>


</thead>



<tbody>


<tr>


<td colspan="7"
class="text-center p-5">


🤖

<h5>

No AI Prediction Available

</h5>


<p>

Patient data will appear after AI model integration.

</p>


</td>


</tr>


</tbody>


</table>


</div>


</div>









<!-- RECOMMENDATIONS -->


<div class="row g-4">



<div class="col-lg-6">


<div class="ai-panel">


<div class="section-title">

💡 AI Clinical Recommendations

</div>


<ul>


<li>
Review abnormal vital signs
</li>


<li>
Analyze laboratory changes
</li>


<li>
Monitor disease progression
</li>


<li>
Recommend clinical actions
</li>


</ul>


</div>


</div>








<div class="col-lg-6">


<div class="ai-panel">


<div class="section-title">

⚙️ System Information

</div>


<p>
AI Model: Machine Learning Risk Predictor
</p>


<p>
Platform: MHAS Smart Hospital
</p>


<p>
Status: Ready For Data Integration
</p>


</div>


</div>



</div>






</div>