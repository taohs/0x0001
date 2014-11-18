<div class="right">
    <div class="body" style="margin-top: 0px;">
        <?php $this->widget('zii.widgets.grid.CGridView',array(
            'dataProvider'=>$dataProvider,
            'template'=>"{items}<div class='page'>{pager}{summary}</div>",
            'itemsCssClass'=>'list item',
            'pagerCssClass'=>'abdadfasdf',
            'columns'=>array(

                array('name'=>'编号','value'=>'$data->code'),
                array('name'=>'品名','value'=>'$data->name'),
                array('name'=>'规格型号','value'=>'$data->format'),
                array('name'=>'计量单位','value'=>'$data->unit'),
                array('name'=>'本期收入数量','value'=>'$data->current_number'),
                array('name'=>'本期挂帐数量','value'=>'$data->unpaid_debts'),
                array('name'=>'单价','value'=>'$data->price'),
                array('name'=>'去税金额', 'value'=>'$data->tax'),
                array('name'=>'税额', 'value'=>'$data->tax'),
                array('name'=>'挂帐金额', 'value'=>'$data->unpaid_debts_amount'),

            ),
            'pager'=>array(
                // 'pagerCssClass'=>'page',
                'nextPageLabel'=>'下一页',
                'prevPageLabel'=>'上一页',
                'header'=>'',
                'cssFile'=>false,
                'internalPageCssClass'=>false,
                'maxButtonCount'=>7
            )
        ));?>
    </div>
</div>
<script type="text/javascript">
    $("#search").click(function(){
        var url=window.location.href;
        url=url + '&year='+$("#year").val();
        window.open(url.'_self');
    });
</script>