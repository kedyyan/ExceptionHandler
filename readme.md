ExceptionHandler
================

A simple exception handler for PHP.

## Mechanism

Here is a way of how to use this component.

```php
<?php

// Import the library
require_once 'ExceptionHandler.php';

// Create a new exception handler
$exc = new ExceptionHandler;

// Start it with the template you want to use
$exc->start('example/template.html');

```

You can design your own template watching how it is made in the "example/" folder.

## License

Aenyhm's ExceptionHandler is licensed under the MIT license.