<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 05.10.2019
 * Time: 9:48
 */

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class GameBuffer
 * @package App\Entity
 *
 * @ORM\Entity()
 */
class GameBuffer extends AbstractGame
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $language;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $kind;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $league;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $teamFirst;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $teamSecond;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $time;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $source;
}