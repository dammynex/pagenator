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

    /** @var array|null */
    protected $params = null;

    public function __construct(bool $is_page, string $name, ?int $value = null, bool $is_current = false, ?array $params = null)
    {
        $this->is_page = $is_page;
        $this->name = $name;
        $this->value = $value;
        $this->is_current = $is_current;
        $this->params = $params;
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
     * Get params
     *
     * @return string|null
     */
    public function getParams(): ?string
    {
        return $this->params ? http_build_query($this->params) : null;
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