<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/12/1
 * Time: 下午11:19
 */
?>
<div class="right">
    <div class="body" style="margin-top: 0px;">
        <?php $form=$this->beginWidget('CActiveForm',array(
                'enableClientValidation'=>true,
                'enableAjaxValidation'=>true,
                'clientOptions'=>array('validateOnSubmit'=>true),
                'htmlOptions'=>array('style'=>'margin-top:20px;'))
        );?>

        <div class="addlist">
            <ul class="clear">
                <li class="a1"><span>※</span><b>旧密码</b></li>
                <li class="a2">
                    <?php echo $form->passwordField($model,'oldPassword',array('class'=>'text','style'=>'width:180px')); ?>
                    <?php echo $form->error($model,'oldPassword',array(),true,true); ?>
                </li>
            </ul>
            <ul class="clear">
                <li class="a1"><span>※</span><b>新密码</b></li>
                <li class="a2">
                    <?php echo $form->passwordField($model,'newPassword',array('class'=>'text','style'=>'width:180px')); ?>
                    <?php echo $form->error($model,'newPassword'); ?>
                </li>
            </ul>
            <ul class="clear">
                <li class="a1"><span>※</span><b>确认密码</b></li>
                <li class="a2">
                    <div>
                    <?php echo $form->passwordField($model,'rePassword',array('class'=>'text','style'=>'width:180px')); ?>
                    <?php echo $form->error($model,'rePassword'); ?>
                    </div>
                </li>
            </ul>
            <ul class="clear">
                <li class="a1"></li>
                <li class="a2">
                    <?php if(Yii::app()->user->hasFlash('passwordSubmitted')): ?>
                             <div class="flash-success">
                                     <?php echo Yii::app()->user->getFlash('passwordSubmitted'); ?>
                                 </div>
                    <?php endif;?>
                    <?php echo CHtml::submitButton('提交',array('class'=>'sbut')); ?>
                </li>
            </ul>
        </div>
        <?php $this->endWidget();?>
    </div>
</div>
