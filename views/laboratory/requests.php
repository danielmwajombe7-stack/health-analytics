<?php


use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = "Laboratory Requests";



$models = $dataProvider->getModels();



?>



<style>


.lab-page{


    background:#f4f8fb;

    min-height:100vh;

    padding:30px;

    font-family:'Inter',Arial,sans-serif;


}




.lab-header{


    background:white;

    padding:30px;

    border-radius:25px;

    box-shadow:0 12px 30px rgba(0,0,0,.08);

    margin-bottom:25px;


}




.lab-header h1{


    margin:0;

    font-size:32px;

    color:#00695c;

    font-weight:800;


}




.lab-header p{


    margin-top:10px;

    color:#607d8b;

    font-size:15px;


}





/*
|--------------------------------------------------------------------------
| STATISTICS CARDS
|--------------------------------------------------------------------------
*/


.lab-stat-grid{


    display:grid;

    grid-template-columns:repeat(5,1fr);

    gap:20px;

    margin-bottom:30px;


}





.lab-stat-card{


    background:white;

    padding:25px;

    border-radius:22px;

    box-shadow:0 10px 25px rgba(0,0,0,.07);

    position:relative;

    overflow:hidden;


}




.lab-stat-card:hover{


    transform:translateY(-5px);

    transition:.3s;


}




.stat-icon{


    font-size:35px;

    margin-bottom:15px;


}





.stat-number{


    font-size:35px;

    font-weight:900;

    color:#00695c;


}




.stat-label{


    color:#78909c;

    font-size:14px;


}





/*
|--------------------------------------------------------------------------
| SEARCH SECTION
|--------------------------------------------------------------------------
*/


.search-box{


    background:white;

    padding:25px;

    border-radius:22px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    margin-bottom:25px;


}





.search-grid{


    display:grid;

    grid-template-columns:2fr 1fr 1fr auto;

    gap:15px;


}




.form-control{


    width:100%;

    padding:14px;

    border-radius:14px;

    border:1px solid #ddd;

    font-size:14px;


}




.search-btn{


    background:#00695c;

    color:white;

    padding:14px 25px;

    border-radius:14px;

    border:none;

    cursor:pointer;

    text-decoration:none;


}




.reset-btn{


    background:#eceff1;

    color:#37474f;

    padding:14px 20px;

    border-radius:14px;

    text-decoration:none;


}





@media(max-width:1100px){


.lab-stat-grid{

grid-template-columns:repeat(2,1fr);

}



.search-grid{


grid-template-columns:1fr;


}


}



</style>







<div class="lab-page">






<div class="lab-header">


<h1>
🧪 Laboratory Requests Management
</h1>


<p>
Manage patient investigations, laboratory workflow, and test results.
</p>



</div>









<div class="lab-stat-grid">






<div class="lab-stat-card">


<div class="stat-icon">
🧪
</div>


<div class="stat-number">

<?= $dataProvider->getTotalCount() ?>

</div>


<div class="stat-label">
Total Requests
</div>


</div>









<div class="lab-stat-card">


<div class="stat-icon">
⏳
</div>


<div class="stat-number">


<?= \app\models\LabRequest::find()

->where([

'status'=>'Pending'

])

->count();

?>


</div>


<div class="stat-label">
Pending Tests
</div>


</div>









<div class="lab-stat-card">


<div class="stat-icon">
🔬
</div>


<div class="stat-number">


<?= \app\models\LabRequest::find()

->where([

'status'=>'Processing'

])

->count();

?>


</div>


<div class="stat-label">
Processing
</div>


</div>









<div class="lab-stat-card">


<div class="stat-icon">
✅
</div>


<div class="stat-number">


<?= \app\models\LabRequest::find()

->where([

'status'=>'Completed'

])

->count();

?>


</div>


<div class="stat-label">
Completed
</div>


</div>









<div class="lab-stat-card">


<div class="stat-icon">
📅
</div>


<div class="stat-number">


<?= \app\models\LabRequest::find()

->where([

'between',

'created_at',

date('Y-m-d 00:00:00'),

date('Y-m-d 23:59:59')

])

->count();

?>


</div>


<div class="stat-label">
Today's Requests
</div>


</div>






</div>





<!-- SEARCH SECTION START -->

<div class="search-box">


<form method="get">


<div class="search-grid">



<input

type="text"

name="search"

class="form-control"

placeholder="🔍 Search patient, test name..."

value="<?= Html::encode(Yii::$app->request->get('search')) ?>"

>




<select name="status" class="form-control">


<option value="">
All Status
</option>


<option value="Pending">
Pending
</option>


<option value="Processing">
Processing
</option>


<option value="Completed">
Completed
</option>


</select>





<input

type="date"

name="date"

class="form-control"

value="<?= Html::encode(Yii::$app->request->get('date')) ?>"

>




<button class="search-btn">

Search

</button>



<a href="<?= Url::to(['requests']) ?>" class="reset-btn">

Reset

</a>



</div>



</form>



</div>
<!-- 
|--------------------------------------------------------------------------
| REQUEST TABLE
|--------------------------------------------------------------------------
-->


<style>



.table-container{


    background:white;

    padding:25px;

    border-radius:25px;

    box-shadow:0 10px 30px rgba(0,0,0,.08);


}




.table-header{


    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:20px;


}



.table-header h2{


    color:#00695c;

    font-size:22px;

    margin:0;


}





.lab-table{


    width:100%;

    border-collapse:collapse;


}





.lab-table thead th{


    background:#00695c;

    color:white;

    padding:16px;

    text-align:left;

    font-size:14px;


}





.lab-table tbody td{


    padding:16px;

    border-bottom:1px solid #eeeeee;

    vertical-align:middle;


}




.lab-table tbody tr:hover{


    background:#f1f8f7;

    transition:.2s;


}





.patient-box{


    display:flex;

    align-items:center;

    gap:12px;


}




.patient-avatar{


    width:45px;

    height:45px;

    border-radius:50%;

    background:#e0f2f1;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:22px;


}





.patient-name{


    font-weight:700;

    color:#263238;


}



.small-text{


    color:#78909c;

    font-size:13px;


}





.test-name{


    font-weight:700;

    color:#37474f;


}





.doctor-name{


    color:#00695c;

    font-weight:600;


}






.badge{


    padding:8px 15px;

    border-radius:20px;

    font-size:12px;

    font-weight:700;

    display:inline-block;


}





.badge-pending{


    background:#fff3e0;

    color:#ef6c00;


}




.badge-processing{


    background:#e3f2fd;

    color:#1565c0;


}




.badge-completed{


    background:#e8f5e9;

    color:#2e7d32;


}





.priority-normal{


    background:#e0f2f1;

    color:#00695c;


}



.priority-urgent{


    background:#ffebee;

    color:#c62828;


}





.action-group{


    display:flex;

    gap:8px;

    flex-wrap:wrap;


}





.action-btn{


    padding:9px 14px;

    border-radius:12px;

    color:white;

    text-decoration:none;

    font-size:13px;

    font-weight:600;


}




.btn-start{


    background:#0288d1;


}



.btn-result{


    background:#ff9800;


}



.btn-view{


    background:#546e7a;


}




.btn-delete{


    background:#d32f2f;


}







.empty-row{


    text-align:center;

    padding:40px;

    color:#78909c;


}





@media(max-width:900px){


.table-container{


overflow-x:auto;


}


.lab-table{


min-width:1000px;


}


}




</style>








<div class="table-container">






<div class="table-header">


<h2>

🧪 Laboratory Investigation Queue

</h2>


<div>

<?= count($models) ?> Records

</div>


</div>









<table class="lab-table">


<thead>


<tr>


<th>
Patient
</th>


<th>
Laboratory Test
</th>


<th>
Doctor
</th>


<th>
Priority
</th>


<th>
Request Date
</th>


<th>
Status
</th>


<th>
Actions
</th>


</tr>


</thead>







<tbody>



<?php if(empty($models)): ?>


<tr>

<td colspan="7" class="empty-row">

No laboratory requests found

</td>

</tr>



<?php endif; ?>








<?php foreach($models as $request): ?>



<tr>






<td>


<div class="patient-box">


<div class="patient-avatar">

👤

</div>




<div>


<div class="patient-name">


<?= Html::encode(

$request->patient->fullName 
?? 
(
($request->patient->first_name ?? '')
.' '.
($request->patient->last_name ?? '')

)

)

?>


</div>




<div class="small-text">


Patient ID:

<?= Html::encode(

$request->patient_id

) ?>


</div>


</div>


</div>


</td>









<td>


<div class="test-name">


🧪

<?= Html::encode(

$request->test_name 
?? 
'Laboratory Test'

)

?>


</div>


</td>









<td>


<div class="doctor-name">


👨‍⚕️


<?= Html::encode(

$request->doctor->username 
?? 
'Not Assigned'

)

?>


</div>


</td>









<td>



<?php


$priority =
$request->hasAttribute('priority')

?
$request->priority

:

'Normal';


?>



<?php if($priority=="Urgent"): ?>


<span class="badge priority-urgent">

🚨 Urgent

</span>



<?php else: ?>


<span class="badge priority-normal">

🟢 Normal

</span>



<?php endif; ?>



</td>









<td>


<?= Html::encode(

$request->created_at 
?? 
$request->request_date 
?? 
'-'

)

?>


</td>







<td>





<?php if($request->status=="Pending"): ?>


<span class="badge badge-pending">

⏳ Pending

</span>






<?php elseif($request->status=="Processing"): ?>


<span class="badge badge-processing">

🔬 Processing

</span>






<?php else: ?>


<span class="badge badge-completed">

✅ Completed

</span>




<?php endif; ?>



</td>
<!--
|--------------------------------------------------------------------------
| ACTION BUTTONS
|--------------------------------------------------------------------------
-->

<td>


<div class="action-group">





<?php if($request->status == "Pending"): ?>



<?= Html::a(

    "▶ Start",

    [

        '/laboratory/process',

        'id'=>$request->id

    ],

    [

        'class'=>'action-btn btn-start',

        'data'=>[

            'method'=>'post',

            'confirm'=>'Start processing this laboratory request?'

        ]

    ]

)

?>






<?php elseif($request->status == "Processing"): ?>





<?= Html::a(

    "📝 Add Result",

    [

        '/laboratory/create-result',

        'id'=>$request->id

    ],

    [

        'class'=>'action-btn btn-result'

    ]

)

?>







<?php else: ?>





<?= Html::a(

    "👁 View Result",

    [

        '/laboratory/view',

        'id'=>$request->id

    ],

    [

        'class'=>'action-btn btn-view'

    ]

)

?>






<?php endif; ?>







<?= Html::a(

    "🗑",

    [

        '/laboratory/delete',

        'id'=>$request->id

    ],

    [

        'class'=>'action-btn btn-delete',

        'data'=>[

            'method'=>'post',

            'confirm'=>'Delete this laboratory request?'

        ]

    ]

)

?>





</div>


</td>







</tr>



<?php endforeach; ?>




</tbody>


</table>





</div>









<!--
|--------------------------------------------------------------------------
| PAGINATION
|--------------------------------------------------------------------------
-->



<div style="margin-top:30px;text-align:center;">



<?= LinkPager::widget([


    'pagination'=>$dataProvider->pagination,


    'options'=>[

        'class'=>'pagination justify-content-center'

    ]


]); ?>



</div>
<!--
|--------------------------------------------------------------------------
| EMPTY STATE IMPROVEMENT
|--------------------------------------------------------------------------
-->

<?php if(empty($models)): ?>


<div class="empty-state">


    <div class="empty-icon">
        🧪
    </div>


    <h3>
        No Laboratory Requests Found
    </h3>


    <p>
        Laboratory requests from doctors will appear here.
    </p>



</div>


<?php endif; ?>








<style>


/*
|--------------------------------------------------------------------------
| ACTION BUTTONS
|--------------------------------------------------------------------------
*/


.action-group{

    display:flex;
    gap:8px;
    flex-wrap:wrap;

}




.action-btn{


    padding:9px 14px;
    border-radius:12px;
    text-decoration:none;
    font-size:13px;
    font-weight:600;
    display:inline-flex;
    align-items:center;
    gap:5px;
    transition:.3s;

}




.action-btn:hover{


    transform:translateY(-2px);
    opacity:.9;

}





.btn-start{


    background:#00695c;
    color:white;

}





.btn-result{


    background:#ff9800;
    color:white;

}




.btn-view{


    background:#546e7a;
    color:white;

}




.btn-delete{


    background:#e53935;
    color:white;

}









/*
|--------------------------------------------------------------------------
| EMPTY STATE
|--------------------------------------------------------------------------
*/


.empty-state{


    margin-top:30px;
    background:white;
    padding:50px;
    border-radius:25px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

}




.empty-icon{


    font-size:60px;
    margin-bottom:15px;

}



.empty-state h3{


    color:#00695c;
    font-size:25px;

}



.empty-state p{


    color:#78909c;

}









/*
|--------------------------------------------------------------------------
| SEARCH INPUT
|--------------------------------------------------------------------------
*/


.search-box{


    display:flex;
    gap:15px;

}



.search-box input{


    flex:1;

}




.search-btn{


    background:#00695c;
    color:white;
    border:none;
    padding:0 25px;
    border-radius:12px;
    cursor:pointer;

}









/*
|--------------------------------------------------------------------------
| TABLE RESPONSIVE
|--------------------------------------------------------------------------
*/


.table-wrapper{


    overflow-x:auto;

}







@media(max-width:1200px){


.cards{


    grid-template-columns:repeat(2,1fr);


}


}








@media(max-width:700px){



.lab-page{


    padding:15px;

}



.header h1{


    font-size:24px;

}



.cards{


    grid-template-columns:1fr;

}



.table-box{


    padding:15px;

}




th,
td{


    white-space:nowrap;
    padding:12px;

}





.action-group{


    flex-direction:column;


}





.action-btn{


    width:100%;
    justify-content:center;

}



}





</style>






<script>


/*
|--------------------------------------------------------------------------
| LIVE SEARCH UI READY
|--------------------------------------------------------------------------
*/


document.addEventListener(
"DOMContentLoaded",
function(){


const search =
document.querySelector(
".search-input"
);



if(search){


search.addEventListener(
"keyup",
function(){


let value =
this.value.toLowerCase();



document
.querySelectorAll(
"tbody tr"
)
.forEach(row=>{


row.style.display =
row.innerText
.toLowerCase()
.includes(value)

?

""

:

"none";



});



});



}



});


</script>