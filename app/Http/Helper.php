<?php
namespace App\Http;

class Helper {
    public static function biorunRegex($filename,$accession,$alias) {

        $split = explode(".",$filename);
        if (str_contains($filename, "R1")) {
            $split[0] = "{$accession}_{$alias}_R1";
        } elseif (str_contains($filename, "R2")) {
            $split[0] = "{$accession}_{$alias}_R2";
        } else {
            $split[0] = "{$accession}_{$alias}";
        }
        $finalName =  join(".",$split);

        return $finalName;
    }
}