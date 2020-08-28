# brainex/pagenator

Pagenator is a simple php pagination library

```php
<?php

$pagenator = new Pagenator();
$pagenator->setTotalPages(10);
$pagenator->setCurrentPage(1);

$pages = $pagenator->getPages();
//returns Brainex\Pagenator\PageItem[]
```