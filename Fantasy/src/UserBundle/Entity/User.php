<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
* @ORM\Entity
* @ORM\Table(name="user")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class User IMPLEMENTS UserInterface
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="text")
	*/
	protected $username;

	/**
	* @ORM\Column(type="text")
	*/
	protected $email;

	/**
	* @ORM\Column(type="text")
	*/
	protected $password;

    /**
    * @ORM\Column(type="text")
    */
    protected $name;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $privileges;

    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set privileges
     *
     * @param string $privileges
     *
     * @return User
     */
    public function setPrivileges($privileges)
    {
        $this->privileges = $privileges;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getPrivileges()
    {
        return $this->privileges;
    }

      /**
     * Get name
     *
     * @return string
     */
    public function getSalt()
    {
        
    }
      /**
     * Get name
     *
     * @return string
     */
    public function getRoles()
    {
        
    }
      /**
     * Get name
     *
     * @return string
     */
    public function eraseCredentials()
    {
        return $this->privileges;
    }

}
