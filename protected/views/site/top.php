<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css"/>
    <?php YiiBase::app()->clientScript->registerCoreScript('jquery');?>
<style type="text/css">
	body {
		background: #1c77ac;
	}
</style>
    <script type="text/javascript">
        $(function(){
            $('.nav span').click(function(){
                $(".nav span").removeClass("active")
                $(this).addClass("active");
            });
            $('#n1').click(function(){
                window.parent.frames["leftFrame"].location.href="left.html";
                window.parent.frames["rightFrame"].location.href="right.html";
            });
            $('#n2').click(function(){
                window.parent.frames["leftFrame"].location.href="/company/left.html";
                window.parent.frames["rightFrame"].location.href="/company/list.html";
            });
            $('#n3').click(function(){
                window.parent.frames["leftFrame"].location.href="/file/left.html";
                window.parent.frames["rightFrame"].location.href="/file/basic.html";
            });
            $('#n4').click(function(){
                window.parent.frames["leftFrame"].location.href="/user/left.html";
                window.parent.frames["rightFrame"].location.href="/user/list.html";
            });
            $('#n5').click(function(){
                window.parent.frames["leftFrame"].location.href="user.html";
                window.parent.frames["rightFrame"].location.href="r5.html";
            });
            $('#n6').click(function(){
                window.parent.frames["leftFrame"].location.href="/member/left.html";
                window.parent.frames["rightFrame"].location.href="/member/list.html";
            });
        });
    </script>
</head>
<body>
<div class="top clear">
	<div class="logo"></div>
	<div class="nav">
        <?php if(Yii::app()->user->roleId == 1) {?>
            <span id = "n1" class="active" ><img src = "<?php echo Yii::app()->request->baseUrl;?>/images/top_nav_1.png" /><h3 > 管理首页</h3 ></span >
            <span id = "n2" ><img src = "<?php echo Yii::app()->request->baseUrl;?>/images/top_nav_2.png" /><h3 > 公司管理</h3 ></span>
            <span id = "n4" ><img src = "<?php echo Yii::app()->request->baseUrl;?>/images/top_nav_4.png" /><h3 > 用户管理</h3 ></span>
            <span id = "n3" ><img src = "<?php echo Yii::app()->request->baseUrl;?>/images/top_nav_3.png" /><h3 > 文件管理</h3 ></span>
		    <!--<span id = "n5" ><img src = "--><?php //echo Yii::app()->request->baseUrl;?><!--/images/top_nav_5.png" /><h3 > 网站设置</h3 ></span>-->
            <!--<span id = "n6" ><img src = "--><?php //echo Yii::app()->request->baseUrl;?><!--/images/top_nav_6.png" /><h3 > 查看挂帐</h3 ></span>-->
            <script type="text/javascript">
                $("#n2").trigger('click');
            </script>
        <?php }else{?>
            <span id ="n6" class="active"><img src = "<?php echo Yii::app()->request->baseUrl;?>/images/top_nav_6.png" /><h3 > 查看挂帐</h3 ></span>
        <?php }?>
	</div>
	<div class="logot">
		<i><?php echo Yii::app()->user->name;?> (<?php echo Yii::app()->user->roleName;?>)</i>
        <?php if(Yii::app()->user->roleId == 1) {?>
            <a target="_parent" href="/site/logout.html">退出登录</a>
        <?php }else{ ?>
            <a target="_parent" href="/member/logout.html">退出登录</a>
        <?php } ?>
	</div>
</div>

</body>
</html>