<?php
/**
 *
 * @var YiiBase Yii
 * @var $dataProvider CDataProvider
 *
 * @var $keyword String
 */
?>
<div class="right">
    <div class="tool">
        <div id="search" class="search">
            <form action="<?php echo YiiBase::app()->createUrl('/company/list');?>" method="get">
                <input id="keyword" name="keyword" type="text" value="<?php echo $keyword; ?>" placeholder="输入单位编号或名称查询">
                <span id="searchSubmit"><img src="/images/toolbar_9.png">搜索</span>
            </form>
        </div>
        <script type="text/javascript">
            $('#searchSubmit').click(function () {
                $('form').submit();
            })
        </script>
    </div>
    <div class="body" style="margin-top: 0px;">
        <?php $this->widget( 'zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'template' => "{items}<div class='page'>{pager}{summary}</div>",
            'itemsCssClass' => 'list item',
            'pagerCssClass' => 'abdadfasdf',
            'columns' => array(

                array( 'name' => 'id', 'value' => '$data->id' ),
                array( 'name' => '单位名称', 'value' => '$data->company' ),
                array( 'name' => '单位编号', 'value' => '$data->code_id' ),
                array( 'name' => '创建时间', 'value' => '$data->create_time' ),
                array( 'name' => '更新时间', 'value' => '$data->update_time' ),
                array( 'name' => 'is_valid', 'value' => '$data->is_valid?"启用":"关闭"' ),
                array(
                    'name' => '挂帐信息',
                    'type' => 'raw',
                    'value' => 'CHtml::link("查看",array(\'/data/company\',\'company_code\'=>$data->code_id))',
                ),
                //array(
                //    'name'=>'挂帐信息',
                //    'value'=>array($this,"getDetbs"),
                //),
                array(            // display a column with "view", "update" and "delete" buttons
                    //  'name'=>'op',
                    'class' => 'CButtonColumn',
                    'template' => '{update}',//{delete}
                    'afterDelete' => 'function(link,success,data){ if(success) alert("Delete completed successfully"); }'
                )
            ),
            'pager' => array(
                // 'pagerCssClass'=>'page',
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'header' => '',
                'cssFile' => false,
                'internalPageCssClass' => false,
            )
        ) ); ?>
    </div>