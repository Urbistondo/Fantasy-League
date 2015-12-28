<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="team")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class Team
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
    protected $team_name;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $league_id;

    /**
    * @ORM\Column(type="integer")
    */
    protected $user_id;

    /**
    * @ORM\Column(type="integer")
    */
    protected $points;

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
     * @return Team
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;

        return $this;
    }

    /**
     * Get team_name
     *
     * @return string
     */
    public function getTeamName()
    {
        return $this->team_name;
    }

    /**
     * Set team_name
     *
     * @param string $team_name
     *
     * @return Team
     */
    public function setTeamName($team_name)
    {
        $this->team_name = $team_name;

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
     * @return Team
     */
    public function setLeagueId($league_id)
    {
        $this->league_id = $league_id;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user_id
     *
     * @param integer $integer
     *
     * @return Team
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get points
     *
     * @return string
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set points
     *
     * @param integer $integer
     *
     * @return Team
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }
}
