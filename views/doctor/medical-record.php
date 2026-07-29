<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Electronic Medical Record - '.$patient->fullName;

?>

<div class="emr-container">

<!-- ================= HEADER ================= -->

<div class="emr-header">

<div>
<h1>
🩺 Electronic Medical Record (EMR)
</h1>

<p>
MYLES Health Analytics System |
Clinical Consultation Workspace
</p>

</div>


<div class="doctor-box">

<div>
👨‍⚕️ <b>Dr. Myles</b>
</div>

<span>
● Online Consultation
</span>

</div>


</div>



<!-- ================= PATIENT SUMMARY ================= -->


<div class="patient-summary">


<div class="patient-avatar">
👤
</div>


<div class="patient-details">

<h2>

<?=Html::encode($patient->fullName)?>

</h2>


<div class="patient-tags">

<span>
Patient ID #<?=$patient->id?>
</span>


<span>
🇹🇿 Tanzania
</span>


<span>
OPD Visit
</span>


<span class="active">
Active Consultation
</span>


</div>


</div>


<div class="visit-info">


<p>
Visit No:
<b>
<?=date('Ymd')?>-<?=$patient->id?>
</b>
</p>


<p>
Queue:
<b>
<?= $patient->queue_number ?? 'N/A' ?>
</b>
</p>


</div>


</div>





<?php $form = ActiveForm::begin([
'id'=>'consultation-form',
'enableClientValidation'=>true
]); ?>



<!-- ================= DEMOGRAPHICS ================= -->


<div class="card">


<h3>
👤 Patient Demographic Information
</h3>



<div class="grid">


<div>
<label>
Full Name
</label>

<input readonly
class="readonly"
value="<?=Html::encode($patient->fullName)?>">
</div>



<div>
<label>
Gender
</label>

<input readonly
class="readonly"
value="<?=$patient->gender?>">
</div>



<div>
<label>
Date Of Birth
</label>

<input readonly
class="readonly"
value="<?=$patient->dob?>">
</div>



<div>
<label>
Phone
</label>

<input readonly
class="readonly"
value="<?=$patient->phone?>">
</div>



<div>
<label>
NIDA Number
</label>

<input readonly
class="readonly"
value="<?=$patient->nida ?? 'Not Provided'?>">
</div>



<div>
<label>
Residence
</label>

<input readonly
class="readonly"
value="Tanzania">
</div>



</div>

</div>







<!-- ================= VITALS ================= -->


<div class="card">


<h3>
❤️ Vital Signs (Nurse Data)
</h3>


<div class="vital-grid">


<div class="vital">
🌡
<strong>
36.8°C
</strong>
<small>
Temperature
</small>
</div>



<div class="vital">
❤️
<strong>
120/80
</strong>

<small>
Blood Pressure
</small>

</div>



<div class="vital">
🫁
<strong>
98%
</strong>

<small>
SpO2
</small>

</div>



<div class="vital">

⚖

<strong>
70 Kg
</strong>

<small>
Weight
</small>

</div>


</div>


</div>







<!-- ================= CONSULTATION ================= -->


<div class="card">


<h3>
📝 Clinical Consultation
</h3>



<label>
Chief Complaint
</label>

<textarea
name="MedicalRecords[complaint]"
class="input"
placeholder="Main patient complaint">
</textarea>





<label>
History Of Present Illness
</label>

<textarea
name="MedicalRecords[history]"
class="input"
placeholder="
Symptoms duration,
severity,
progression,
previous treatment...
">
</textarea>





<label>
Review Of Systems
</label>


<textarea
name="MedicalRecords[system_review]"
class="input"
placeholder="
General,
Respiratory,
Cardiac,
GI,
Neurological...
">
</textarea>



</div>





<!-- ================= PHYSICAL EXAMINATION ================= -->


<div class="card">


<h3>
🩺 Physical Examination
</h3>



<div class="grid">


<div>

<label>
General Appearance
</label>

<textarea
name="MedicalRecords[general_exam]">
</textarea>

</div>



<div>

<label>
Chest Examination
</label>

<textarea
name="MedicalRecords[chest_exam]">
</textarea>

</div>



<div>

<label>
Cardiovascular
</label>

<textarea
name="MedicalRecords[cardio_exam]">
</textarea>

</div>



<div>

<label>
Abdomen
</label>

<textarea
name="MedicalRecords[abdomen_exam]">
</textarea>

</div>



</div>


</div>
<!-- ================= CLINICAL ASSESSMENT ================= -->


<div class="card">


<h3>
🧬 Clinical Assessment & Diagnosis
</h3>


<div class="grid">


<div>

<label>
Patient Condition
</label>


<select 
name="MedicalRecords[condition_status]"
class="input">


<option value="">
Select Condition
</option>


<option>
Stable
</option>


<option>
Moderate
</option>


<option>
Critical
</option>


</select>


</div>





<div>

<label>
Primary Diagnosis
</label>


<input 
type="text"
name="MedicalRecords[primary_diagnosis]"
class="input"
placeholder="Search diagnosis">


</div>





<div>

<label>
ICD-10 Code
</label>


<input 
type="text"
name="MedicalRecords[icd_code]"
class="input"
placeholder="Example: A09">


</div>




<div>

<label>
Secondary Diagnosis
</label>


<input
type="text"
name="MedicalRecords[secondary_diagnosis]"
class="input">


</div>



</div>




<label>
Doctor Assessment Notes
</label>


<textarea

name="MedicalRecords[assessment]"

class="input"

placeholder="
Clinical interpretation,
findings,
medical decision...
">

</textarea>


</div>









<!-- ================= LABORATORY REQUEST ================= -->


<div class="card">


<h3>
🧪 Laboratory Investigation
</h3>



<p class="info-text">

Select investigations required for this patient

</p>



<div class="lab-grid">


<label>
<input 
type="checkbox"
name="LabRequest[test][]"
value="Full Blood Count">

🩸 Full Blood Count

</label>



<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="Malaria">

🦟 Malaria Test

</label>




<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="Blood Sugar">

🍬 Blood Sugar

</label>




<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="Urinalysis">

🧪 Urinalysis

</label>




<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="HIV">

🧬 HIV Test

</label>




<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="Liver Function">

🫀 Liver Function Test

</label>




<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="Kidney Function">

🫘 Kidney Function

</label>




<label>

<input
type="checkbox"
name="LabRequest[test][]"
value="Pregnancy Test">

🤰 Pregnancy Test

</label>



</div>



<textarea

name="LabRequest[notes]"

class="input"

placeholder="
Laboratory instruction...
">

</textarea>


</div>









<!-- ================= RADIOLOGY ================= -->


<div class="card">


<h3>
🩻 Radiology Request
</h3>



<div class="grid">


<div>

<label>
Investigation Type
</label>


<select 
name="Radiology[type]"
class="input">


<option>
Select
</option>


<option>
X-Ray
</option>


<option>
Ultrasound
</option>


<option>
CT Scan
</option>


<option>
MRI
</option>


</select>


</div>



<div>


<label>
Clinical Reason
</label>


<input

name="Radiology[reason]"

class="input"

placeholder="Reason for imaging">


</div>



</div>



</div>









<!-- ================= TREATMENT PLAN ================= -->


<div class="card">


<h3>
💊 Treatment Plan
</h3>



<textarea

name="MedicalRecords[treatment_plan]"

class="input"

placeholder="
Medication plan,
clinical advice,
procedures,
patient education...
">

</textarea>



</div>









<!-- ================= PRESCRIPTION ================= -->


<div class="card">


<h3>
💊 Prescription Management
</h3>



<table class="medicine-table">


<thead>

<tr>

<th>
Medicine
</th>


<th>
Dose
</th>


<th>
Frequency
</th>


<th>
Duration
</th>


<th>
Route
</th>


<th>
Action
</th>


</tr>

</thead>



<tbody id="medicineRows">


<tr>


<td>


<select 
name="Prescription[medicine][]"
class="input">


<option>
Select Medicine
</option>


<option>
Paracetamol
</option>


<option>
Amoxicillin
</option>


<option>
Metronidazole
</option>


</select>


</td>




<td>

<input

name="Prescription[dose][]"

class="input"

placeholder="500mg">

</td>





<td>


<select

name="Prescription[frequency][]"

class="input">


<option>
Once Daily
</option>


<option>
Twice Daily
</option>


<option>
Three Times Daily
</option>


</select>


</td>





<td>


<input

name="Prescription[duration][]"

class="input"

placeholder="5 Days">


</td>





<td>


<select

name="Prescription[route][]"

class="input">


<option>
Oral
</option>


<option>
Injection
</option>


<option>
IV
</option>


</select>


</td>





<td>


<button

type="button"

class="remove-btn"

onclick="removeMedicine(this)">

✕


</button>


</td>



</tr>



</tbody>



</table>




<button

type="button"

class="add-btn"

onclick="addMedicine()">

+ Add Medicine

</button>




</div>









<!-- ================= FOLLOW UP ================= -->


<div class="card">


<h3>
📅 Follow Up & Clinical Decision
</h3>




<div class="grid">



<div>

<label>
Clinical Decision
</label>


<select

name="MedicalRecords[decision]"

class="input">


<option>
Select
</option>


<option>
Discharge
</option>


<option>
Admit Patient
</option>


<option>
Refer Patient
</option>


<option>
Observation
</option>


<option>
Review Later
</option>


</select>


</div>




<div>

<label>
Next Review Date
</label>


<input

type="date"

name="MedicalRecords[follow_up_date]"

class="input">


</div>



</div>




<textarea

name="MedicalRecords[follow_up_notes]"

class="input"

placeholder="
Follow up instructions,
patient advice...
">

</textarea>



</div>
<?php ActiveForm::end(); ?>


<!-- ================= ACTION BAR ================= -->


<div class="action-bar">


<button 
type="button"
class="btn-save"
onclick="saveDraft()">

💾 Save Draft

</button>




<button

type="button"

class="btn-lab"

onclick="sendLab()">

🧪 Send Laboratory

</button>





<button

type="button"

class="btn-radio">

🩻 Radiology

</button>





<button

type="button"

class="btn-pharmacy"

onclick="sendPharmacy()">

💊 Send Pharmacy

</button>





<button

type="button"

class="btn-admit">

🏥 Admit Patient

</button>





<button

type="button"

class="btn-complete">

✅ Complete Consultation

</button>



</div>





</div>






<style>


/* ===============================
   ADVANCED EMR DESIGN
================================ */


body{

background:#f1f8f6;

}



.emr-container{

padding:25px;

font-family:
'Inter',
'Segoe UI',
sans-serif;

background:#f1f8f6;

min-height:100vh;

}



/* HEADER */


.emr-header{

background:white;

border-radius:30px;

padding:30px;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:
0 20px 50px rgba(0,0,0,.08);

}



.emr-header h1{

color:#047857;

font-size:32px;

font-weight:900;

margin:0;

}



.emr-header p{

color:#64748b;

}



.doctor-box{

background:#ecfdf5;

padding:20px 30px;

border-radius:25px;

}



.doctor-box span{

color:#16a34a;

font-weight:800;

}





/* PATIENT */


.patient-summary{


background:white;

margin-top:25px;

padding:25px;

border-radius:30px;

display:flex;

align-items:center;

gap:25px;

box-shadow:
0 15px 40px rgba(0,0,0,.08);

}



.patient-avatar{

font-size:60px;

}



.patient-details h2{

margin:0;

color:#065f46;

}



.patient-tags span{

display:inline-block;

background:#dcfce7;

padding:8px 15px;

border-radius:20px;

margin:5px;

font-size:13px;

font-weight:700;

}



.patient-tags .active{

background:#bbf7d0;

color:#166534;

}





.visit-info{

margin-left:auto;

color:#475569;

}







/* CARDS */


.card{


background:white;

margin-top:25px;

padding:30px;

border-radius:30px;


box-shadow:

0 20px 45px rgba(0,0,0,.08);

}



.card h3{

color:#065f46;

font-weight:900;

margin-bottom:25px;

}





/* GRID */


.grid{


display:grid;

grid-template-columns:
repeat(3,1fr);

gap:20px;

}





label{

display:block;

font-size:13px;

font-weight:700;

color:#64748b;

margin-bottom:8px;

}




.input,
textarea,
select{


width:100%;

padding:14px;

border-radius:15px;

border:1px solid #d1d5db;

font-size:14px;

}



textarea{

min-height:120px;

resize:vertical;

}



.readonly{

background:#f8fafc;

}





/* VITALS */


.vital-grid{


display:grid;

grid-template-columns:
repeat(4,1fr);

gap:20px;

}



.vital{


background:#ecfdf5;

padding:25px;

border-radius:25px;

text-align:center;

}



.vital strong{

display:block;

font-size:25px;

color:#047857;

}



.vital small{

color:#64748b;

}





/* LAB */


.lab-grid{


display:grid;

grid-template-columns:
repeat(4,1fr);

gap:15px;

}



.lab-grid label{


background:#f0fdfa;

padding:15px;

border-radius:15px;

cursor:pointer;

}





/* TABLE */


.medicine-table{


width:100%;

border-collapse:collapse;

}



.medicine-table th{


background:#ecfdf5;

padding:15px;

}



.medicine-table td{


padding:12px;

border-bottom:1px solid #e5e7eb;

}





.add-btn{


margin-top:20px;

background:#0f766e;

color:white;

border:none;

padding:12px 25px;

border-radius:20px;

}



.remove-btn{


background:#fee2e2;

color:#dc2626;

border:none;

border-radius:50%;

width:35px;

height:35px;

}





/* ACTION BAR */


.action-bar{


position:sticky;

bottom:15px;

background:white;

padding:20px;

border-radius:30px;

display:flex;

justify-content:center;

gap:15px;

margin-top:35px;

box-shadow:

0 20px 50px rgba(0,0,0,.15);

z-index:100;

}




.action-bar button{


border:none;

padding:15px 25px;

border-radius:20px;

font-weight:800;

cursor:pointer;

color:white;

transition:.3s;

}



.action-bar button:hover{

transform:
translateY(-5px);

}




.btn-save{

background:#2563eb;

}


.btn-lab{

background:#ea580c;

}



.btn-radio{

background:#7c3aed;

}



.btn-pharmacy{

background:#16a34a;

}



.btn-admit{

background:#0891b2;

}



.btn-complete{

background:#dc2626;

}





@media(max-width:1000px){


.grid,
.vital-grid,
.lab-grid{


grid-template-columns:1fr;

}



.action-bar{

flex-wrap:wrap;

}


}


</style>







<script>


// ============================
// ADD MEDICINE
// ============================


function addMedicine(){


let row = `

<tr>


<td>

<select name="Prescription[medicine][]" class="input">

<option>Select Medicine</option>

<option>Paracetamol</option>

<option>Amoxicillin</option>

<option>Ceftriaxone</option>

</select>

</td>


<td>

<input 
name="Prescription[dose][]"
class="input">

</td>


<td>

<select name="Prescription[frequency][]" class="input">

<option>Once Daily</option>

<option>Twice Daily</option>

<option>Three Times Daily</option>

</select>

</td>


<td>

<input 
name="Prescription[duration][]"
class="input">

</td>


<td>

<select name="Prescription[route][]" class="input">

<option>Oral</option>

<option>IV</option>

<option>Injection</option>

</select>


</td>


<td>

<button 
type="button"
class="remove-btn"
onclick="removeMedicine(this)">
✕
</button>

</td>


</tr>


`;


document
.getElementById("medicineRows")
.insertAdjacentHTML(
"beforeend",
row
);


}




function removeMedicine(btn){

btn.closest("tr").remove();

}





// ============================
// SAVE DRAFT
// ============================


function saveDraft(){


alert(
"Clinical record saved successfully"
);


}





// ============================
// SEND LAB
// ============================


function sendLab(){


alert(
"Laboratory request sent successfully"
);


}





// ============================
// SEND PHARMACY
// ============================


function sendPharmacy(){


alert(
"Prescription sent to Pharmacy"
);


}



</script>