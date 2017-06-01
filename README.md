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
include_once 'ginger-payments-php-assignment/vendor/autoload.php';
```

Then create a new Address Book:

```
use \GingerPayments\AddressBook;
$addressBook = new AddressBook\AddressBook('My Address Book');
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

### Find Group's members

```
$group->getPersons();
```

### Find Person's groups

```
$person->getGroups();
```

