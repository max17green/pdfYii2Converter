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
    public $name;
    public $pdf;
    public $countPages;
    private $width;
    private $height;
    private $nameDir;
    public $fileTempName;
    public function rules()
    {
        return [
            [['pdf'], 'file'],
        ];
    }
    public function initFile() {
        //Буферизация для сохранения этого файла
        ob_start();
        //Генерируем имя папки
        $this->nameDir = rand(0, 10000000);
        //echo $this->nameDir;
        mkdir($this->nameDir);
    }
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
    public function getWidthHeight($fileTempName)
    {
        $this->width = shell_exec("identify -format %W ".$fileTempName."[0]");
        $this->height = shell_exec("identify -format %H ".$fileTempName."[0]");
    }
    public function generateImages($fileTempName)
    {
        opendir($this->nameDir);
        mkdir($this->nameDir."/images");
        //Нашинковать файл на jpeg
        $command = "convert -density 250 ".$fileTempName." -crop ".
            strval($this->width*4)."x".strval($this->height*4)." ".$this->nameDir.
            "/images/i%d.jpg";
        //echo $command;
        exec($command);
    }
    public function printImages()
    {
        $str = '';
        $files = scandir($this->nameDir."/images");
        //Вставка картинок в галерею
        foreach ($files as $file) {
            if ($file == '.' || $file == '..' || is_dir($this->nameDir."/images" . $file)) {
                continue;
            } else {
                $str .= "<div>";
                $str .= "<img data-lazy='".$this->nameDir."/images"."/".$file."' class='img_slide'>";
                $str .= "</div>\n";
            }
        }
        return $str;
    }
    public function getNameDir() {
        return $this->nameDir;
    }
}