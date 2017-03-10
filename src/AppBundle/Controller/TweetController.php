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
        $tweets = $this->container->get('app.tweet_manager');
        return $this->render(':tweet:list.html.twig', ['tweets' => $tweets->getLast()]);
    }

    /**
     * @Route("/tweet/new", name="app_tweet_new", methods={"GET","POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $emailManager = $this->container->get('app.email_messenger');

        $tweetManager = $this->container->get('app.tweet_manager');
        $form = $this->createForm(TweetType::class,$tweetManager->create());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tweet = $form->getData();
            $tweetManager->save($tweet);
            $emailManager -> sendTweetCreated($tweet);
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
