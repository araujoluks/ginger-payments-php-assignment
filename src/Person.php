<?php

namespace GingerPayments\AddressBook;

final class Person {
    /**
     * @var string
     */
    private $firstName;
    
    /**
     * @var string
     */
    private $lastName;
    
    /**
     * @var array
     */
    private $addresses;
    
    /**
     * @var array
     */
    private $emails;
    
    /**
     * @var array
     */
    private $phoneNumbers;
    
    /**
     * @var array
     */
    private $groups;
    
    /**
     * @param string $firstName Person's first name
     * @param string $lastName Person's last name
     * @param array $addresses A list of addresses
     * @param array $emails A list of emails
     * @param array $phoneNumbers A list of phone numbers
     * @param array $groups A list of groups
    */
    private function __construct(
        $firstName,
        $lastName,
        $addresses = null,
        $emails = null,
        $phoneNumbers = null,
        $groups = null
    )
    {
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->addresses = $addresses;
		$this->emails = $emails;
		$this->phoneNumbers = $phoneNumbers;
		$this->groups = $groups;
	}
	
    /**
     * @param string $firstName Person's first name
     * @param string $lastName Person's last name
     * @param array $addresses A list of addresses
     * @param array $emails A list of emails
     * @param array $phoneNumbers A list of phone numbers
     */
	public function create($firstName, $lastName, $addresses, $emails, $phoneNumber) {
        return new self(
	       $firstName,
	       $lastName,
	       $addresses ? Person\Address::createListFromArray($addresses) : [],
	       $emails ? Person\Email::createListFromArray($emails) : [],
	       $phoneNumbers ? Person\PhoneNumber::createListFromArray($phoneNumbers) : [],
	       []
        );
	}
	
	/**
     * @return string
    */
	public function getFirstName() {
	    return $this->firstName;
	}
	
	/**
     * @param string
    */
	public function firstName($value) {
	    Validation::notValid($value);
	    $this->firstName = $value;
	}
	
	/**
     * @return string
    */
	public function getLastName() {
	    return $this->lastName;
	}
	
	/**
     * @param string
    */
	public function lastName($value) {
	    Validation::notValid($value);
	    $this->lastName = $value;
	}
	
	/**
     * @return array
    */
	public function getAddresses() {
	    return $this->addresses;
	}
	
	/**
     * @param string
    */
	public function addAddress($value) {
	    Validation::notValid($value);
	    $address = new Person\Address($value);
	    array_push($this->addresses, $address);
	}
	
	/**
     * @return array
    */
	public function getEmails() {
	    return $this->emails;
	}
	
	/**
     * @param string
    */
	public function addEmail($value) {
	    Validation::notValid($value);
	    $email = new Person\Email($value);
	    array_push($this->emails, $email);
	}
	
	/**
     * @return array
    */
	public function getPhoneNumbers() {
	    return $this->phoneNumbers;
	}
	
	/**
     * @param string
    */
	public function addPhoneNumber($value) {
	    Validation::notValid($value);
	    $phoneNumber = new Person\PhoneNumber($value);
	    array_push($this->phoneNumbers, $phoneNumber);
	}

    /**
     * @return array
    */
	public function getGroups() {
	    return $this->groups;
	}
	
	/**
     * @param Group
    */
	public function addGroup($group) {
	    array_push($this->groups, $group);
	}
	
	/**
     * @param string Group name.
     * @return boolean
    */
	public function isGroupMember($name) {
	    foreach($this->groups as $group) {
	        if($group->getName() == $name)
	            return true;
	    }
	    return false;
	}
    
}