<div class="right">
    <div class="body">
        <div class="search addlist" style="left: 0px;">
            <ul class="clear">
                <li class="a1" style="width: 50px;">年度：</li>
                <li class="a2">
                    <?php
                        $form= $this->beginWidget('CActiveForm',array(

                        ));
                    ?>

                    <span class="selectBox" style="float: left">
                        <?php echo $form->dropDownList($model,"year",array(2014=>2014,2015,2016,2017,2018,2019,2020),array('class'=>'select')) ;?>
                    </span>
                    <!--<div class="se">-->
                    <span id="search"  style="float: left;margin-left: 10px;">
                        <!--<img id="" src="--><?php //echo Yii::app()->baseUrl;?><!--/images/toolbar_9.png" />-->
                        <input class="sbut" type="submit">
                    </span>
                    <?php $this->endWidget();?>
                    <!--</div>-->
                </li>
            </ul>
        </div>
        <table class="list" style="margin-top: 5px;">
            <thead>
            <tr>
                <th>挂帐期间</th>
                <th>挂帐单一</th>
                <th>挂帐单二</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach($monthArray as $k=>$v){?>
                <tr>
                    <td><?php echo $k?></td>
                    <td><?php echo $v['basic'];?></td>
                    <td><?php echo $v['extension'];?></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>
<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
<script type="text/javascript">
    $("#search").click(function(){
        //alert(1);
        var url=window.location.href;
        url=url + '&year='+$("#year").val();
        alert(url);
        window.open(url.'_self');
    });
</script>