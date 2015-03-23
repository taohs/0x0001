<style type="text/css">
    strong {
        font-weight: bolder;
        color: red;
        font-size: 14px;
    }
</style>
<div class="right">
    <div class="body" style="margin-top: 0px;">

        <?php $this->widget( 'zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'template' => "{items}<div class='page'>{pager}{summary}</div>",
            'itemsCssClass' => 'list item',
            'pagerCssClass' => 'abdadfasdf',
            'columns' => array(
                array( 'name' => '编号', 'value' => '$data->code' ),
                array( 'name' => '品名', 'value' => '$data->name' ),
                array( 'name' => '规格型号', 'value' => '$data->format' ),
                array( 'name' => '计量单位', 'value' => '$data->unit' ),
                array( 'name' => '上期结存数量', 'value' => '$data->last_number' ),
                array( 'name' => '本期收入数量', 'value' => '$data->current_number' ),
                array( 'name' => '本期挂帐数量', 'value' => '$data->current_unpaid_debts' ),
                array( 'name' => '单价', 'value' => '$data->price' ),
                array( 'name' => '挂帐金额', 'value' => '$data->unpaid_debts_amount' ),
                array( 'name' => '本期未挂帐数量', 'value' => '$data->no_unpaid_debts' ),
                array( 'name' => '期末结存金额', 'value' => '$data->close_amount' ),
            ),
            'pager' => array(
                // 'pagerCssClass'=>'page',
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'header' => '',
                'cssFile' => false,
                'internalPageCssClass' => false,
                'maxButtonCount' => 7
            )
        ) ); ?>

        <div style="margin-top:15px">
            <table class="list">
                <thead>
                <tr>
<!--                    <th>本期收入数量</th>-->
<!--                    <th>本期挂帐数量</th>-->
<!--                    <th>挂帐金额</th>-->
<!--                    <th>本期未挂帐数</th>-->
<!--                    <th>期末结存金额</th>-->
                    <th>期初应付账款余额</th>
                    <th>本期挂帐金额</th>
                    <th>质保金</th>

                    <th>扣点</th>


                    <th>罚款</th>
                    <th>搬运费</th>
                    <th>查询费</th>
                    <th>其他</th>
                    <th>本期网付金额</th>
                    <th>本期卡付金额</th>
                    <th>其中承兑额</th>
                    <th>本期应付账款余额</th>
                </tr>
                </thead>
                <tboty>
                    <tr>
<!--                        <td>--><?php //echo $total->current_number; ?><!--</td>-->
<!--                        <td>--><?php //echo $total->current_unpaid_debts; ?><!--</td>-->
<!--                        <td>--><?php //echo $total->unpaid_debts_amount; ?><!--</td>-->
<!--                        <td>--><?php //echo $total->no_unpaid_debts; ?><!--</td>-->
<!--                        <td>--><?php //echo $total->close_amount; ?><!--</td>-->
                        <td><?php echo $total->open_balance_payable; ?></td>
                        <td><?php echo $total->unpaid_debts_amount; ?></td>
                        <td><?php echo number_format( $total->retention_money, 2, ".", "" ); ?></td>

                        <td><?php echo $total->deduction; ?></td>



                        <td><?php echo $total->fine; ?></td>
                        <td><?php echo number_format( $total->transportation_fee, 2, ".", "" ); ?></td>
                        <td><?php echo number_format( $total->check_fee, 2, ".", "" ); ?></td>
                        <td><?php echo number_format( $total->other_fee, 2, ".", "" ); ?></td>
                        <td><?php echo number_format( $total->current_net_amount_paid, 2, ".", "" ); ?></td>
                        <td><?php echo number_format( $total->current_card_amount_paid, 2, ".", "" ); ?></td>
                        <td><?php echo number_format( $total->acceptances_amount, 2, ".", "" ); ?></td>
                        <td><?php echo $total->current_balance_payable; ?></td>

                    </tr>
                    <tr>
                        <td><strong>备注</strong></td>
                        <td colspan="11" align="left"><?php echo $total->remark;?></td>
                    </tr>
                </tboty>
            </table>

<!--            <table class="list">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th>罚款</th>-->
<!--                    <th>搬运费</th>-->
<!--                    <th>查询费</th>-->
<!--                    <th>其他</th>-->
<!--                    <th>本期网付金额</th>-->
<!--                    <th>本期卡付金额</th>-->
<!--                    <th>其中承兑额</th>-->
<!--                    <th>质保金</th>-->
<!---->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tboty>-->
<!--                    <tr>-->
<!--                        <td>--><?php //echo $total->fine; ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->transportation_fee, 2, ".", "" ); ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->check_fee, 2, ".", "" ); ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->other_fee, 2, ".", "" ); ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->current_net_amount_paid, 2, ".", "" ); ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->current_card_amount_paid, 2, ".", "" ); ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->acceptances_amount, 2, ".", "" ); ?><!--</td>-->
<!--                        <td>--><?php //echo number_format( $total->retention_money, 2, ".", "" ); ?><!--</td>-->
<!--                    </tr>-->
<!--                </tboty>-->
<!--            </table>-->

        </div>
    </div>
</div>
<script type="text/javascript">

    var tr = '<tr>' +
        '<td><strong>合计</strong></td>' +
        '<td></td>' +
        '<td></td>' +
        '<td></td>' +
        '<td><strong><?php echo $total->last_number; ?></strong></td>' +
        '<td><strong><?php echo $total->current_number; ?></strong> </td>' +
        '<td><strong><?php echo $total->current_unpaid_debts;?></strong></td>' +
        '<td></td>' +
        '<td><strong><?php echo $total->unpaid_debts_amount; ?></strong></td>' +
        '<td><strong><?php echo $total->no_unpaid_debts; ?></strong></td>' +
        '<td><strong><?php echo $total->close_amount; ?></strong></td>' +
        '</tr>';
    $('#yw0 tbody').append(tr);
    //    alert($('#yw0').html());
</script>

<br>
<br>
