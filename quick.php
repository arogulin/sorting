<?php

/**
 * Class Quick
 *
 * Quick sort, based on http://en.wikipedia.org/wiki/Quicksort
 */
class Quick {

    /**
     * @param array $array
     * @param bool  $reverse
     */
    public static function sort(array & $array, $reverse = false) {
        if (count($array) <= 1) {
            // Nothing to sort
            return;
        }
        $pivot = array_pop($array);
        $lessThenPivot = array();
        $greaterThenPivot = array();
        foreach ($array as $num) {
            if ($num <= $pivot) {
                $lessThenPivot[] = $num;
            } else {
                $greaterThenPivot[] = $num;
            }
        }
        self::sort($lessThenPivot, $reverse);
        self::sort($greaterThenPivot, $reverse);
        if ($reverse) {
            $array = array_merge($greaterThenPivot, array($pivot), $lessThenPivot);
        } else {
            $array = array_merge($lessThenPivot, array($pivot), $greaterThenPivot);
        }
    }
}

$a = array(170, 45, 75, 90, 802, 2, 1024, 24, 66);
Quick::sort($a);
var_dump($a);