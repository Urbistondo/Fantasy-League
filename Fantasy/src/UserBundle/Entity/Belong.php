<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="belong")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class Belong
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $team_id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $league_id;

    /**
    * @ORM\Column(type="text")
    */
    protected $player_id;

    /**
     * Get team_id
     *
     * @return string
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * Set team_id
     *
     * @param string $team_id
     *
     * @return Belong
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;

        return $this;
    }

    /**
     * Get league_id
     *
     * @return string
     */
    public function getLeagueId()
    {
        return $this->league_id;
    }

    /**
     * Set league_id
     *
     * @param string $league_id
     *
     * @return Belong
     */
    public function setLeagueId($league_id)
    {
        $this->league_id = $league_id;

        return $this;
    }

    /**
     * Get player_id
     *
     * @return string
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * Set player_id
     *
     * @param integer $integer
     *
     * @return Belong
     */
    public function setPlayerId($player_id)
    {
        $this->player_id = $player_id;

        return $this;
    }
}