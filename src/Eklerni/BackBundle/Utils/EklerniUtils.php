<?php

namespace Eklerni\BackBundle\Utils;


class EklerniUtils {
    static function stripAccents($string){
        return strtr(
            $string,
            'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
            'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'
        );
    }

    static function stripSpace($string){
        return str_replace(' ','', $string);
    }
    static function cleanUsername($string) {
        return strtolower(self::stripAccents(self::stripSpace($string)));
    }
} 