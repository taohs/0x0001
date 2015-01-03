<div class="right">
    <div class="body" style="margin-top: 0px;">
        <div style="margin-top:15px">
            <table class="list">
                <thead>
                <tr>
                    <th>本期收入数量</th>
                    <th>本期挂帐数量</th>
                    <th>挂帐金额</th>
                    <th>本期未挂帐数</th>
                    <th>期末结存金额</th>
                    <th>期初应付账款余额</th>
                    <th>质保金</th>
                    <th>扣点</th>
                </tr>
                </thead>
                <tboty>
                    <tr>
                        <td><?php echo $total->current_number;?></td>
                        <td><?php echo $total->current_unpaid_debts;?></td>
                        <td><?php echo $total->unpaid_debts_amount;?></td>
                        <td><?php echo $total->no_unpaid_debts;?></td>
                        <td><?php echo $total->close_amount;?></td>
                        <td><?php echo $total->open_balance_payable;?></td>
                        <td><?php echo $total->retention_money;?></td>
                        <td><?php echo $total->deduction;?></td>
                    </tr>
                </tboty>
            </table>

            <table class="list">
                <thead>
                <tr>
                    <th>罚款</th>
                    <th>搬运费</th>
                    <th>查询费</th>
                    <th>回收纸箱</th>
                    <th>本期网付金额</th>
                    <th>本期卡付金额</th>
                    <th>其中承兑额</th>
                    <th>本期应付账款余额</th>
                </tr>
                </thead>
                <tboty>
                    <tr>

                        <td><?php echo $total->fine;?></td>
                        <td><?php echo $total->transportation_fee;?></td>
                        <td><?php echo $total->check_fee;?></td>
                        <td><?php echo $total->other_fee;?></td>
                        <td><?php echo $total->current_net_amount_paid;?></td>
                        <td><?php echo $total->current_card_amount_paid;?></td>
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
                array('name'=>'上期结存数量','value'=>'$data->last_number'),
                array('name'=>'本期收入数量','value'=>'$data->current_number'),
                array('name'=>'本期挂帐数量','value'=>'$data->current_unpaid_debts'),
                array('name'=>'单价', 'value'=>'$data->price'),
                array('name'=>'挂帐金额', 'value'=>'$data->unpaid_debts_amount'),
                array('name'=>'本期未挂帐数量', 'value'=>'$data->no_unpaid_debts'),
                array('name'=>'期末结存金额', 'value'=>'$data->close_amount'),
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