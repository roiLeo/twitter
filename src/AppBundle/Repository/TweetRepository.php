<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Tweet;

/**
 * TweetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TweetRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param int $maxResults
     *
     * @return Tweet[]
     */
    public function getLastTweets($maxResults = 10)
    {
        return $this->createQueryBuilder('t')
                    ->select('t')
                    ->orderBy('t.createdAt', 'DESC')
                    ->setMaxResults($maxResults)
                    ->getQuery()
                    ->getResult();
    }

    /**
     * @param $id
     *
     * @return Tweet[]
     */
    public function getTweet($id)
    {
        return $this->createQueryBuilder('i')
                    ->select('i')
                    ->andWhere('i.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}
