# dammynex/pagenator

Pagenator is a simple php pagination library

```php
<?php

use Dammynex\Pagenator\Pagenator;

$pagenator = new Pagenator();
$pagenator->setTotalPages(10);
$pagenator->setCurrentPage(1);

$pages = $pagenator->getPages();
//returns Brainex\Pagenator\PageItem[]
```