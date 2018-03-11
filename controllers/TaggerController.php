<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 11.03.2018
 * Time: 3:39
 */

namespace app\controllers;

use Yii;
use Google\Cloud\Vision\VisionClient;
use yii\web\Controller;

class TaggerController extends Controller
{
    public function actionIndex()
    {

        $vision = new VisionClient;
        $tagger = new Yii::$app->tagger; # создаем объект, используя зарегистрированный компонент

        $imageList = $tagger->getImages();

        foreach ($imageList as $pathImg => $image) {
            $tagger->labelsByImg[$image] = $tagger->getLabels($pathImg, $vision);
        }

        arsort($tagger->labelsList);

        return $this->render('index', ['tagger' => $tagger]);
    }

}


/*
 * namespace app\controllers;

use Yii;
use Google\Cloud\Vision\VisionClient;
use yii\web\Controller;

class TaggerController extends Controller
{
    public function actionIndex()
    {

        $vision = new VisionClient;
        $tagger = new Yii::$app->tagger; # создаем объект, используя зарегистрированный компонент

        $imageList = $tagger->getImages();

        foreach ($imageList as $pathImg => $image) {
            $labelsByImg[$image] = $tagger->getLabels($pathImg, $vision);
        }

        $labelsList = $tagger->labelsList;
        arsort($labelsList);

        return $this->render('index', ['labelsList' => $labelsList, 'labelsByImg' => $labelsByImg]);
    }

}
 */
