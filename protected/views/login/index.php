<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>重庆集萃科技电子商务系统</title>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/css/login_common.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/login/css/login2.css" rel="stylesheet" type="text/css" />
    <!--<script type="text/javascript" src="./res/js/jquery.js"></script>-->
    <!--<script type="text/javascript" src="./res/js/login.js"></script>-->
</head>
<body>

<div class="maindiv">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        //'action'=>'index',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <form action="?q=admin/login" name="rform" method="post" id="login_form"
          onsubmit="return check_form();">
        <ul>
            <li id="login-uname"><label>用户名：</label>
                <?php echo $form->textField($model,'username',array('class'=>'namelogin','tabindex'=>'1')); ?>
                <?php echo $form->error($model,'username',array(),false,false); ?>
                </li>
            <li id="login-pwd"><label>密  码：</label>
                <?php echo $form->passwordField($model,'password',array('class'=>'password','tabindex'=>'2')); ?>
                <?php echo $form->error($model,'password',array('style'=>'color:red')); ?>
            </li>
            <li>
                <?php echo CHtml::submitButton('Login',array('class'=>'login form_submit','tabindex'=>'4','value'=>'')); ?>

            </li>
        </ul>

    <?php $this->endWidget(); ?>
</div>

<script>
    $(document).ready(function () {
        var cheight=document.documentElement.clientHeight;
        $('#login_div').css('height',cheight-72);

    });


</script>
</body>
</html>
