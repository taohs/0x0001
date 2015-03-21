<div class="right">
    <div class="tool">
<!--        <a id="add" href="#"><img src="./images/toolbar_1.png">添加</a>-->
<!--        <a id="cancel" href="javascript:history.go(-1);"><img src="./images/toolbar_11.png">取消</a>-->
<!--        <span id="edit"><img src="./images/toolbar_2.png">修改</span>-->
<!--        <span id="delete"><img src="./images/toolbar_3.png">删除</span>-->
<!--        <span id="sort"><img src="./images/toolbar_4.png">排序</span>-->
<!--        <span id="recommend"><img src="./images/toolbar_5.png">推荐</span>-->
<!--        <span id="top"><img src="./images/toolbar_6.png">置顶</span>-->
<!--        <span id="hide"><img src="./images/toolbar_7.png">隐藏</span>-->
<!--        <span id="set"><img src="./images/toolbar_8.png">设置</span>-->
<!--        <span id="lock"><img src="./images/toolbar_10.png">锁定</span>-->
        <div id="search" class="search">
            <input id="keyword" type="text" value="<?php echo $keyword;?>">
            <span id="searchSubmit"><img src="/images/toolbar_9.png">搜索</span>
        </div>
        <script type="text/javascript">
            $('#searchSubmit').click(function () {
                var keyword  = $('#keyword').val();

                var url = '/company/list'+ '?keyword='+keyword;

                window.open(url,'_self');
            })

        </script>
    </div>
    <div class="body" style="margin-top: 0px;">
        <?php $this->widget('zii.widgets.grid.CGridView',array(
                'dataProvider'=>$dataProvider,
                'template'=>"{items}<div class='page'>{pager}{summary}</div>",
                'itemsCssClass'=>'list item',
                'pagerCssClass'=>'abdadfasdf',
                'columns'=>array(

                    array('name'=>'id','value'=>'$data->id'),
                    array('name'=>'单位名称','value'=>'$data->company'),
                    array('name'=>'单位编号','value'=>'$data->code_id'),
                    array('name'=>'创建时间','value'=>'$data->create_time'),
                    array('name'=>'更新时间','value'=>'$data->update_time'),
                    array('name'=>'is_valid','value'=>'$data->is_valid?"启用":"关闭"'),
                    array(
                        'name'=>'挂帐信息',
                        'type'=> 'raw',
                        'value'=>'CHtml::link("查看",array(\'/data/company\',\'company_code\'=>$data->code_id))',
                    ),
                    //array(
                    //    'name'=>'挂帐信息',
                    //    'value'=>array($this,"getDetbs"),
                    //),
                    array(            // display a column with "view", "update" and "delete" buttons
                        //  'name'=>'op',
                        'class'=>'CButtonColumn',
                        'template'=>'{update}',//{delete}
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