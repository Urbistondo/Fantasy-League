<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * belongs1
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class belongs1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="team_id", type="integer")
     */
    private $team_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="league_id", type="integer")
     */
    private $league_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="player_id", type="integer")
     */
    private $player_id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set teamId
     *
     * @param \integer $teamId
     *
     * @return belongs1
     */
    public function setTeamId(\integer $teamId)
    {
        $this->team_id = $teamId;

        return $this;
    }

    /**
     * Get teamId
     *
     * @return \integer
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * Set leagueId
     *
     * @param \integer $leagueId
     *
     * @return belongs1
     */
    public function setLeagueId(\integer $leagueId)
    {
        $this->league_id = $leagueId;

        return $this;
    }

    /**
     * Get leagueId
     *
     * @return \integer
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * Set playerId
     *
     * @param \integer $playerId
     *
     * @return belongs1
     */
    public function setPlayerId(\integer $playerId)
    {
        $this->player_id = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return \integer
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }
}

