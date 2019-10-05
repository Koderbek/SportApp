<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 05.10.2019
 * Time: 9:57
 */

namespace App\Entity;


abstract class AbstractGame
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var string
     */
    protected $league;

    /**
     * @var string
     */
    protected $teamFirst;

    /**
     * @var string
     */
    protected $teamSecond;

    /**
     * @var \DateTime
     */
    protected $time;

    /**
     * @var string
     */
    protected $source;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getKind()
    {
        return $this->kind;
    }

    /**
     * @param string $kind
     */
    public function setKind(string $kind)
    {
        $this->kind = $kind;
    }

    /**
     * @return string
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param string $league
     */
    public function setLeague(string $league)
    {
        $this->league = $league;
    }

    /**
     * @return string
     */
    public function getTeamFirst()
    {
        return $this->teamFirst;
    }

    /**
     * @param string $teamFirst
     */
    public function setTeamFirst(string $teamFirst)
    {
        $this->teamFirst = $teamFirst;
    }

    /**
     * @return string
     */
    public function getTeamSecond()
    {
        return $this->teamSecond;
    }

    /**
     * @param string $teamSecond
     */
    public function setTeamSecond(string $teamSecond)
    {
        $this->teamSecond = $teamSecond;
    }

    /**
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $time
     */
    public function setTime(\DateTime $time)
    {
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source)
    {
        $this->source = $source;
    }
}