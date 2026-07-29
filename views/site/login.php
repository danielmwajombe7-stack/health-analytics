<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "MHAS | Myles Health Analytics System";

?>


<style>


@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');


*{

margin:0;
padding:0;
box-sizing:border-box;
font-family:'Inter',sans-serif;

}



html,body{

width:100%;
height:100%;

overflow:hidden;

}





.login-page{


width:100%;

height:100vh;


display:flex;

align-items:center;

justify-content:center;


position:relative;



background-image:


linear-gradient(

135deg,

rgba(0,80,90,.70),

rgba(0,20,30,.85)

),


url("<?= Yii::getAlias('@web') ?>/images/medical-bg.jpg");



background-size:cover;

background-position:center;


}





.login-page::before{


content:"";

position:absolute;

inset:0;


background:

radial-gradient(

circle at top left,

rgba(0,255,200,.25),

transparent 40%

);



}





.main-container{


width:1200px;

max-width:95%;


display:flex;

justify-content:space-between;

align-items:center;


position:relative;

z-index:2;


}





/*
=========================
LEFT BRAND AREA
=========================
*/


.brand-area{


width:55%;

color:white;


}



.logo-section{


display:flex;

align-items:center;

gap:25px;


}




.logo{


width:95px;

height:95px;


border-radius:30px;



background:

linear-gradient(

135deg,

#00e5c0,

#00ff88

);



display:flex;

align-items:center;

justify-content:center;


font-size:48px;


box-shadow:

0 20px 40px rgba(0,255,180,.35);


}




.brand-title h1{


font-size:55px;

font-weight:900;


letter-spacing:2px;


}



.brand-title h2{


font-size:24px;


color:#a7fff0;


margin-top:5px;


}



.brand-title p{


margin-top:8px;

color:#d8ffff;

font-size:14px;


}




.description{


margin-top:40px;


font-size:18px;


line-height:1.8;


max-width:650px;


color:#ecffff;


}




.features{


display:flex;

gap:20px;

margin-top:35px;


}



.feature{


width:180px;

padding:20px;


background:

rgba(255,255,255,.12);


border-radius:20px;


backdrop-filter:blur(15px);


border:

1px solid rgba(255,255,255,.25);


}



.feature h3{


font-size:30px;

color:#00ffd0;


}


.feature span{


font-size:14px;

color:white;


}





/*
=========================
LOGIN CARD
=========================
*/


.login-box{


width:430px;


padding:45px;



background:


rgba(255,255,255,.15);



backdrop-filter:

blur(25px);



-webkit-backdrop-filter:

blur(25px);



border-radius:35px;



border:

1px solid rgba(255,255,255,.35);



box-shadow:

0 30px 80px rgba(0,0,0,.45);



color:white;


}




.login-box h2{


font-size:34px;

font-weight:800;


}



.login-box small{


color:#d7ffff;


}





.input-box{


margin-top:25px;


position:relative;


}





.input-box input{


height:55px;


width:100%;


padding:15px 20px;


border-radius:15px;


border:

1px solid rgba(255,255,255,.4);



background:

rgba(255,255,255,.20);



color:white;


font-size:15px;


outline:none;


}





.input-box input::placeholder{


color:#e0ffff;


}





.input-box input:focus{


background:white;


color:#00695c;


}




.password-icon{


position:absolute;


right:18px;


top:17px;


cursor:pointer;


font-size:20px;


color:white;


}





.remember{


margin-top:20px;


color:white;


}





.remember input{


width:18px;

height:18px;


}





.btn-login{


width:100%;


height:55px;


margin-top:30px;


border:none;


border-radius:15px;



background:


linear-gradient(

135deg,

#00d2c9,

#00ff88

);



font-size:18px;


font-weight:800;



color:white;



cursor:pointer;



letter-spacing:1px;


transition:.3s;


}



.btn-login:hover{


transform:translateY(-3px);


box-shadow:

0 15px 30px rgba(0,255,150,.35);


}





.security{


text-align:center;


margin-top:25px;


font-size:13px;


color:#d7ffff;


}





.footer{


position:absolute;


bottom:20px;


width:100%;


text-align:center;


color:#cfffff;


font-size:13px;


z-index:3;


}







@media(max-width:1000px){



.brand-area{

display:none;

}



.login-box{


width:90%;


}


}



</style>





<div class="login-page">





<div class="main-container">







<div class="brand-area">



<div class="logo-section">



<div class="logo">

🏥

</div>




<div class="brand-title">


<h1>

MHAS

</h1>



<h2>

Myles Health Analytics System

</h2>



<p>

Smart Hospital Information Platform

</p>



</div>


</div>







<div class="description">


Advanced digital healthcare management system
connecting patients, doctors, laboratories,
pharmacy and AI-powered health analytics
in one intelligent platform.



</div>







<div class="features">



<div class="feature">

<h3>

✓

</h3>

<span>

Patient Management

</span>

</div>






<div class="feature">

<h3>

🧪

</h3>

<span>

Laboratory

</span>

</div>






<div class="feature">

<h3>

AI

</h3>

<span>

Health Prediction

</span>

</div>



</div>





</div>












<div class="login-box">





<h2>

Welcome Back

</h2>


<small>

Login to access MHAS Hospital System

</small>







<?php $form = ActiveForm::begin([

'id'=>'login-form'

]); ?>







<div class="input-box">


<?= $form->field($model,'username')

->textInput([

'placeholder'=>'Username'

])

->label(false)

?>



</div>









<div class="input-box">


<?= $form->field($model,'password')

->passwordInput([

'id'=>'password',

'placeholder'=>'Password'

])

->label(false)

?>



<span 
class="password-icon"
onclick="togglePassword()">


<i class="bi bi-eye"></i>


</span>



</div>








<div class="remember">


<?= $form->field($model,'rememberMe')

->checkbox()

?>

</div>








<?= Html::submitButton(

'🔐 SIGN IN',

[

'class'=>'btn-login'

]

)

?>







<?php ActiveForm::end(); ?>







<div class="security">


🔒 Secure Hospital Access

<br>

MHAS Protected Healthcare Environment


</div>







</div>







</div>








<div class="footer">


© <?=date('Y')?> 

<b>MHAS</b>

<br>


Myles Health Analytics System

|

AI Powered Smart Healthcare



</div>







</div>






<script>


function togglePassword(){


let password=document.getElementById("password");


if(password.type==="password"){


password.type="text";


}

else{


password.type="password";


}



}



</script>