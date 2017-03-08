<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tweet;


class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet_list", methods={"GET"})
     */
    public function listAction(Request $request)
    {

        $tweets = $this->getDoctrine()->getRepository(Tweet::class)->getLastTweets(
            $this->getParameter('app.tweet.nb_last',10)
        );
        return $this->render(':tweet:list.html.twig', array('tweets' => $tweets));
    }
}
