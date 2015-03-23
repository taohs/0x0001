<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="right">
    <div class="body">

        <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-add-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // See class documentation of CActiveForm for details on this,
            // you need to use the performAjaxValidation()-method described there.
            'enableAjaxValidation'=>false,
        )); ?>

        <p class="note">Fields with <span class="required">*</span> are required.</p>

        <?php echo $form->errorSummary($model); ?>
        <div class="addlist">

            <div class="row clear">
                <ul class="clear">
                    <li class="a1"><span>*</span><b>年份</b></li>
                    <li class="a2">
                    <span class="selectBox">
                    <?php echo $form->dropDownList($model,'year',array('2014'=>'2014',2015,2016,2017,2018,2019,2020),array('class'=>'select','selected'=>true)); ?>
                    <?php echo $form->error($model,'year'); ?>
                    </span>
                    </li>
                </ul>
            </div>

            <div class="row clear">
                <ul class="clear">
                    <li class="a1"><span>*</span><b>月份</b></li>
                    <li class="a2">
                    <span class="selectBox">
                        <?php echo $form->dropDownList($model,'month',array('1'=>1,2,3,4,5,6,7,8,9,10,11,12),array('class'=>'select')); ?>
                        <?php echo $form->error($model,'month'); ?>
                    </span>
                    </li>
                </ul>
            </div>
            <div class="row clear">
                <ul class="clear">
                    <li class="a1"><span>*</span><b>公司</b></li>
                    <li class="a2">
                    <span class="selectBox">
                        <?php echo $form->dropDownList($model,'company',CHtml::listData(Company::model()->findAll(array('select'=>'code_id,code_id')),'code_id','code_id') ,array('class'=>'select')); ?>
                        <?php echo $form->error($model,'company'); ?>
                    </span>
                    </li>
                </ul>
            </div>




            <!--<div class="row clear">-->
            <!--    <ul class="clear">-->
            <!--        <li class="a1"><span>*</span><b>密码</b></li>-->
            <!--        <li class="a2">-->
            <!--            --><?php //echo $form->passwordField($model,'password',array('class'=>'text','style'=>'width:150px','autocomplete'=>"off")); ?>
            <!--            --><?php //echo $form->error($model,'password'); ?>
            <!--        </li>-->
            <!--    </ul>-->
            <!--</div>-->


            <div class="row buttons clear">
                <ul class="clear">
                    <li class="a1"></li>
                    <li class="a2">
                        <?php if(Yii::app()->user->hasFlash('delBasicSubmit')){ ?>
                            <div class="flash-success">
                                <?php echo Yii::app()->user->getFlash('delBasicSubmit'); ?>
                            </div>
                        <?php } ?>
                        <?php echo CHtml::submitButton('Submit',array('value'=>'提 交','class'=>'sbut')); ?>
                    </li>
                </ul>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->