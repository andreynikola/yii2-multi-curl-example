<?php

namespace app\controllers;

use yii\web\Controller;
use pahanini\curl\Request;
use pahanini\curl\Multi;

class SiteController extends Controller
{

    /**
     * @throws \pahanini\curl\Exception
     */
    public function actionIndex()
    {

        $threads = 100;

        $multi = new Multi();
        $multi->stackSize = 1000;

        $post = [
            'username' => 'user',
            'password' => 'password',
            'gender'   => 1,
        ];

        for ($i=0; $i < $threads; $i++) { 
            $request[$i] = new Request();

            $request[$i]->setOptions(
                [
                    CURLOPT_TIMEOUT_MS => 100,
                    CURLOPT_REFERER => 'http://github.com',
                    CURLOPT_URL => 'https://curl',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => $post,
                    
                ]
            );

            $multi->add($request[$i]);
        }

        $multi->execute();

        for ($i=0; $i < $threads; $i++) { 
            $response[$i] = $request[$i]->getResponse();
        }
        
        var_dump($response);

    }
}