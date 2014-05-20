<?php

namespace Eklerni\BackBundle\Utils;


class EklerniUtils {
    static function stripAccents($string){
        $string = htmlentities($string, ENT_NOQUOTES, 'UTF-8');

        $string = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
        $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string); // pour les ligatures e.g. '&oelig;'
        $string = preg_replace('#&[^;]+;#', '', $string); // supprime les autres caractères

        return $string;
    }

    static function stripSpace($string){
        return str_replace(' ','', $string);
    }
    static function cleanUsername($string) {
        return strtolower(self::stripAccents(self::stripSpace($string)));
    }
} 