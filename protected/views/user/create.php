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
                <li class="a1"><span>*</span><b>是否有效</b></li>
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
                <li class="a1"><span>*</span><b>角色</b></li>
                <li class="a2">
                    <span class="selectBox">
                        <?php echo $form->dropDownList($model,'role',CHtml::listData(Role::model()->findall('is_valid=1'),'id','role_name'),array('class'=>'select')); ?>
                        <?php echo $form->error($model,'role'); ?>
                    </span>
                </li>
            </ul>
        </div>

        <div class="row clear">
            <ul class="clear">
                <li class="a1"><span>*</span><b>公司编号</b></li>
                <li class="a2">
                     <span class="selectBox">
                        <?php echo $form->dropDownList($model,'company',CHtml::listData(Company::model()->findall('is_valid=1'),'id','code_id'),array('class'=>'select')); ?>
                        <?php echo $form->error($model,'company'); ?>
                    </span>
                </li>
            </ul>
        </div>

        <div class="row clear">
            <ul class="clear">
                <li class="a1"><span>*</span><b>用户名</b></li>
                <li class="a2">
                    <?php echo $form->textField($model,'username',array('class'=>'text','style'=>'width:150px','value'=>null,'autocomplete'=>"off")); ?>
                    <?php echo $form->error($model,'username'); ?>
                </li>
            </ul>
        </div>
        <div class="row clear">
            <ul class="clear">
                <li class="a1"><span>*</span><b>密码</b></li>
                <li class="a2">
                    <?php echo $form->passwordField($model,'password',array('class'=>'text','style'=>'width:150px','value'=>null,'autocomplete'=>"off")); ?>
                    <?php echo $form->error($model,'password'); ?>
                </li>
            </ul>
        </div>


        <div class="row buttons clear">
            <ul class="clear">
                <li class="a1"></li>
                <li class="a2">
                    <?php if(Yii::app()->user->hasFlash('createUserSubmit')){ ?>
                            <div class="flash-success">
                                <?php echo Yii::app()->user->getFlash('createUserSubmit'); ?>
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