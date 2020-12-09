# PHP Validator LIVR Extra (uMotif Fork)
Extension wrapper for [umotif-public/php-validator-livr](https://github.com/umotif-public/php-validator-livr).

This library contains additional LIVR rules not found in the original uMotif package.

## Installation
Add the package via composer:
```bash
composer require umotif/php-livr-extra
```

## Usage
LIVR documentation can be found [here](https://github.com/umotif-public/php-validator-livr/blob/master/README.md).

### New Rules Functionality
This library contains the following new rules:

###`list_length`

(Based on [js-livr-extra-rules](https://github.com/koorchik/js-livr-extra-rules))

Checks that the value is a list and it contains required number of elements. You can pass exact number of elements required or a range.

Do not forget about "required" rule if you want the field to be required.

Example:

```json
{
    list1: ['required', { list_length: 10 }]; // List is required and should contain exactly 10 items,
    list2: {
        list_length: 10;
    } // List is not required but if it is present, it should contain exactly 10 items
    list3: {
        list_length: [3, 10];
    } // List is not required but if it is present, it should has from 3 to 10 items
}
```

Error codes: 'FORMAT_ERROR', 'TOO_FEW_ITEMS', 'TOO_MANY_\ITEMS'

## Tests
To run all tests, enter `php ./vendor/bin/phpunit --verbose`.