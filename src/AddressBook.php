<?php

namespace GingerPayments\AddressBook;

final class AddressBook {
	/**
     * @var string
     */
	private $name;
	
	/**
     * @var array
     */
	private $persons;
	
	/**
     * @var array
     */
	private $groups;
	
	/**
     * @param string $name Address Book name
    */
	public function __construct($name) {
		Validation::notValid($name);
		$this->name = $name;
		$this->persons = array();
		$this->groups = array();
	}
	
	/**
     * @return string
    */
	public function getName() {
		return $this->name;
	}
	
	/**
     * @param string
     */
	public function name($name) {
		Validation::notValid($name);
		
		$this->name = $name;
		return $this->name;
	}
	
	/**
     * @param string $firstName
     * @param string $lastName
     * @param array $addresses
     * @param array $emails
     * @param array $phoneNumbers
     * @param array $groups
     * 
     * @return Person
     */
	public function addPerson(
		$firstName,
		$lastName,
		$addresses = null,
		$emails = null,
		$phoneNumbers = null,
		$groups = null
	)
	{
		$person = Person::create($firstName, $lastName, $addresses, $emails, $phoneNumbers);
		array_push($this->persons, $person);
		
		if(is_array($groups)) {
			foreach($groups as $group) {
				self::addPersonToGroup($person, $group);
			}
		}
		
		return $person;
	}
	
	/**
     * @return array
     */
	public function getPersons() {
		return $this->persons;
	}
	
	/**
     * @param string @name
     * 
     * @return Group
     */
	public function addGroup($name) {
		$group = Group::create($name);
		array_push($this->groups, $group);
		return $group;
	}
	
	/**
     * @return array
     */
	public function getGroups() {
		return $this->groups;
	}
	
	/**
     * @param Person $person
     * @param string|Group $group
     */
	public function addPersonToGroup($person, $group) {
		if(!is_object($group) && is_string($group)) {
			$groupExists = false;
			foreach($this->groups as $aGroup) {
				if($aGroup->getName() == $group) {
					$groupExists = true;
					$group = $aGroup;
					break;
				}
			}
			if(!$groupExists) {
				$group = self::addGroup($group);
			}
		}

		$group->addPerson($person);
		$person->addGroup($group);
	}
	
	/**
     * @param string $firstName
     * @param string $lastName
     * 
     * @return array
     */
	public function getPersonByName($firstName = '', $lastName = '') {
		$items = array();
		foreach($this->persons as $person) {
			if(
				($firstName == $person->getFirstName() && $lastName == $person->getLastName()) ||
				($lastName == '' && $person->getFirstName() == $firstName) ||
				($firstName == '' && $person->getLastName() == $lastName)
			) {
				array_push($items, $person);
			}
		}
		return $items;
	}
	
	/**
     * @param string
     * 
     * @return array
     */
	public function getPersonByEmail($query) {
		$items = array();
		foreach($this->persons as $person) {
			foreach($person->getEmails() as $email) {
				if(substr($email->getEmail(), 0, strlen($query)) === $query) {
					array_push($items, $person);
				}
			}
		}
		return $items;
	}
	
	/**
     * @param string
     * 
     * @return array|null
     */
	public function getPersonsByGroupName($name) {
		if($name) {
			foreach($this->groups as $group) {
				if($group->getName() == $name) {
					return $group->getPersons();
				}
			}
			return null;
		}
	}
	
}