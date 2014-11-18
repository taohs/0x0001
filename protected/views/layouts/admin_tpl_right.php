<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php //CHtml::encode($this->getPageTitle()) ;?></title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/css/extension.css"/>
<style type="text/css">
html,body {
    background: #FFF;
}
</style>
</head>
<body>
<!--
<form action="" method="" name=""></form>
-->
<?php
    //
    //
    //if(isset($this->breadcrumbs)){
    //    $this->widget('zii.widgets.CBreadcrumbs',array(
    //        'homeLink'=>'当前位置：',
    //        'links'=>$this->breadcrumbs,
    //        'separator'=>' > ',
    //        'htmlOptions'=>array('class'=>'breadCrumb'),
    //    ));
    //}
?>
<div class="breadCrumb">当前位置：<?php echo $this->controlName. ' > ' .$this->actionName; ?></div>
<?php echo $content;?>
<!--
<div class="right">
	<div class="tool">
		<a id="add" href="#"><img src="./images/toolbar_1.png" />添加</a>
		<a id="cancel" href="javascript:history.go(-1);"><img src="./images/toolbar_11.png" />取消</a>
		<span id="edit"><img src="./images/toolbar_2.png" />修改</span>
		<span id="delete"><img src="./images/toolbar_3.png" />删除</span>
		<span id="sort"><img src="./images/toolbar_4.png" />排序</span>
		<span id="recommend"><img src="./images/toolbar_5.png" />推荐</span>
		<span id="top"><img src="./images/toolbar_6.png" />置顶</span>
		<span id="hide"><img src="./images/toolbar_7.png" />隐藏</span>
		<span id="set"><img src="./images/toolbar_8.png" />设置</span>
		<span id="lock"><img src="./images/toolbar_10.png" />锁定</span>
		<div class="search">
			<input type="text" />
			<span id="search"><img src="./images/toolbar_9.png" />搜索</span>
		</div>
	</div>
	<div class="body">
		<table class="list">
			<thead>
				<tr>
				<th>选择</th>
				<th>排序</th>
				<th>缩略图</th>
				<th>标题</th>
				<th>内容</th>
				<th>状态</th>
				<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
				<td>7</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="page">
		<a href="#">上一页</a>
		<span>1</span>
		<a href="#">2</a>
		<a href="#">3</a>
		<a href="#">下一页</a>
当前1/3页 共20条
</div>
</div>
-->
</body>
</html>