<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 06.10.2018
 * Time: 21:24
 */

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\base\InvalidConfigException;

class FileClass extends Model
{
    //public $par1;
    public $name;
    public $pdf;
    public $countPages;
    private $width;
    private $height;
    public $nameDir;
    public $fileTempName;
    public function rules()
    {
        return [
            [['pdf'], 'file'],
            //[['par1'], 'required']
        ];
    }
    /*
    public function printM()
    {
        return $this->par1;
    }
    public function initFile() {
        //Буферизация для сохранения этого файла
        ob_start();
        //Генерируем имя папки
        $this->nameDir = rand(0, 10000000);
        //echo $this->nameDir;
        mkdir($this->nameDir);
    }*/
    public function getCountPages($fileTempName)
    {
        $f = fopen($fileTempName, "r");
        while (!feof($f)) {
            $line = fgets($f, 255);
            if (preg_match('/\/Count [0-9]+/', $line, $matches)) {
                preg_match('/[0-9]+/', $matches[0], $matches2);
                if ($count < $matches2[0]) {
                    $count = $matches2[0];
                }
            }
        }
        fclose($f);
        return $count;
    }
}