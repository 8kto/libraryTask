<?php

namespace LibraryBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class BookRepository extends EntityRepository
{
    /**
     * Joined query for books with authors —
     * no lazy hydration and additional queries for an each item.
     *
     * @param int $limit
     * @return array|null
     */
    public function getLastBooks($limit = 8)
    {
        $query = $this->getEntityManager()->createQuery(
            /** @lang DQL */
            'SELECT b, a 
                FROM LibraryBundle:Book b
                JOIN b.author a
                ORDER BY b.created DESC')->setMaxResults($limit);

        try {
            return $query->getResult();
        }
        catch (NoResultException $e) {
            return null;
        }
    }
}
