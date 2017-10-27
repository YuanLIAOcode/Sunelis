<?php
    function getExtension($filename){
        $parsed = explode('.',$filename);
        return $parsed[count($parsed)-1];
    }

    function isImage($filename){
        $ext = strtolower(getExtension($filename));
        $img_ext = array('bmp','tiff','jpeg','jpg','png');
        return in_array($ext,$img_ext);
    }

    function isTextFile($filename){
        $ext = strtolower(getExtension($filename));
        $text_ext = array('pdf','odf','docx','xslx','pptx','doc','xls','ptt','txt');
        return in_array($ext,$text_ext);
    }
?>