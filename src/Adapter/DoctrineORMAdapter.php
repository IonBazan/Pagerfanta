<?php

namespace Pagerfanta\Adapter;

use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

/**
 * DoctrineORMAdapter.
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class DoctrineORMAdapter implements AdapterInterface
{
    /**
     * @var \Doctrine\ORM\Tools\Pagination\Paginator
     */
    private $paginator;

    /**
     * Constructor.
     *
     * @param \Doctrine\ORM\Query|\Doctrine\ORM\QueryBuilder $query               a Doctrine ORM query or query builder
     * @param bool                                           $fetchJoinCollection whether the query joins a collection (true by default)
     * @param bool|null                                      $useOutputWalkers    Whether to use output walkers pagination mode
     */
    public function __construct($query, $fetchJoinCollection = true, $useOutputWalkers = null)
    {
        $this->paginator = new DoctrinePaginator($query, $fetchJoinCollection);
        $this->paginator->setUseOutputWalkers($useOutputWalkers);
    }

    /**
     * Returns the query.
     *
     * @return \Doctrine\ORM\Query
     */
    public function getQuery()
    {
        return $this->paginator->getQuery();
    }

    /**
     * Returns whether the query joins a collection.
     *
     * @return bool whether the query joins a collection
     */
    public function getFetchJoinCollection()
    {
        return $this->paginator->getFetchJoinCollection();
    }

    public function getNbResults()
    {
        return \count($this->paginator);
    }

    public function getSlice($offset, $length)
    {
        $this->paginator
            ->getQuery()
            ->setFirstResult($offset)
            ->setMaxResults($length);

        return $this->paginator->getIterator();
    }
}
