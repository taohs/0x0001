<?php
class ApiController extends CController{

    function actionIndex(){
        header('Accept: vnd.example-com.foo+json; version=1.0');
        header('Content-Type: application/json,asdfasdf');
        echo json_encode(array('id'=>1,'name'=>'taohaisong'));

        die();//echo time();
    }
}

