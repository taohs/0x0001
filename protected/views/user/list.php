<div class="right">
    <div class="tool">
        <div id="search" class="search">
            <form action="/user/list" method="get">
                <input id="keyword" name="keyword" type="text" value="<?php echo $keyword; ?>" placeholder="输入ID或用户名查询">
                <span id="searchSubmit"><img src="/images/toolbar_9.png">搜索</span>
                <input type="submit" style="display: none;">
            </form>
        </div>
        <script type="text/javascript">
            $('#searchSubmit').click(function () {
                $('form').submit();
            })
        </script>
    </div>

    <div class="body">

        <?php
        //Yii::app()->createUrl();

        $this->widget( 'zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'template' => "{items}<div class='page'>{pager}{summary}</div>",
            'htmlOptions' => array( 'style' => 'padding:0' ),
            'columns' => array(
                //array('name'=>'ids','class'=>'CCheckBoxColumn','value'=>'$data->id', 'selectableRows'=>2,'headerHtmlOptions'=>array('class'=>'abb','selected'=>true)),
                array( 'name' => 'id', 'value' => '$data->id' ),
                array( 'name' => '用户名', 'value' => '$data->username' ),
                array( 'name' => '角色', 'value' => '$data->role0->role_name' ),
                array( 'name' => '公司', 'value' => '$data->company0->company' ),
                array(            // display 'create_time' using an expression
                    'name' => '创建实践',
                    'value' => '$data->create_time'
                ),
                array(            // display 'create_time' using an expression
                    'name' => '修改时间',
                    'value' => '$data->update_time'
                ),
                //array(            // display 'author.username' using an expression
                //    'name'=>'authorName',
                //    'value'=>'$data->username'
                //),
                array( 'name' => 'is_valid', 'value' => '$data->is_valid?"有效":"关闭"' ),
                array(            // display a column with "view", "update" and "delete" buttons
                    //  'name'=>'op',
                    'class' => 'CButtonColumn',
                    'template' => '{update}{password}',//{delete}
                    'afterDelete' => 'function(link,success,data){ if(success) alert("Delete completed successfully"); }',
                    'buttons' => array(
                        'update' => array(
                            'imageUrl' => '/images/toolbar_1.png'
                        ),
                        'password' => array(
                            'label' => '修改密码',
                            // text label of the button
                            'url' => 'Yii::app()->controller->createUrl("updatePassword",array("id"=>$data->primaryKey))',
                            // a PHP expression for generating the URL of the button
                            //'imageUrl'=>'./up.gif',  // image URL of the button. If not set or false, a text link is used
                            'imageUrl' => '/images/toolbar_2.png',
                            // image URL of the button. If not set or false, a text link is used
                            'options' => array(),
                            // HTML options for the button tag
                            'click' => '...',
                            // a JS function to be invoked when the button is clicked
                            //'visible'=>'...',   // a PHP expression for determining whether the button is visible
                        )
                    )
                )
            ),
            'itemsCssClass' => 'list',
            'pagerCssClass' => 'abdadfasdf',
            'summaryCssClass' => '',
            'pager' => array(
                // 'pagerCssClass'=>'page',
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'header' => '',
                'cssFile' => false,
                'internalPageCssClass' => false,
            )
        ) );
        ?>
    </div>
</div>
