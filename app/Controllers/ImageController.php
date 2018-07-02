<?php

namespace App\Controllers;

use Intervention\Image\ImageManagerStatic as IImage;

class ImageController extends MainController
{
    protected $origin = PUBLIC_PATH . '/photo-original.jpg';
    protected $result = PUBLIC_PATH . '/photo.jpg';

    public function index()
    {
        // Подключаем вид
        $this->view->render('index');
        return true;
    }

    public function process()
    {
        $image = IImage::make($this->origin)
            ->rotate(45);

        $image->insert('Sample.png');
        $watermark = Image::make($this->result);
        $image->insert($watermark, 'center');

// insert watermark at bottom-right corner with 10px offset
        $image->insert('Sample.png', 'bottom-right', 10, 10)
//            ->text('SALE')
//        $image->text('photo_origin', 0, 0, function ($font) {
//            $font->file('arial.ttf');
//            $font->size(24);
//            $font->color('#fdf6e3');
//            $font->align('center');
//            $font->valign('top');
//        })
            ->resize(200, 200)
            ->save($this->result, 100);

        echo 'succes';
    }

    public function watermark()
    {
        $img = Image::make($this->origin);

// write text
        $img->text('SALE');

// use callback to define details
        $img->text('photo_origin', 0, 0, function ($font) {
            $font->file('arial.ttf');
            $font->size(24);
            $font->color('#fdf6e3');
            $font->align('center');
            $font->valign('top');
        })
            ->save($this->result, 80);


    }


}