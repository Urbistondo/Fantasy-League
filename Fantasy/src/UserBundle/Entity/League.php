<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="league")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class League
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $league_id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $league_name;

    /**
    * @ORM\Column(type="text")
    */
    protected $league_password;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $league_capacity;

    /**
    * @ORM\Column(type="integer")
    */
    protected $league_admin_id;

    /**
     * Get league_id
     *
     * @return string
     */
    public function getLeagueId()
    {
        return $this->id;
    }

    /**
     * Set league_name
     *
     * @param string $league_name
     *
     * @return League
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
     * Set league_password
     *
     * @param string $league_password
     *
     * @return League
     */
    public function setLeaguePassword($league_password)
    {
        $this->league_password = $league_password;

        return $this;
    }

    /**
     * Get league_password
     *
     * @return string
     */
    public function getLeaguePassword()
    {
        return $this->league_password;
    }

    /**
     * Set league_capacity
     *
     * @param integer $integer
     *
     * @return League
     */
    public function setLeagueCapacity($league_capacity)
    {
        $this->league_capacity = $league_capacity;

        return $this;
    }

    /**
     * Get league_capacity
     *
     * @return integer
     */
    public function getLeagueCapacity()
    {
        return $this->league_capacity;
    }

    /**
     * Set league_admin_id
     *
     * @param integer $integer
     *
     * @return League
     */
    public function setLeagueAdminId($league_admin_id)
    {
        $this->league_admin_id = $league_admin_id;

        return $this;
    }

    /**
     * Get league_admin_id
     *
     * @return integer
     */
    public function getLeagueAdminId()
    {
        return $this->league_admin_id;
    }
}