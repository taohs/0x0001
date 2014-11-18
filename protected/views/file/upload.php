<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 下午3:50
 */

echo time();
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'login-form',
    //'action'=>'index',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
));
  //  echo $form->lable($model,'date');
    echo $form->textField($model,'date');
    echo $form->error($model,'date');



//echo $form->lable($model,'file');
//echo $form->fileField($model,'file');
echo CHtml::activeFileField($model,'file');
echo $form->error($model,'file');

echo CHtml::submitButton('uploadButton');


$this->endWidget();
?>
<div class=”row”>
    <?php echo '图片预览' ?>
<?php echo '<img src=”http://www.0x0001.dev/'.$model->file.'” style=”width:200px;height:300px;”/>'; ?>