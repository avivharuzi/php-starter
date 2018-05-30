<?php

class MessageHandler {
    private function __construct() {
    }

    private function base($type, $symbol, $msg) {
        $response =
        "<div class='alert alert-{$type} alert-dismissible fade show'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
        if (is_array($msg)) {
            foreach ($msg as $value) {
                $response .= "<p class='lead'><i class='fa fa-{$symbol} mr-2'></i>$value</p>";
            }
        } else {
            $response .= "<p class='lead'><i class='fa fa-{$symbol} mr-2'></i>$msg</p>";
        }
        $response .= "</div>";
        return $response;
    }

    public static function danger($msg) {
        return self::base("danger", "exclamation-circle", $msg);
    }
    
    public static function warning($msg) {
        return self::base("warning", "exclamation-triangle", $msg);
    }
    
    public static function info($msg) {
        return self::base("info", "info-circle", $msg);
    }
    
    public static function success($msg) {
        return self::base("success", "check-circle", $msg);
    }
}

?>
