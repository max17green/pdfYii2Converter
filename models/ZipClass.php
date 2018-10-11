<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 11.10.2018
 * Time: 12:42
 */
namespace app\models;

use yii\base\Model;
use ZipArchive;

class ZipClass extends Model
{
    public $nameDir;
    private $nameZip;
    private $zip;
    public function rules()
    {
        return [
            [['nameDir'], 'required']
        ];
    }
    public function initZip()
    {
        if (file_exists($this->nameDir)) {
            //echo $this->nameDir;
            $this->nameZip = time().'.zip'; //название архива
            $this->zip = new \ZipArchive; // класс для работы с архивами
            return true;
        }
    }
    public function create()
    {
        return $this->zip -> open($this->nameZip, ZipArchive::CREATE);
    }
    public function addIn()
    {
        //echo $this->nameDir;
        $dir = opendir($this->nameDir); // открываем папку с файлами
        //echo "<pre>";
        while ($file = readdir($dir)) { // перебираем все файлы из нашей папки
            if ($file == '.' || $file == '..' || is_dir($this->nameDir."/".$file)) {
                continue;
            } else {
                //echo $pathdir."/".$file."\n";
                // и архивируем
                $this->zip -> addFile($this->nameDir."/index.html", "index.html");
                $this->zip -> addFile("js/jquery.min.js");
                $this->zip -> addGlob("slick/*.*");
                $this->zip -> addGlob("css/*.css");
                $this->zip -> addGlob("img/*.jpg");
                $this->zip -> addGlob("slick/fonts/*.*");
                $this->zip -> addGlob($this->nameDir."/images/*.jpg");
            }
        }
        $this->zip -> close(); // закрываем архив.
    }
    public function output()
    {
        header('Content-type: application/zip');
        header('Content-Disposition: attachment; filename="'.$this->nameZip.'"');
        readfile($this->nameZip);
    }
}