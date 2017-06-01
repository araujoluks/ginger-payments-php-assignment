# Ginger Payments PHP Assignment

## Requirements

* PHP 5.4 or later.
* Composer

## How to install

After cloning this repository, go to its root folder and run this command:

```
composer install
```

## How to run

Include composer autoloader:

```
include_once "ginger-payments-php-assignment/vendor/autoload.php";
```

Then create a new Address Book:

```
use \GingerPayments\AddressBook;
$addressBook = new AddressBook\AddressBook("My Address Book");
```

### Adding a person

To add a person, you can do this:

```
$person = $addressBook->addPerson("Lucas", "Araujo");
```

### Adding a group

To add a group, it's as easy as adding a person:

```
$group = $addressBook->addGroup("Just a test group");
```

### Find group's members

```
$group->getPersons();
```

### Find person's groups

```
$person->getGroups();
```

### Find a person by name

```
$addressBook->getPersonByName("Lucas");
$addressBook->getPersonByName("", "Araujo");
```

### Find a person by email (substring)

```
$addressBook->getPersonByEmail("luksde.ara");
$addressBook->getPersonByEmail("luk");
```

### Run the tests

You should run these commands:

```
composer install --dev
./vendor/bin/phpunit
```


## Design-only question

* Find person by email address (can supply any substring, ie. "comp" should work assuming "alexander@company.com" is an email address in the address book) - discuss how you would implement this without coding the solution.

I would use PHP's native function strpos(). For example:

```
if(strpos($email->getEmail(), $query)
```
