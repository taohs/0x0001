<?php
/**
 * Created by PhpStorm.
 * User: taohaisong
 * Date: 14/11/7
 * Time: 上午12:47
 */
class FileController extends Controller{

    public function actionIndex(){}
    public function actionList(){

        $dataProvider = new CActiveDataProvider('Company',array(
            'criteria'=>array(
                //'with'=>array('role0','company0')
            ),
            'countCriteria'=>array(
                //'condition'=>'status=1',
                // 'order' and 'with' clauses have no meaning for the count query
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
            'sort' => array (
                'defaultOrder' => 't.id asc'
            )
        ));

        //  Yii::app()->clientScript->registerCoreScript('jquery');
        $renderData = array('dataProvider'=>$dataProvider,'controlName'=>'123','actionName'=>'1');
        $this->layout = 'admin_tpl_right';
        $this->render('list',$renderData);
    }
    public function actionUpload(){
        $model = new FileForm(FileForm::SCENARIO_CSV);
        if(isset($_POST['FileForm'])){
            $model->attributes = $_POST['FileForm'];
            $model->file = CUploadedFile::getInstance($model,'file');
            if($model->validate()){
                echo 'upload';
                if(!is_dir(UPLOAD_ADDRESS.'/' .$model->getScenario())){
                    mkdir(UPLOAD_ADDRESS.'/' .$model->getScenario());
                }
                $name = uniqid();
                $namePath = UPLOAD_ADDRESS.'/' .$model->getScenario().'/'.$name.'.'.$model->file->extensionName;
                $model->file->saveAs($namePath);

                $xls = "/Users/taohaisong/Projects/Php/0x0001/protected/extensions/phpexcelreader/example.xls";
                Yii::import('ext.phpexcelreader.JPhpExcelReader');
                //$data = new JPhpExcelReader(UPLOAD_ADDRESS.'/' .$model->getScenario().'/'.$name.'.'.$model->file->extensionName);
               // $data = new JPhpExcelReader($xls);
              //  echo $data->dump(true,true);
                $csv= "/Users/taohaisong/Projects/Php/0x0001/protected/extensions/phpexcelreader/example.csv";

                $file = fopen($namePath,'r');
                $i=0;
                while ($data = fgetcsv($file)) { //每次读取CSV里面的一行内容
//print_r($data); //此为一个数组，要获得每一个数据，访问数组下标即可
                    if($i==0){
                        $hear=$data;
                    }else {
                        for($m=0,$n=count($hear);$m<$n;$m++){
                            $arr[$hear[$m]]=$data[$m];
                        }
                        $goods_list[] = $data;
                        $dataModel = new Data();
                        $dataModel->attributes =$arr;
                        if($dataModel->validate()){
                            $dataModel->save();
                        }
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->code = $data['1'];
                        //$dataModel->name = $data['2'];
                        //$dataModel->format = $data['3'];
                        //$dataModel->unit = $data['4'];
                        //$dataModel->last_number = $data['5'];
                        //$dataModel->current_number = $data['6'];
                        //$dataModel->unpaid_debts = $data['7'];
                        //$dataModel->no_unpaid_debts = $data['8'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];
                        //$dataModel->company_code = $data['0'];

                    }
                    $i++;
                }
//print_r($goods_list);

                /* foreach ($goods_list as $arr){
                    if ($arr[0]!=""){
                        echo $arr[0]."<br>";
                    }
                } */
                print_r($goods_list);

                fclose($file);

                die('uploaded');
            }else{
                $error = $model->getErrors();
                var_dump($error);
                die('fail');
            }
        }
        $this->render('upload',array('model'=>$model));
    }
    public function actionDownload(){}
    public function insertInfo(){}
    /**
     * nav
     */
    public function actionLeft(){
        $this->layout="admin_tpl_left";
        $this->render('left');
    }
}