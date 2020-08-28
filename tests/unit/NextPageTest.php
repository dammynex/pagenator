<?php

use Dammynex\Pagenator\Pagenator;

$pagenator = new Pagenator();

test('has next page', function() use ($pagenator) {
    $pagenator->setTotalPages(4);
    $pagenator->setCurrentPage(2);
    $this->assertTrue($pagenator->hasNextPage());
});

test('does not have next page', function() use ($pagenator) {
    $pagenator->setTotalPages(7);
    $pagenator->setCurrentPage(7);
    $this->assertFalse($pagenator->hasNextPage());
});

test('next page is correct', function() use ($pagenator) {
    $pagenator->setTotalPages(12);
    $pagenator->setCurrentPage(6);
    $this->assertEquals($pagenator->getNextPage(), 7);
});