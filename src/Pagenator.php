<?php

namespace Dammynex\Pagenator;

class Pagenator
{
    /** @var int */
    protected $items_count;

    /** @var int */
    protected $current_page = 1;

    /** @var int */
    protected $range = 5;

    /** @var array */
    protected $params = null;

    /** @var int */
    protected $perpage;

    /**
     * Class constructor
     *
     * @param integer $items_count
     * @param integer $current_page
     */
    public function __construct(int $items_count = 0, int $current_page = 0, int $perpage = 10, int $range = 5, ?array $params = null)
    {
        $this->setItemsCount($items_count);
        $this->setCurrentPage($current_page);
        $this->setRange($range);
        $this->setParams($params);
        $this->setPerPage($perpage);
    }

    /**
     * Set number of items
     *
     * @param integer $items_count
     * @return boolean
     */
    public function setItemsCount(int $items_count): bool
    {
        $this->items_count = $items_count;
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
     * Set page params
     *
     * @param array|null $params
     * @return boolean
     */
    public function setParams(?array $params = null): bool
    {
        $this->params = $params;
        return true;
    }

    /**
     * Set pager limit
     *
     * @param integer $limit
     * @return int
     */
    public function setPerPage(int $limit)
    {
        $this->perpage = $limit;
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
        return $this->getTotalPages()
                ? ($this->current_page > 1)
                : false;
    }

    /**
     * Check if next page is available
     *
     * @return boolean
     */
    public function hasNextPage(): bool
    {
        return $this->getTotalPages()
                ? ($this->current_page < $this->getTotalPages())
                : false;
    }

    /**
     * Get paging offset
     *
     * @return integer
     */
    public function getOffset(): int
    {
        return ($this->current_page - 1)  * $this->perpage;
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
     * Get current page
     *
     * @return integer
     */
    public function getCurrentPage(): int
    {
        return $this->getTotalPages() > 0 ? $this->current_page : 0;
    }

    /**
     * Get number of items
     *
     * @return integer
     */
    public function getItemsCount(): int
    {
        return $this->items_count;
    }

    /**
     * Get total pages
     *
     * @return integer
     */
    public function getTotalPages(): int
    {
        return ceil($this->items_count / $this->perpage);
    }

    /**
     * Get page list
     *
     * @return array
     */
    public function getList(): array
    {
        if(!$this->getTotalPages()) {
            return [];
        }

        $list = [];

        for($i = $this->getStartPoint(); $i <= $this->getStopPoint(); $i++) {

            if($i < 1 || $i > $this->getTotalPages()) {
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
            $pagelist[] = new PageItem(
                true,
                'prev',
                $this->getPreviousPage(),
                false, $this->params
            );
        }

        $checkpoint = 4;

        //Return first page if current page
        //is greater than the four pages
        if($this->current_page > $checkpoint) {
            $pagelist[] = new PageItem(true, 1, 1);
        }
        
        if($this->getTotalPages() > $checkpoint && $this->current_page > $checkpoint) {
            $pagelist[] = $dots;
        }

        $list = array_map(function ($page) {
            return new PageItem(
                true,
                $page,
                $page,
                $page === $this->current_page,
                $this->params
        );
        }, $this->getList());

        $pagelist = [...$pagelist, ...$list];

        if(($this->getTotalPages() - $this->current_page) > $this->range) {
            $pagelist[] = $dots;
            $pagelist[] = new PageItem(true, $this->getTotalPages(), $this->getTotalPages());
        }

        if($this->hasNextPage()) {
            $pagelist[] = new PageItem(
                true,
                'next',
                $this->getNextPage(),
                false,
                $this->params
            );
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
        if($this->current_page > ($this->getTotalPages() - ($this->range * 2))) {
            return $this->getTotalPages() + ($this->range * 2);
        }

        return $this->getTotalPages() -  $this->range;
    }
}