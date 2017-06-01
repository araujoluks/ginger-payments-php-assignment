<?php
namespace GingerPayments\AddressBook\Tests;
use GingerPayments\AddressBook;

final class AddressBookTest extends \PHPUnit_Framework_TestCase {
    /**
     * @var AddressBook
     */
    private $addressBook;
    
    public function setUp() {
        $this->addressBook = new AddressBook\AddressBook("Lucas Address Book");
    }
    
    /**
     * @test
     */
    public function testAddressBook() {
        $this->expectOutputString("Lucas Address Book");
        print $this->addressBook->getName();
    }
    
   /**
     * @expectedException InvalidArgumentException
     */
    public function testException() {
        $this->addressBook->name("");
    }
    
    /**
     * @test
     */
    public function testPerson() {
        $person = $this->addressBook->addPerson("Lucas", "Araujo");
        $person->addAddress("Ginger Payments Office");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $person);
        $this->assertEquals("Lucas", $person->getFirstName());
        $this->assertEquals("Araujo", $person->getLastName());

        foreach($person->getAddresses() as $address) {
            $this->assertEquals("Ginger Payments Office", $address->getAddress());
        }
    }
    
     /**
     * @test
     */
    public function testGroup() {
        $group = $this->addressBook->addGroup("My Contacts");
        $this->assertInstanceOf("GingerPayments\AddressBook\Group", $group);
    }
    
    /**
     * @test
     */
    public function testAddPersonToGroup() {
        $groupName = "MyGroup";
        $person = $this->addressBook->addPerson("Lucas", "Araujo");
        $person->addAddress("Ginger Payments Office");
        $this->addressBook->addPersonToGroup($person, $groupName);
        
        $groups = $this->addressBook->getGroups();
        $personsByGroup = $this->addressBook->getPersonsByGroupName($groupName);
        
        $this->assertEquals($groupName, $groups[0]->getName());
        $this->assertEquals($person, $personsByGroup[0]);
        $this->assertTrue($person->isGroupMember($groupName));
    }
    
    /**
     * @test
     */
    public function testListMembersByGroup() {
        $this->addressBook = new AddressBook\AddressBook("Lucas Address Book 2");
        $groupName = "Another group I created";
        
        $testPerson = $this->addressBook->addPerson("Lucas", "Araujo");
        $testPerson->addAddress("Amsterdam");
        $this->addressBook->addPersonToGroup($testPerson, $groupName);
        
        $testPerson = $this->addressBook->addPerson("Sil", "Bartlema");
        $testPerson->addAddress("Amsterdam");
        $this->addressBook->addPersonToGroup($testPerson, $groupName);
        
        $personsByGroup = $this->addressBook->getPersonsByGroupName($groupName);
        
        foreach($personsByGroup as $person) {
            $this->assertInstanceOf("GingerPayments\AddressBook\Person", $person);
        }
    }
    
    /**
     * @test
     */
    public function testListByGroupsByPerson() {
        $this->addressBook = new AddressBook\AddressBook("Lucas Address Book 3");
        $groupName = "Another group I created";
        $groupNameTwo = "Just another group...";
        
        $testPerson = $this->addressBook->addPerson("Lucas", "Araujo");
        $testPerson->addAddress("Amsterdam");
        $this->addressBook->addPersonToGroup($testPerson, $groupName);
        $this->addressBook->addPersonToGroup($testPerson, $groupNameTwo);
        
        $groups = $testPerson->getGroups();
        
        foreach($groups as $group) {
            $this->assertInstanceOf("GingerPayments\AddressBook\Group", $group);
        }
    }
    
    /**
     * @test
     */
    public function testFindPersonByName() {
        $this->addressBook = new AddressBook\AddressBook("Lucas Address Book 3");
        
        $this->addressBook->addPerson("Lucas", "Araujo")->addAddress("Natal / Brazil");
        $this->addressBook->addPerson("Sil", "Bartlema")->addAddress("Amsterdam");

        $persons = $this->addressBook->getPersonByName("Sil");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $persons[0]);
        $persons = $this->addressBook->getPersonByName("", "Bartlema");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $persons[0]);
        
        $persons = $this->addressBook->getPersonByName("Lucas");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $persons[0]);
        $persons = $this->addressBook->getPersonByName("", "Araujo");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $persons[0]);
    }
    
    /**
     * @test
     */
    public function testFindPersonByEmail() {
        $this->addressBook = new AddressBook\AddressBook("Lucas Address Book 3");
        
        $this->addressBook->addPerson("Lucas", "Araujo")->addEmail("luksde.araujo@gmail.com");
        $this->addressBook->addPerson("Random", "Person")->addEmail("anothertest@gmail.com");

        $persons = $this->addressBook->getPersonByEmail("luks");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $persons[0]);
        $persons = $this->addressBook->getPersonByEmail("anot");
        $this->assertInstanceOf("GingerPayments\AddressBook\Person", $persons[0]);
    }
    
    
}