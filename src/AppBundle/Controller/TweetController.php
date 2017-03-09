<?php

namespace AppBundle\Controller;

use AppBundle\Form\TweetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/tweet/new", name="app_tweet_new", methods={"GET","POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(TweetType::class, new Tweet());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tweet = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em -> persist($tweet);
            $em -> flush();

            $this->addFlash('success','GG WP');
            return $this->redirectToRoute('app_tweet_view',['id' => $tweet->getId()]);
        }
        return $this->render(':tweet:new.html.twig', ['form' => $form->createView() ]);
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
