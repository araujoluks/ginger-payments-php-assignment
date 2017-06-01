<?php

namespace GingerPayments\AddressBook\Person;

use GingerPayments\AddressBook\Utils\ArraysUtils;

final class Address {
    use ArraysUtils;
    
    /**
     * @var string
     */
    private $value;
    
    /**
     * @param string $value
     */
    public function __construct($value) {
        $this->value = (string) $value;
    }
    
    /**
     * @return string
    */
    public function getAddress() {
        return $this->value;
    }

}