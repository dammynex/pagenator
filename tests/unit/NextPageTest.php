<?php

use Dammynex\Pagenator\Pagenator;

$pagenator = new Pagenator();

test('has next page', function() use ($pagenator) {
    $pagenator->setItemsCount(400);
    $pagenator->setPerPage(10);
    $pagenator->setCurrentPage(2);
    $this->assertTrue($pagenator->hasNextPage());
});

test('does not have next page', function() use ($pagenator) {
    $pagenator->setItemsCount(190);
    $pagenator->setPerPage(10);
    $pagenator->setCurrentPage(20);
    $this->assertFalse($pagenator->hasNextPage());
});

test('next page is correct', function() use ($pagenator) {
    $pagenator->setItemsCount(100);
    $pagenator->setPerPage(20);
    $pagenator->setCurrentPage(4);
    $this->assertEquals($pagenator->getNextPage(), 5);
});