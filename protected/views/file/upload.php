<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 下午3:50
 */
?>
<div class="right">
    <div class="body">
        <?php
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                //'action'=>'index',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
                'htmlOptions'=>array('enctype'=>'multipart/form-data'),
            ));
        ?>
        <div class="addlist">
            <ul class="clear">
                <li class="a1"><span>*</span><b><?php echo $this->actionName;?></b></li>
                <li class="a2">
                    <div class="fileBox">
                        <span class="fileView">请选择文件 …</span>
                    <?php
                        echo CHtml::activeFileField($model,'file',array('class'=>'file'));
                        echo $form->error($model,'file');
                    ?>
                    </div>

                </li>
            </ul>
            <ul class="clear">
                <li class="a1"></li>
                <li class="a2">
                    <!--<input class="sbut" type="submit" value="添加" />-->
                    <?php if(Yii::app()->user->hasFlash("uploadCsvSubmit")){?>
                        <div>
                            <?php echo Yii::app()->user->getFlash("uploadCsvSubmit");?>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="cacheKey" value="<?php echo $cacheKey;?>">
                    <?php echo CHtml::submitButton('uploadButton',array('class'=>'sbut','value'=>'提交'));?>
                    <!--<input class="rbut" type="reset" value="重置" />-->
                </li>
            </ul>

        </div>
        <?php
    //echo $form->lable($model,'date');
    //echo $form->textField($model,'date');
    //echo $form->error($model,'date');



//echo $form->lable($model,'file');
//echo $form->fileField($model,'file');
//echo CHtml::activeFileField($model,'file');




$this->endWidget();
?>

    </div>
    </div>
<script type="text/javascript">
    $(function(){
        $('.file').change(function(){
            $('.fileView').html($(this).val());
        });
    });
</script>
