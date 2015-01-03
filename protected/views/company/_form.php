<?php
/* @var $this CompanyController */
/* @var $model Company */
/* @var $form CActiveForm */
?>

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'company-update-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // See class documentation of CActiveForm for details on this,
        // you need to use the performAjaxValidation()-method described there.
        'enableAjaxValidation'=>false,
        'enableClientValidation'=>true,
    )); ?>
    <div class="addlist">

        <p class="note">带 <span class="required">*</span> 为必填项。</p>

        <?php echo $form->errorSummary($model); ?>



        <div class="row clear">
            <ul class="clear">
                <li class="a1"><span>※</span><b>是否启用</b></li>
                <li class="a2">
                    <span class="selectBox">
                    <?php echo $form->dropDownList($model,'is_valid',array('0'=>'不启用','1'=>'启用'),array('class'=>'select')); ?>
                    <?php echo $form->error($model,'is_valid'); ?>
                    </span>
                </li>
            </ul>
        </div>

        <div class="row clear">
            <ul class="clear">
            <li class="a1"><span>※</span><b>企业编号</b></li>
            <li class="a2">
                <?php echo $form->textField($model,'code_id',array('class'=>'text','style'=>'width:150px')); ?>
                <?php echo $form->error($model,'code_id'); ?>
            </li>
                </ul>
        </div>

        <div class="row clear">
            <ul class="clear">
                <li class="a1"><span>※</span><b>企业名称</b></li>
                <li class="a2">
                    <?php echo $form->textField($model,'company',array('class'=>'text','style'=>'width:150px')); ?>
                    <?php echo $form->error($model,'company'); ?>
                </li>

            </ul>
        </div>

        <div class="row clear buttons">
            <ul class="clear">
                <li class="a1"></li>
                <li class="a2">
                    <?php if(Yii::app()->user->hasFlash('companySubmitted')): ?>
                        <div class="flash-success">
                            <?php echo Yii::app()->user->getFlash('companySubmitted'); ?>
                        </div>
                    <?php endif;?>
                    <?php echo CHtml::submitButton('Submit',array('class'=>'sbut','value'=>'提 交')); ?></li>
        </div>

    </div>
    <?php $this->endWidget(); ?>

<!-- form -->