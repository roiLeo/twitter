<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 10/03/2017
 * Time: 14:57
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as FOSUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends FOSUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

}