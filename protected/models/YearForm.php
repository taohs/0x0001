<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/12/1
 * Time: 下午9:46
 */
class YearForm extends CFormModel{

    public $year;

    function rules(){
        return array(
            array('year','required'),
            array('year','length','min'=>4,'max'=>4),
            array('year','numerical'),
        );
    }
}