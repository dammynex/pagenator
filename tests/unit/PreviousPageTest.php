<?php

use Dammynex\Pagenator\Pagenator;

$pagenator = new Pagenator();

test('has previous page', function() use ($pagenator) {
    $pagenator->setTotalPages(10);
    $pagenator->setCurrentPage(2);
    $this->assertTrue($pagenator->hasPreviousPage());
});

test('does not have previous page', function() use ($pagenator) {
    $pagenator->setTotalPages(5);
    $pagenator->setCurrentPage(1);
    $this->assertFalse($pagenator->hasPreviousPage());
});

test('previous page is correct', function() use ($pagenator) {
    $pagenator->setTotalPages(7);
    $pagenator->setCurrentPage(6);
    $this->assertEquals($pagenator->getPreviousPage(), 5);
});