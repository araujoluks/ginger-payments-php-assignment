<?php

namespace GingerPayments\AddressBook\Person;

use GingerPayments\AddressBook\Utils\ArraysUtils;

final class PhoneNumber {
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
    public function getPhoneNumber() {
        return $this->value;
    }
}