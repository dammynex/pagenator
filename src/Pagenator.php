<?php

namespace Brainex\Pagenator;

class Pagenator
{
    /** @var int */
    private $total_pages;

    /** @var int */
    private $current_page = 1;

    /** @var int */
    private $range = 5;

    /**
     * Class constructor
     *
     * @param integer $total_pages
     * @param integer $current_page
     */
    public function __construct(int $total_pages = 0, int $current_page = 0, int $range = 5)
    {
        $this->setTotalPages($total_pages);
        $this->setCurrentPage($current_page);
        $this->setRange($range);
    }

    /**
     * Set total pages
     *
     * @param integer $total_pages
     * @return boolean
     */
    public function setTotalPages(int $total_pages): bool
    {
        $this->total_pages = $total_pages;
        return true;
    }

    /**
     * Set current page
     *
     * @param integer $current_page
     * @return boolean
     */
    public function setCurrentPage(int $current_page): bool
    {
        $this->current_page = $current_page;
        return true;
    }

    /**
     * Set page range
     *
     * @param integer $range
     * @return boolean
     */
    public function setRange(int $range): bool
    {
        $this->range = $range;
        return true;
    }

    /**
     * Check if previous page is available
     *
     * @return boolean
     */
    public function hasPreviousPage(): bool
    {
        if(!$this->total_pages) {
            return false;
        }

        return $this->current_page > 1;
    }

    /**
     * Check if next page is available
     *
     * @return boolean
     */
    public function hasNextPage(): bool
    {
        if(!$this->total_pages) {
            return false;
        }

        return $this->current_page < $this->total_pages;
    }

    /**
     * Get previous page
     *
     * @return integer|null
     */
    public function getPreviousPage(): ?int
    {
        return $this->hasPreviousPage() ? $this->current_page - 1 : null;
    }

    /**
     * Get previous page
     *
     * @return integer|null
     */
    public function getNextPage(): ?int
    {
        return $this->hasNextPage() ? $this->current_page + 1 : null;
    }

    /**
     * Get page list
     *
     * @return array
     */
    public function getList(): array
    {
        if(!$this->total_pages) {
            return [];
        }

        $list = [];

        for($i = $this->getStartPoint(); $i <= $this->getStopPoint(); $i++) {

            if($i < 1 || $i > $this->total_pages) {
                continue;
            }

            if(count($list) > ($this->range - 1)) {
                break;
            }

            $list[] = (int) $i;
        }

        return $list;
    }

    /**
     * get pages
     *
     * @return PageItem[]
     */
    public function getPages()
    {
        $pagelist = [];
        $dots = new PageItem(false, '...');

        if($this->hasPreviousPage()) {
            $pagelist[] = new PageItem(true, 'prev', $this->getPreviousPage());
        }

        //Return first page if current page
        //is greater than the four pages
        if($this->current_page > 4) {
            $pagelist[] = new PageItem(true, 1, 1);
        }
        
        if($this->total_pages > 4) {
            $pagelist[] = $dots;
        }

        $list = array_map(function ($page) {
            return new PageItem(true, $page, $page, $page === $this->current_page);
        }, $this->getList());

        $pagelist = [...$pagelist, ...$list];

        if(($this->total_pages - $this->current_page) > $this->range) {
            $pagelist[] = $dots;
            $pagelist[] = new PageItem(true, $this->total_pages, $this->total_pages);
        }

        if($this->hasNextPage()) {
            $pagelist[] = new PageItem(true, 'next', $this->getNextPage());
        }

        return $pagelist;
    }

    /**
     * Get paging start point
     *
     * @return int
     */
    private function getStartPoint(): int
    {
        return $this->current_page - (ceil($this->range /  2) - 1);
    }

    /**
     * Get paging stop point
     *
     * @return int
     */
    public function getStopPoint(): int
    {
        if($this->current_page > ($this->total_pages - ($this->range * 2))) {
            return $this->total_pages + ($this->range * 2);
        }

        return $this->total_pages -  $this->range;
    }
}