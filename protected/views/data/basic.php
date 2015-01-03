<div class="right">
    <div class="body" style="margin-top: 0px;">
        <div style="margin-top:15px">
            <table class="list">
                <thead>
                <tr>
                    <th>合计</th>
                    <th>本期收入数量</th>
                    <th>本期挂帐数量</th>
                    <th>去税金额</th>
                    <th>税额</th>
                    <th>挂帐金额</th>


                    <th>期初应付账款余额</th>
                    <th>本期付款额</th>
                    <th>其中承兑额</th>
                    <th>本期应付账余额</th>
                </tr>
                </thead>
                <tboty>
                    <tr>
                        <td></td>
                        <td><?php echo $total->current_number;?></td>
                        <td><?php echo $total->current_unpaid_debts;?></td>
                        <td><?php echo $total->after_tax;?></td>
                        <td><?php echo $total->tax;?></td>
                        <td><?php echo $total->unpaid_debts_amount;?></td>

                        <td><?php echo $total->open_balance_payable;?></td>
                        <td><?php echo $total->current_amount_pay;?></td>
                        <td><?php echo $total->acceptances_amount;?></td>
                        <td><?php echo $total->current_balance_payable;?></td>
                    </tr>

                </tboty>
            </table>

        </div>
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
                array('name'=>'本期挂帐数量','value'=>'$data->current_unpaid_debts'),
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