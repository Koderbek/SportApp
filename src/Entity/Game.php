<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 05.10.2019
 * Time: 9:59
 */

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Game
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\GameRepository")
 */
class Game extends AbstractGame
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

    /**
     * @var ArrayCollection|GameBuffer[]
     * @ORM\OneToMany(targetEntity="GameBuffer", mappedBy="mergeGame")
     */
    protected $bufferGames;

    public function __construct(GameBuffer $gameBuffer)
    {
        $this->bufferGames = new ArrayCollection();

        $this->setLanguage($gameBuffer->getLanguage());
        $this->setLeague($gameBuffer->getLeague());
        $this->setKind($gameBuffer->getKind());
        $this->setSource($gameBuffer->getSource());
        $this->setTeamFirst($gameBuffer->getTeamFirst());
        $this->setTeamSecond($gameBuffer->getTeamSecond());
        $this->setTime($gameBuffer->getTime());
        $gameBuffer->setMergeGame($this);
    }

    /**
     * @return GameBuffer[]|ArrayCollection
     */
    public function getBufferGames()
    {
        return $this->bufferGames;
    }

    /**
     * @param GameBuffer[]|ArrayCollection $bufferGames
     */
    public function setBufferGames($bufferGames)
    {
        $this->bufferGames = $bufferGames;
    }

    public function addBufferGame(GameBuffer $gameBuffer)
    {
        if (!$this->bufferGames->contains($gameBuffer)) {
            $this->bufferGames->add($gameBuffer);
        }
    }

    public function removeBufferGame(GameBuffer $gameBuffer)
    {
        if ($this->bufferGames->contains($gameBuffer)) {
            $this->bufferGames->removeElement($gameBuffer);
        }
    }

    public function addMerge(GameBuffer $gameBuffer)
    {
        $this->setLanguage($gameBuffer->getLanguage());
        $this->setLeague($gameBuffer->getLeague());
        $this->setKind($gameBuffer->getKind());
        $this->setSource($gameBuffer->getSource());
        $this->setTeamFirst($gameBuffer->getTeamFirst());
        $this->setTeamSecond($gameBuffer->getTeamSecond());
        $this->setTime($gameBuffer->getTime());
        $gameBuffer->setMergeGame($this);
    }
}