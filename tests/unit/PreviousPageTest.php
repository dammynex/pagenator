<?php

use Dammynex\Pagenator\Pagenator;

$pagenator = new Pagenator();

test('can calculate total pages', function () use ($pagenator) {
    $pagenator->setItemsCount(100);
    $pagenator->setPerPage(10);
    $this->assertEquals(10, $pagenator->getTotalPages());
});

test('has previous page', function() use ($pagenator) {
    $pagenator->setItemsCount(200);
    $pagenator->setPerPage(10);
    $pagenator->setCurrentPage(2);
    $this->assertTrue($pagenator->hasPreviousPage());
});

test('does not have previous page', function() use ($pagenator) {
    $pagenator->setItemsCount(100);
    $pagenator->setCurrentPage(1);
    $this->assertFalse($pagenator->hasPreviousPage());
});

test('has pervious page', function() use ($pagenator) {
    $pagenator->setItemsCount(100);
    $pagenator->setPerPage(20);
    $pagenator->setCurrentPage(6);
    $this->assertEquals(5, $pagenator->getPreviousPage());
});