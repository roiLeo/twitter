<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 16:29
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userData = array(
            array(
                'email' => 'user@user.tld',
                'password' => 'user',
            ),
            array(
                'email' => 'jean-claude@email.tld',
                'password' => 'mypassword',
            ),
        );
        $userManager = $this->container->get('fos_user.user_manager');
        foreach ($userData as $i => $userData) {
            $user = new User();
            $user->setUsername($userData['email']);
            $user->setEmail($userData['email']);
            $user->setPlainPassword($userData['password']);
            $user->setEnabled(true);
            $userManager->updatePassword($user);
            $manager->persist($user);
            $this->addReference(sprintf('user-%s', $i), $user);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 10;
    }
}