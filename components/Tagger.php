<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 11.03.2018
 * Time: 16:51
 */

namespace app\components;

use Yii;

class Tagger
{
    public $labelsList = [];
    public $labelsByImg = [];

    public function getLabels($pathImg, $vision)
    {
        $result = [];
# Prepare the image to be annotated
        $image = $vision->image(fopen($pathImg, 'r'), [
            'LABEL_DETECTION'
        ]);

# Performs label detection on the image file
        $labels = $vision->annotate($image)->labels();

        foreach ($labels as $label) {
            $labelDescription = $label->description();

            if (array_key_exists($labelDescription, $this->labelsList)) {
                $result[$labelDescription]++;
                $this->labelsList[$labelDescription]++;
            } else {
                $result[$labelDescription] = 1;
                $this->labelsList[$labelDescription] = 1;
            }
        }

        return $result;
    }

    public function getImages()
    {
        $directory = Yii::getAlias('@gvision/img');    // Папка с изображениями
        $allowed_types = Yii::$app->params['allowed_types_for_tagger'];  //разрешеные типы изображений
        $file_parts = [];
        $result = [];
        $ext = "";
        $title = "";

        $dir_handle = @opendir($directory) or die("Ошибка при открытии папки!");

        while ($file = readdir($dir_handle)) {
            if ($file == "." || $file == "..") continue;  //пропустить ссылки на другие папки
            $file_parts = explode(".", $file);
            $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение

            if (in_array($ext, $allowed_types)) {
                $result[$directory . '/' . $file] = $file;
            }
        }
        closedir($dir_handle);  //закрыть папку

        return $result;
    }

}




/*

namespace app\components;

use Yii;

class Tagger
{
    public $labelsList = [];

    public function getLabels($pathImg, $vision)
    {
# Prepare the image to be annotated
        $image = $vision->image(fopen($pathImg, 'r'), [
            'LABEL_DETECTION'
        ]);

# Performs label detection on the image file
        $labels = $vision->annotate($image)->labels();

        $result = [];
        foreach ($labels as $label) {
            $labelDescription = $label->description();

            if (array_key_exists($labelDescription, $this->labelsList)) {
                $result[$labelDescription]++;
                $this->labelsList[$labelDescription]++;
            } else {
                $result[$labelDescription] = 1;
                $this->labelsList[$labelDescription] = 1;
            }
        }

        return $result;
    }

    public function getImages()
    {
        $directory = Yii::getAlias('@gvision/img');    // Папка с изображениями
        $allowed_types = Yii::$app->params['allowed_types_for_tagger'];  //разрешеные типы изображений
        $file_parts = [];
        $result = [];
        $ext = "";
        $title = "";

        $dir_handle = @opendir($directory) or die("Ошибка при открытии папки!");

        while ($file = readdir($dir_handle)) {
            if ($file == "." || $file == "..") continue;  //пропустить ссылки на другие папки
            $file_parts = explode(".", $file);
            $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение

            if (in_array($ext, $allowed_types)) {
                $result[$directory . '/' . $file] = $file;
            }
        }
        closedir($dir_handle);  //закрыть папку

        return $result;
    }

    public function getLabelList() {

    }

}