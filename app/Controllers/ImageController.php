<?php

namespace App\Controllers;

use Intervention\Image\ImageManagerStatic as IImage;

class ImageController extends MainController
{
    protected $origin = PUBLIC_PATH . '/photo-original.jpg';
    protected $result = PUBLIC_PATH . '/photo.jpg';
    protected $sample = PUBLIC_PATH . '/Sample.png';

    public function index()
    {
        // Подключаем вид
        $this->view->render('index');
        return true;
    }

    public function process()
    {
        $image = IImage::make($this->origin);
//            ->rotate(45);
        $image->insert($this->sample);


        $watermark = IImage::make($this->result);
        $image->insert($watermark, 'center');

        $image->insert($this->result, 'bottom-right', 10, 10)
                ->resize(200, 200)

                ->save($this->result, 100);

        echo 'succes';
    }

}