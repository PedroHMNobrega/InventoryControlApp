<?php

namespace Estoque\Infra\Io;

class ImageHandler
{
    public static function validImg($img) {
        $type = $img['type'];
        if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png') {
            return true;
        }
        return false;
    }

    public static function uploadFile($file) {
        $formato = explode('.', $file['name']);
        $file['name'] = uniqid().'.'.$formato[count($formato)-1];
        if(move_uploaded_file($file['tmp_name'], UPLOADS_DIR . $file['name'])) {
            return $file['name'];
        }
        return false;
    }

    public static function removeFile($file) {
        @unlink(UPLOADS_DIR . $file);
    }
}