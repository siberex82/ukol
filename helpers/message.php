<?php

namespace helpers;


class message {

    public static $message;

    public static function set($text)
    {
        self::$message= $text;
    }

    public static function show()
    {
        global $html;

        $script = "<div class='alert'>".self::$message."</div> 
                   <script>
                     setTimeout(function() {
                         $('.alert').detach()
              
                     },3000);
                   </script>
                  ";

        if(!empty(self::$message)) {
            $html = str_replace("<alert></alert>", $script, $html);
        }

        return $html;
    }
}