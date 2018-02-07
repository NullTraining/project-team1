<?php

declare(strict_types=1);

namespace App\Service;

class WebFilter
{
    /** @var int */
    private $category;

    /** @var int */
    private $limit;

    /**
     * WebFilter constructor.
     *
     * Currently we only allow 10, 20, or 30 results per page when fetching items from database
     *
     * @param int|null $category
     * @param int|null $limit
     */
    public function __construct(?int $category, ?int $limit)
    {
        $this->category = $category;

        if (!in_array($limit, [10, 20, 30])) {
            $this->limit = 10;
        }
    }

    /**
     * @return int
     */
    public function getCategory(): ?int
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }
}
