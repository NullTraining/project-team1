<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\PostRepository;

class PostFiltering
{
    /**
     * @var \App\Repository\PostRepository
     */
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function find(WebFilter $filter)
    {
        $queryBuilder = $this->postRepository->createQueryBuilder('p');

        if (null !== $filter->getCategory()) {
            $queryBuilder->where('p.category = :category')->setParameter('category', $filter->getCategory());
        }

        $queryBuilder->setMaxResults($filter->getLimit());

        return $queryBuilder->getQuery()->getResult();
    }
}
