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
    protected $user_id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $user_username;

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
     * Set user_id
     *
     * @param integer $user_id
     *
     * @return Compete
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set user_username
     *
     * @param string $user_username
     *
     * @return Compete
     */
    public function setUserUsername($user_username)
    {
        $this->user_username = $user_username;

        return $this;
    }

    /**
     * Get user_username
     *
     * @return string
     */
    public function getUserUsername()
    {
        return $this->user_username;
    }
}