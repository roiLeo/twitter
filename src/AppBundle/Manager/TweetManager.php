<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 10:38
 */

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Tweet;

/**
 * Class TweetManager
 * @package AppBundle\Manager
 */

class TweetManager
{
    private $em;
    private $nbLast;

    /**
     * TweetManager constructor.
     * @param EntityManager $em
     * @param $nbLast
     */
    public function __construct(EntityManager $em, $nbLast )
    {
        $this->em = $em;
        $this->nbLast = $nbLast;
    }

    /**
     * @return Tweet
     */
    public function create()
    {
        return new Tweet();
    }

    /**
     * @param Tweet $tweet
     */
    public function save(Tweet $tweet)
    {
        if (null === $tweet->getId()){
            $em = $this->em;
            $em -> persist($tweet);
        }

        $this-> em -> flush();
    }

    /**
     * @return Tweet[]
     */
    public function getLast()
    {
        return $this->em->getRepository(Tweet::class)->getLastTweets($this->nbLast);
    }

}