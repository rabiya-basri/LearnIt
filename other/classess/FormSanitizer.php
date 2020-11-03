<?php
class FormSanitizer{
   public static function sanitizeFormString($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "" ,$inputText);
        //$inputText = trim($inputText); // to remove space from star and end of text
        $inputText = strtolower($inputText);
        $inputText = ucfirst($inputText);
        return $inputText;
        }
        public static function sanitizeFormUsername($inputText){
            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "" ,$inputText);
            return $inputText;
            }
            public static function sanitizeFormPassword($inputText){
                $inputText = strip_tags($inputText);
                return $inputText;
                }
                public function sanitizeFormEmail($inputText){
                    $inputText = strip_tags($inputText);
                    $inputText = str_replace(" ", "" ,$inputText);
                    return $inputText;
                    }
}
?>