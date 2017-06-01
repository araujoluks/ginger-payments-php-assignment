<?php

namespace GingerPayments\AddressBook;

use GingerPayments\AddressBook\Utils\ArraysUtils;

final class Group {
    use ArraysUtils;
    
    /**
     * @var string
     */
    private $value;
    
    /**
     * @var array
     */
    private $persons;
    
    /**
     * @param string $value Group name
    */
    public function __construct($value) {
        $this->value = (string) $value;
        $this->persons = [];
    }
    
    /**
     * @param string $value Group name
     *
     * @return Group
    */
    public static function create($value) {
        return new static($value);
    }
    
    /**
     * @return string
    */
    public function getName() {
        return $this->value;
    }
    
    /**
     * @param Person $person
     */
    public function addPerson($person) {
        array_push($this->persons, $person);
    }
    
    /**
     * @return array
    */
    public function getPersons() {
        return $this->persons;
    }
}