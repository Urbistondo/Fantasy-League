<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bid
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bid
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
     * @ORM\Column(name="league_id", type="integer")
     */
    private $league_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="team_id", type="integer")
     */
    private $team_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $user_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="player_id", type="integer")
     */
    private $player_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="bid", type="integer")
     */
    private $bid;


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
     * Set leagueId
     *
     * @param integer $leagueId
     *
     * @return Bid
     */
    public function setLeagueId($leagueId)
    {
        $this->league_id = $leagueId;

        return $this;
    }

    /**
     * Get leagueId
     *
     * @return integer
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * Set teamId
     *
     * @param integer $teamId
     *
     * @return Bid
     */
    public function setTeamId($teamId)
    {
        $this->team_id = $teamId;

        return $this;
    }

    /**
     * Get teamId
     *
     * @return integer
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Bid
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set playerId
     *
     * @param integer $playerId
     *
     * @return Bid
     */
    public function setPlayerId($playerId)
    {
        $this->player_id = $playerId;

        return $this;
    }

    /**
     * Get playerId
     *
     * @return integer
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set bid
     *
     * @param integer $bid
     *
     * @return Bid
     */
    public function setBid($bid)
    {
        $this->bid = $bid;

        return $this;
    }

    /**
     * Get bid
     *
     * @return integer
     */
    public function getBid()
    {
        return $this->bid;
    }
}

