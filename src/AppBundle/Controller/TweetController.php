<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Tweet;


class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet_list", methods={"GET"})
     */
    public function listAction()
    {
        $tweets = $this->getDoctrine()->getRepository(Tweet::class)->getLastTweets(
            $this->getParameter('app.tweet.nb_last',10)
        );
        return $this->render(':tweet:list.html.twig', ['tweets' => $tweets]);
    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view", methods={"GET"})
     * @param int $id
     *
     */
    public function viewAction($id)
    {
        $tweet = $this->getDoctrine()->getRepository(Tweet::class)->getTweet($id);
        if (!$tweet instanceof Tweet){
            throw $this->createNotFoundException(sprintf('Entity Tweet with identifier "%d" not found', $id));
        }

        return $this->render(':tweet:view.html.twig',['tweet' => $tweet]);
    }
}
