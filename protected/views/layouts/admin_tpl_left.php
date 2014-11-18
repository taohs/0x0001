<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css"/>
    <?php YiiBase::app()->clientScript->registerCoreScript('jquery');?>
    <style type="text/css">
        html,body {
            background: #F7F7F7;
            height: 100%;
        }
    </style>
</head>
<body>

<div class="left">
    <div class="nav">
        <ul>
            <?php echo $content;?>
            <!--<li class="active"><a target="rightFrame" href="right.php">系统信息</a></li>-->
            <!--<li><a target="rightFrame" href="add.html">添加样式</a></li>-->
        </ul>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.nav li').click(function(){
            $(".nav li").removeClass("active")
            $(this).addClass("active");
        });
    });
</script>
</body>
</html>