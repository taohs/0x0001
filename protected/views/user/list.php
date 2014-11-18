<div class="right">
    <div class="tool">
        <a id="add" href="/user/add"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_1.png" />添加</a>
        <a id="cancel" href="javascript:history.go(-1);"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_11.png" />取消</a>
        <span id="edit"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_2.png" />修改</span>
        <span id="delete"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_3.png" />删除</span>
        <span id="set"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_8.png" />设置</span>
        <span id="lock"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_10.png" />锁定</span>
        <div class="search">
            <input type="text" />
            <span id="search"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/toolbar_9.png" />搜索</span>
        </div>
    </div>

    <div class="body">

        <?php

         $this->widget('zii.widgets.grid.CGridView', array(
             'dataProvider'=> $dataProvider,

             'template'=>"{items}<div class='page'>{pager}{summary}</div>",
             'htmlOptions'=>array('style'=>'padding:0'),
             'columns'=>array(
                 array('name'=>'ids','class'=>'CCheckBoxColumn','value'=>'$data->id', 'selectableRows'=>2,'headerHtmlOptions'=>array('class'=>'abb','selected'=>true)),
                 array('name'=>'id','value'=>'$data->id'),
                 array('name'=>'用户名','value'=>'$data->username'),
                 array('name'=>'role','value'=>'$data->role0->role_name'),
                 array('name'=>'公司','value'=>'$data->company0->company'),
                 array(            // display 'create_time' using an expression
                     'name'=>'create_time',
                     'value'=>'$data->create_time'
                 ), array(            // display 'create_time' using an expression
                     'name'=>'update_time',
                     'value'=>'$data->update_time'
                 ),
                 array(            // display 'author.username' using an expression
                     'name'=>'authorName',
                     'value'=>'$data->username'
                 ),
                 array('name'=>'is_valid','value'=>'$data->is_valid'),
                 array(            // display a column with "view", "update" and "delete" buttons
                   //  'name'=>'op',
                     'class'=>'CButtonColumn',
                     'template'=>'{view}{update}{delete}',
                     'afterDelete'=>'function(link,success,data){ if(success) alert("Delete completed successfully"); }'

                    )
             ),
             'itemsCssClass'=>'list',
             'pagerCssClass'=>'abdadfasdf',
             'summaryCssClass'=>'',
             'pager'=>array(
                // 'pagerCssClass'=>'page',
                 'nextPageLabel'=>'下一页',
                 'prevPageLabel'=>'上一页',
                 'header'=>'',
                 'cssFile'=>false,
                 'internalPageCssClass'=>false,
             )
         ));
        ?>
    </div>
</div>
