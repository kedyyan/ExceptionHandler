ExceptionHandler
================

A simple exception handler for PHP.

## Mechanism

Here is a example of how to use it.

```php
<?php

require_once 'ExceptionHandler.php';                // Call the ExceptionHandler file
$exceptionHandler = new ExceptionHandler;           // Create a new one

$exceptionHandler->start('example/template.html');  // Start it using a template

throw new Exception('You failed!');                 // Test it!
```

An example of how is made a template can be found in the "example/" folder.

## New feature

I have added a new feature: you can now treat errors as exceptions.

```php
<?php

$exceptionHandler->handleErrorsWithLevel(-1);       // Transform errors into exceptions

$result = 2 / 0;                                    // Test it!
```

## Compatibility

You will need PHP5.3 or higher as it uses closures, namespaces and SPL exceptions.

## License

Aenyhm's ExceptionHandler is licensed under the MIT license.