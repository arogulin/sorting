<?php

/**
 * Class Radix
 *
 * Radix sort, based on http://en.wikipedia.org/wiki/Radix_sort
 */
class Radix {

    const BASE = 10;

    /**
     * @param array $array Array to sort
     * @param bool  $reverse
     */
    public static function sort(array & $array, $reverse = false) {
        $passes = strlen((string)max($array));
        for ($digitNum = 0; $digitNum < $passes; $digitNum++) {
            $buckets = self::splitForBuckets($array, $digitNum, $reverse);
            $array = self::mergeBuckets($buckets);
        }
    }

    /**
     * @param      $array    Array to sort
     * @param      $digitNum Number of digit
     * @param bool $reverse
     * @return array Array, splitted for buckets by $digitNum
     */
    private static function splitForBuckets($array, $digitNum, $reverse = false) {
        $buckets = array_fill(0, self::BASE, null);
        if ($reverse) {
            krsort($buckets);
        }
        foreach ($array as $num) {
            $buckets[self::getDigit($num, $digitNum)][] = $num;
        }
        // Remove null elements
        $buckets = array_filter($buckets);
        return $buckets;
    }

    /**
     * @param array $buckets
     * @return array Buckets, merged in one array
     */
    private static function mergeBuckets(array $buckets) {
        $array = array();
        foreach ($buckets as $bucket) {
            $array = array_merge($array, $bucket);
        }
        return $array;
    }

    /**
     * @param $num
     * @param $digitNum
     * @return int Specific digit from $num
     */
    private static function getDigit($num, $digitNum) {
        $num = ($num / pow(self::BASE, $digitNum));
        return $num % self::BASE;
    }
}

$a = array(170, 45, 75, 90, 802, 2, 1024, 24, 66);
Radix::sort($a);
var_dump($a);