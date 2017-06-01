<?php

namespace GingerPayments\AddressBook\Utils;

trait ArraysUtils {
    /**
     * @param array $values
     *
     * @return array
    */
    public static function createListFromArray($values) {
        $list = array();
        foreach($values as $value) {
            array_push($list, new static($value));
        }
        return $list;
    }
}