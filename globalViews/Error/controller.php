<style>
    <?php require_once('view/view.css'); ?>
</style>
<?php
    if(!isset($_GET['err_code'])){
        $_GET['err_code'] = 500;
    }
    if(!isset($_GET['message'])){
        $_GET['message'] = getErrorDescription($_GET['err_code']);
    }
    require_once('view/view.php');

    function getErrorDescription($err_code){
        $errors = [
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Time-out',
            409 => 'Conflict',
            410 => 'Gone',
            500 => 'Internal Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Time-out',
            505 => 'HTTP Version not supported'
        ];
        return $errors[$err_code];
    }
?>