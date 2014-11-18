<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 上午1:03
 */
class BillController extends Controller{

    /**
     * index
     */
    public function actionIndex(){}
    public function actionList(){}
    public function actionSure(){}

    /**
     * nav
     */
    public function actionLeft(){
        $this->layout="admin_tpl_left";
        $this->render('left');
    }
}