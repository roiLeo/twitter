<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 12:33
 */

namespace AppBundle\Messenger;

use AppBundle\Entity\Tweet;


/**
 * Class EmailMessenger
 * @package AppBundle\Messenger
 */
class EmailMessenger
{
    private $mailer;

    /**
     * EmailMessenger constructor.
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Tweet $tweet
     */
    public function sendTweetCreated(Tweet $tweet)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Super subject')
            ->setFrom('send.from@mail.net')
            ->setTo('send.to@mail.net')
            ->setBody('Hello :)');
            $this->mailer->send($message);
    }
}