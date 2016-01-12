<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="compete")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class Compete
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	*/
	protected $league_id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $league_name;

    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    */
    protected $team_id;

    /**
     * Set league_id
     *
     * @param integer $league_id
     *
     * @return Compete
     */
    public function setLeagueId($league_id)
    {
        $this->league_id = $league_id;

        return $this;
    }

    /**
     * Get league_id
     *
     * @return integer
     */
    public function getLeagueId()
    {
        return $this->leagueid;
    }

    /**
     * Set league_name
     *
     * @param string $league_name
     *
     * @return Compete
     */
    public function setLeagueName($league_name)
    {
        $this->league_name = $league_name;

        return $this;
    }

    /**
     * Get league_name
     *
     * @return string
     */
    public function getLeagueName()
    {
        return $this->league_name;
    }

    /**
     * Set team_id
     *
     * @param integer $team_id
     *
     * @return Compete
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;

        return $this;
    }

    /**
     * Get team_id
     *
     * @return integer
     */
    public function getTeamId()
    {
        return $this->team_id;
    }
}
