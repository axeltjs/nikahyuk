<?php
namespace App\Http\Controllers\Traits;
use Session;

trait TraitMessage
{
    /**
     * Session Message
     * 
     * @return Session
     */

    private function message($message, $type = "success")
    {
        Session::flash("flash_notification", [
            "level"=> $type,
            "message"=> $message
        ]);
    }
}
