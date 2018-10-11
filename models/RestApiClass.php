<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 11.10.2018
 * Time: 22:39
 */

namespace app\models;

use yii\base\Model;


class RestApiClass extends Model
{
    public $nameDir;
    public function rules()
    {
        return [
            [['nameDir'], 'required']
        ];
    }
    public function getRestApi()
    {
            if (file_exists($this->nameDir)) {
                $path = $this->nameDir."/images";
                $files = scandir($path);
                //print_r($files);
                foreach ($files as $file) {
                    if ($file == '.' || $file == '..' || is_dir($path . $file)) {
                        continue;
                    } else {
                        $arr[] = $path."/".$file;
                    }
                }
                return json_encode($arr);
            }
    }
}