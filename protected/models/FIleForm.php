<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 下午3:42
 */
class FileForm extends CFormModel{

    const SCENARIO_IMAGE='image';
    const SCENARIO_EXCEL='excel';
    const SCENARIO_CSV  ='csv';
    public $date;
    public $file;

    public function rules(){
        return array(
            array('date,file','required'),
            array('date','date','format'=>'yyyymm'),
            array('file','file','types'=>'xls,xlsx','maxSize'=>1024 * 1024 * 100,'on'=>self::SCENARIO_EXCEL),
            array('file','file','types'=>'jpg,png,gif','maxSize'=>1024 * 1024 * 1,'on'=>self::SCENARIO_IMAGE),
            array('file','file','types'=>'csv','maxSize'=>1024 * 1024 * 2,'on'=>self::SCENARIO_CSV),
        );
    }
    public function upload(){

    }

}