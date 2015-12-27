<?php
namespace UserBundle\Modals;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="belong")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class Login
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $username;

	/**
	* @ORM\Column(type="text")
	*/
	protected $password;

    /**
     * Get team_id
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set team_id
     *
     * @param string $team_id
     *
     * @return Belong
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get league_id
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set league_id
     *
     * @param string $league_id
     *
     * @return Belong
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}