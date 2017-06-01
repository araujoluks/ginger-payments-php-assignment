<?php

namespace GingerPayments\AddressBook\Person;

use GingerPayments\AddressBook\Utils\ArraysUtils;

final class Email {
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
    public function getEmail() {
        return $this->value;
    }
}