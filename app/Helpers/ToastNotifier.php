<?php 

namespace App\Helpers;

class ToastNotifier {

    private $type;
    private $title;
    private $message;
    private $callback;
    private $callbackArgs;

    public function __construct($type,$title,$message,$callback,$callbackArgs) {
        $this->type = $type;
        $this->title = $title;
        $this->message = $message;
        $this->callback = $callback;
        $this->callbackArgs = $callbackArgs;
    }


    public function NotificationToArray() {
        return  [
                    "type" => $this->type,
                    "title" => $this->title,
                    "message" => $this->message,
                ];
    }


    public function CallbackToArray() {
        return  [
                 "name" => $this->callback,
                 "args" => $this->callbackArgs,
                ];
    }


    public function toJson() {

        return response()->json([
                "notification" => $this->NotificationToArray(),
                "callback" =>  $this->CallbackToArray()
            ]);
    }

}