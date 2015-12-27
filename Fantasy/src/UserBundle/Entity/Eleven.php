<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="eleven")
* @ORM\Entity(repositoryClass="UserBundle\Entity\UserRepository")
* @ORM\HasLifecycleCallbacks()
*/

class Eleven
{
	/**
	* @ORM\Id
	* @ORM\Column(type="text")
	*/
	protected $team_id;

	/**
    * @ORM\Id
	* @ORM\Column(type="int")
	*/
	protected $user_id;

    /**
    * @ORM\Column(type="int")
    */
    protected $goalkeeper;

    /**
    * @ORM\Column(type="int")
    */
    protected $defense1;

    /**
    * @ORM\Column(type="int")
    */
    protected $defense2;

    /**
    * @ORM\Column(type="int")
    */
    protected $defense3;

    /**
    * @ORM\Column(type="int")
    */
    protected $defense4;

    /**
    * @ORM\Column(type="int")
    */
    protected $midfielder1;

    /**
    * @ORM\Column(type="int")
    */
    protected $midfielder2;

    /**
    * @ORM\Column(type="int")
    */
    protected $midfielder3;

    /**
    * @ORM\Column(type="int")
    */
    protected $midfielder4;

    /**
    * @ORM\Column(type="int")
    */
    protected $striker1;

    /**
    * @ORM\Column(type="int")
    */
    protected $striker2;

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
     * @return Eleven
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;

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
     * @param string $user_id
     *
     * @return Eleven
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get goalkeeper
     *
     * @return string
     */
    public function getGoalkeeper()
    {
        return $this->goalkeeper;
    }

    /**
     * Set goalkeeper
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setGoalkeeper($goalkeeper)
    {
        $this->goalkeeper = $goalkeeper;

        return $this;
    }

    /**
     * Get defender1
     *
     * @return string
     */
    public function getDefender1()
    {
        return $this->defender1;
    }

    /**
     * Set defender1
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setDefender1($defender1)
    {
        $this->defender1 = $defender1;

        return $this;
    }

    /**
     * Get defender2
     *
     * @return string
     */
    public function getDefender2()
    {
        return $this->defender2;
    }

    /**
     * Set defender2
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setDefender2($defender2)
    {
        $this->defender2 = $defender2;

        return $this;
    }

    /**
     * Get defender3
     *
     * @return string
     */
    public function getDefender3()
    {
        return $this->defender3;
    }

    /**
     * Set defender3
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setDefender3($defender3)
    {
        $this->defender3 = $defender3;

        return $this;
    }

    /**
     * Get defender4
     *
     * @return string
     */
    public function getDefender4()
    {
        return $this->defender4;
    }

    /**
     * Set defender4
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setDefender4($defender4)
    {
        $this->defender4 = $defender4;

        return $this;
    }

    /**
     * Get midfielder1
     *
     * @return string
     */
    public function getMidfielder1()
    {
        return $this->midfielder1;
    }

    /**
     * Set midfielder1
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setMidfielder1($midfielder1)
    {
        $this->midfielder1 = $midfielder1;

        return $this;
    }

    /**
     * Get midfielder2
     *
     * @return string
     */
    public function getMidfielder2()
    {
        return $this->midfielder2;
    }

    /**
     * Set midfielder2
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setMidfielder2($midfielder2)
    {
        $this->midfielder2 = $midfielder2;

        return $this;
    }

    /**
     * Get midfielder3
     *
     * @return string
     */
    public function getMidfielder3()
    {
        return $this->midfielder3;
    }

    /**
     * Set midfielder3
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setMidfielder3($midfielder3)
    {
        $this->midfielder3 = $midfielder3;

        return $this;
    }

    /**
     * Get midfielder4
     *
     * @return string
     */
    public function getMidfielder4()
    {
        return $this->midfielder4;
    }

    /**
     * Set midfielder4
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setMidfielder4($midfielder4)
    {
        $this->midfielder4 = $midfielder4;

        return $this;
    }

    /**
     * Get striker1
     *
     * @return string
     */
    public function getStriker1()
    {
        return $this->striker1;
    }

    /**
     * Set striker1
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setStriker1($striker1)
    {
        $this->striker1 = $striker1;

        return $this;
    }

    /**
     * Get striker2
     *
     * @return string
     */
    public function getStriker2()
    {
        return $this->striker2;
    }

    /**
     * Set striker2
     *
     * @param integer $integer
     *
     * @return Eleven
     */
    public function setStriker2($striker2)
    {
        $this->striker2 = $striker2;

        return $this;
    }
}