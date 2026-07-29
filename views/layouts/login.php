<?php

use yii\helpers\Html;

$this->beginPage();

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>
<?= Html::encode($this->title) ?>
</title>


<?php $this->head(); ?>


<style>

html,body{

    margin:0;
    padding:0;
    height:100%;
    overflow:hidden;

}


body{

    font-family:'Segoe UI',sans-serif;

}


</style>


</head>


<body>


<?php $this->beginBody(); ?>


<?= $content ?>


<?php $this->endBody(); ?>


</body>


</html>


<?php $this->endPage(); ?>