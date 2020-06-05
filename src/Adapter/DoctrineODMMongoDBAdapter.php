<?php

/*
 * This file is part of the Pagerfanta package.
 *
 * (c) Pablo Díez <pablodip@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pagerfanta\Adapter;

use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * DoctrineODMMongoDBAdapter.
 *
 * @author Pablo Díez <pablodip@gmail.com>
 */
class DoctrineODMMongoDBAdapter implements AdapterInterface
{
    /**
     * @var Builder
     */
    private $queryBuilder;

    public function __construct(Builder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    /**
     * @return Builder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }

    public function getNbResults()
    {
        $qb = clone $this->queryBuilder;

        return $qb
            ->limit(0)
            ->skip(0)
            ->count()
            ->getQuery()
            ->execute();
    }

    public function getSlice($offset, $length)
    {
        return $this->queryBuilder
            ->limit($length)
            ->skip($offset)
            ->getQuery()
            ->execute();
    }
}
