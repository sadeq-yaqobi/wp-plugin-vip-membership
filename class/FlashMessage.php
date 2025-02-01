<?php

class FlashMessage
{
    const ERROR = 0;
    const SUCCESS = 1;

    public static function addMsg($message = null, $type)
    {
        if (isset($_SESSION['flash_message'])) {
            $_SESSION['flash_message'] = [
                'message' => $message,
                'type' => $type
            ];
        } else {
            $_SESSION['flash_message'] = [];
            $_SESSION['flash_message'] = [
                'message' => $message,
                'type' => $type
            ];
        }
    }

    public static function showMsg()
    {
        $message = '';
        if (isset($_SESSION['flash_message'])) {
            if ($_SESSION['flash_message']['type'] === self::SUCCESS) {
                $message = '
                    <div class="uk-alert-success" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>'.$_SESSION['flash_message']['message'].'</p>
                    </div>';
            } elseif ($_SESSION['flash_message']['type'] === self::ERROR) {
                $message = '
                    <div class="uk-alert-danger" uk-alert>
                        <a href class="uk-alert-close" uk-close></a>
                        <p>'.$_SESSION['flash_message']['message'].'</p>
                    </div>';
            }
            self::clearMsgSession();
        }
        return $message;
    }

    public static function clearMsgSession()
    {
        unset($_SESSION['flash_message']);
    }
}