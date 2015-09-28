<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class ArticleRepository extends EntityRepository
{
    /**
     * @param bool $front If true, the request will add basic filters
     *
     * @return QueryBuilder
     */
    protected function baseQuery($front = true)
    {
        $q = $this->createQueryBuilder('a');

        if ($front) {
            $q->andWhere('a.publishedAt IS NOT NULL');
        }

        return $q;
    }

    /**
     * @param int $limit
     * @param string $order
     *
     * @return array
     */
    public function getLast($limit = 5, $order = 'DESC')
    {
        $query = $this->baseQuery()
            ->setMaxResults($limit)
            ->orderBy('a.publishedAt', $order)
        ;

        return $query->getQuery()->getResult();
    }
}
