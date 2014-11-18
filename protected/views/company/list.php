<div class="right">
    <div class="tool">
        <a id="add" href="#"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_1.png" />添加</a>
        <a id="cancel" href="javascript:history.go(-1);"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_11.png" />取消</a>
        <span id="edit"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_2.png" />修改</span>
        <span id="delete"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_3.png" />删除</span>
        <span id="sort"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_4.png" />排序</span>
        <span id="recommend"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_5.png" />推荐</span>
        <span id="top"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_6.png" />置顶</span>
        <span id="hide"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_7.png" />隐藏</span>
        <span id="set"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_8.png" />设置</span>
        <span id="lock"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_10.png" />锁定</span>
        <div class="search">
            <input type="text" />
            <span id="search"><img src="<?php echo Yii::app()->baseUrl;?>/images/toolbar_9.png" />搜索</span>
        </div>
    </div><?php //echo CHtml::link("abc",array('/data/company','id'=>'abd'));?>
    <div class="body">
        <?php $this->widget('zii.widgets.grid.CGridView',array(
                'dataProvider'=>$dataProvider,
                'template'=>"{items}<div class='page'>{pager}{summary}</div>",
                'itemsCssClass'=>'list item',
                'pagerCssClass'=>'abdadfasdf',
                'columns'=>array(

                    array('name'=>'id','value'=>'$data->id'),
                    array('name'=>'company','value'=>'$data->company'),
                    array('name'=>'code_id','value'=>'$data->code_id'),
                    array('name'=>'create_time','value'=>'$data->create_time'),
                    array('name'=>'update_time','value'=>'$data->update_time'),
                    array('name'=>'is_valid','value'=>'$data->is_valid'),
                    array(
                        'name'=>'挂帐信息',
                        'type'=> 'raw',
                        'value'=>'CHtml::link("查看",array(\'/data/company\',\'company_code\'=>$data->code_id))',
                    ),
                    array(
                        'name'=>'挂帐信息',
                        'value'=>array($this,"getDetbs"),
                    ),
                    array(            // display a column with "view", "update" and "delete" buttons
                        //  'name'=>'op',
                        'class'=>'CButtonColumn',
                        'template'=>'{update}{delete}',
                        'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfully"); }'
                    )
                ),
                'pager'=>array(
                    // 'pagerCssClass'=>'page',
                    'nextPageLabel'=>'下一页',
                    'prevPageLabel'=>'上一页',
                    'header'=>'',
                    'cssFile'=>false,
                    'internalPageCssClass'=>false,
                )
        ));?>
</div>