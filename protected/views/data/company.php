<div class="right">
    <div class="body">
        <div class="search addlist" style="left: 0px;">
            <ul class="clear">
                <li class="a1" style="width: 50px;">年度：</li>
                <li class="a2">
                   <span class="selectBox" style="float: left">
                        <?php echo CHtml::dropDownList("year","year",array(2010,2011,2012,2013,2014,2015,2016,2017,2028,2019,2020),array('class'=>'select')) ;?>
                   </span>
                    <span id="search" style="float: left;margin-left: 10px;cursor: pointer;"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_9.png" />搜索</span>
                </li>
            </ul>
        </div>
        <table class="list">
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
<script type="text/javascript">
    $("#search").click(function(){
        var url=window.location.href;
        url=url + '&year='+$("#year").val();
        window.open(url.'_self');
    });
</script>