<?php

namespace Dammynex\Pagenator;

class PageItem
{
    /** @var bool */
    protected $is_page;

    /** @var string */
    protected $name;

    /** @var int|null */
    protected $value;

    /** @var bool */
    protected $is_current;

    public function __construct(bool $is_page, string $name, ?int $value = null, bool $is_current = false)
    {
        $this->is_page = $is_page;
        $this->name = $name;
        $this->value = $value;
        $this->is_current = $is_current;
    }

    /**
     * Check if item is a page
     *
     * @return boolean
     */
    public function isPage(): bool
    {
        return $this->is_page;
    }

    /**
     * Check if page is current page
     *
     * @return boolean
     */
    public function isCurrentPage(): bool
    {
        return $this->is_current;
    }

    /**
     * get item name
     *
     * @return string
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    /**
     * Get value
     *
     * @return integer
     */
    public function getValue(): int
    {
        return (int) $this->value;
    }
}