<?php
namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Tweet;
class LoadTweetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $messages = [
            'hello world',
            'symfony its cool',
            'Mesdames, messieurs, la démoralisation généraliste actuelle interpelle le citoyen que je suis et nous oblige tous à aller de l\'avant dans la voie d\'un programme plus humain, plus fraternel et plus juste.',
            'Et c\'est en toute conscience que je déclare avec conviction que la volonté farouche de sortir notre pays de la crise soustrait toute vision globale de nos compatriotes les plus démunis',
            'Je me tiens devant vous et vous dis que la politique globale mondialiste doit nous amener au choix réellement impératif d\'un processus allant vers plus d\'égalité.',
            'Très chers compatriotes, vous le savez et je vous le redit que la crise que connait notre pays doit s\'intégrer à la finalisation globale d\'un avenir s\'orientant vers plus de progrès et plus de justice.',
            'Parce que je tiens mes promesses, je tiens à vous dire que le surendettement de nos compatriotes soustrait toute vision globale d\'une valorisation sans concession de nos caractères spécifiques.',
        ];
        foreach ($messages as $i => $message) {
            $tweet = new Tweet();
            $tweet->setMessage($message);
            $manager->persist($tweet);
            $this->addReference('tweet-'.$i, $tweet);
        }
        $manager->flush();
    }
    public function getOrder()
    {
        return 10;
    }
}