<?php

use yii\helpers\Html;

$this->title = "Roles Management";

?>


<style>

.role-page{

    background:#f5f9fc;
    padding:30px;
    min-height:100vh;

}


/* HEADER */

.role-header{

    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:30px;

}


.role-header h1{

    color:#004d40;
    font-size:32px;
    font-weight:700;

}


/* BUTTON */

.add-role{

    background:linear-gradient(
        135deg,
        #00bfa5,
        #00695c
    );

    color:white;
    padding:14px 25px;
    border-radius:15px;
    text-decoration:none;
    font-weight:bold;

}




/* STAT CARDS */


.stats-row{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:20px;

    margin-bottom:30px;

}



.stat-card{

    background:white;

    padding:25px;

    border-radius:25px;

    box-shadow:
    0 10px 30px rgba(0,0,0,.08);

    display:flex;

    align-items:center;

    gap:20px;

}


.stat-icon{

    width:60px;
    height:60px;

    border-radius:20px;

    background:#e0f2f1;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:30px;

}



.stat-card h3{

    margin:0;

    font-size:28px;

    color:#004d40;

}



.stat-card p{

    margin:5px 0;

    color:#78909c;

}



/* MAIN CARD */


.role-card{

    background:white;

    border-radius:30px;

    padding:30px;

    box-shadow:
    0 15px 40px rgba(0,0,0,.08);

}



/* TABLE HEADER */


.table-top{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:25px;

}


.table-top h2{

    color:#004d40;

}



.search-box{

    width:280px;

    border-radius:15px;

    padding:12px 18px;

    border:1px solid #ddd;

}




/* TABLE */


.role-table{

    width:100%;

    border-collapse:separate;

    border-spacing:0 12px;

}


.role-table thead th{

    background:#004d40;

    color:white;

    padding:15px;

    border:none;

}



.role-table tbody tr{

    background:#ffffff;

    box-shadow:
    0 5px 15px rgba(0,0,0,.05);

}



.role-table td{

    padding:18px;

}



.role-name{

    font-weight:bold;

    color:#00695c;

    font-size:16px;

}



/* BADGE */


.role-badge{

    background:#e0f2f1;

    color:#00695c;

    padding:8px 15px;

    border-radius:20px;

    font-weight:bold;

}




/* ACTIONS */


.action-btn{

    border:none;

    padding:9px 14px;

    border-radius:12px;

    font-size:13px;

    text-decoration:none;

    margin-right:5px;

}



.view{

    background:#e3f2fd;

    color:#0277bd;

}



.edit{

    background:#fff8e1;

    color:#ff8f00;

}



.delete{

    background:#ffebee;

    color:#c62828;

}





@media(max-width:1000px){


.stats-row{

grid-template-columns:1fr 1fr;

}


}


</style>





<div class="role-page">



<!-- HEADER -->

<div class="role-header">


<div>

<h1>
🔐 Roles Management
</h1>


<p class="text-muted">

Manage hospital access control and user permissions

</p>


</div>



<?=Html::a(

"➕ Create New Role",

['create'],

[
'class'=>'add-role'
]

)?>



</div>







<!-- STATISTICS -->


<div class="stats-row">



<div class="stat-card">


<div class="stat-icon">
🔐
</div>


<div>

<h3>
<?=count($roles)?>
</h3>

<p>
Total Roles
</p>

</div>


</div>






<div class="stat-card">


<div class="stat-icon">
👥
</div>


<div>

<h3>
<?=count($roles)?>
</h3>

<p>
Hospital Staff Roles
</p>

</div>


</div>







<div class="stat-card">


<div class="stat-icon">
🛡️
</div>


<div>

<h3>
RBAC
</h3>

<p>
Security System
</p>

</div>


</div>







<div class="stat-card">


<div class="stat-icon">
🏥
</div>


<div>

<h3>
ACTIVE
</h3>

<p>
System Status
</p>

</div>


</div>




</div>









<!-- TABLE -->


<div class="role-card">



<div class="table-top">


<h2>
🔐 Available System Roles
</h2>



<input

type="text"

id="roleSearch"

class="search-box"

placeholder="Search role..."

>



</div>






<table class="role-table">


<thead>

<tr>

<th>
#
</th>


<th>
Role
</th>


<th>
Created Date
</th>


<th>
Access Level
</th>


<th>
Actions
</th>


</tr>


</thead>



<tbody id="roleTable">



<?php foreach($roles as $index=>$role): ?>


<tr>


<td>

<?=($index+1)?>

</td>



<td>


<span class="role-badge">

🔑

<?=Html::encode($role->role_name)?>

</span>


</td>





<td>

<?=Html::encode($role->created_at)?>

</td>




<td>


<span class="role-name">

Hospital Access

</span>


</td>






<td>


<?=Html::a(

"👁 View",

['view','id'=>$role->id],

[
'class'=>'action-btn view'
]

)?>





<?=Html::a(

"✏ Edit",

['update','id'=>$role->id],

[
'class'=>'action-btn edit'
]

)?>






<?=Html::a(

"🗑 Delete",

['delete','id'=>$role->id],

[

'class'=>'action-btn delete',

'data'=>[

'confirm'=>
'Delete this role?',

'method'=>'post'

]

]

)?>



</td>




</tr>



<?php endforeach; ?>



</tbody>



</table>



</div>





</div>








<script>


document
.getElementById("roleSearch")
.addEventListener("keyup",function(){


let value=this.value.toLowerCase();


let rows=document
.querySelectorAll("#roleTable tr");



rows.forEach(row=>{


let text=row.innerText.toLowerCase();



row.style.display=
text.includes(value)
?
""
:
"none";



});


});



</script>