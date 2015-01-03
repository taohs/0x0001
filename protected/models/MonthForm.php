<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/12/8
 * Time: 下午10:39
 */
class MonthForm extends CFormModel{

    public $year;
    public $month;

    function rules(){
        return array(
            array('year,month','required'),
            array('year','length','max'=>4,'min'=>4,'tooLong'=>'1','tooShort'=>'2'),
            array('year','numerical','min'=>2014,'tooSmall'=>'系统于2014年启用，只记录之后的数据'),
            array('month','numerical','max'=>12,'min'=>1,'tooBig'=>'月份值应当小于12','tooSmall'=>'月份值应当小于1'),
        );
    }
}