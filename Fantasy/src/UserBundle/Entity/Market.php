<?php
namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="market")
* @ORM\Entity(repositoryClass="UserBundle\Entity\MarketRepository")
* @ORM\HasLifecycleCallbacks()
*/

class Market
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $league_id;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $id_player1;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $id_player2;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $id_player3;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $id_player4;

	/**
	* @ORM\Column(type="integer")
	*/
	protected $id_player5;

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
     * Set league_id
     *
     * @param string $league_id
     *
     * @return Market
     */
    public function setLeagueId($league_id)
    {
        $this->league_id = $league_id;

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
     * Set idPlayer1
     *
     * @param string $idPlayer1
     *
     * @return Market
     */
    public function setIdPlayer1($idPlayer1)
    {
        $this->id_player1 = $idPlayer1;

        return $this;
    }

    /**
     * Get idPlayer1
     *
     * @return string
     */
    public function getIdPlayer1()
    {
        return $this->id_player1;
    }

    /**
     * Set idPlayer2
     *
     * @param string $idPlayer2
     *
     * @return Market
     */
    public function setIdPlayer2($idPlayer2)
    {
        $this->id_player2 = $idPlayer2;

        return $this;
    }

    /**
     * Get idPlayer2
     *
     * @return string
     */
    public function getIdPlayer2()
    {
        return $this->id_player2;
    }

    /**
     * Set idPlayer3
     *
     * @param string $idPlayer3
     *
     * @return Market
     */
    public function setIdPlayer3($idPlayer3)
    {
        $this->id_player3 = $idPlayer3;

        return $this;
    }

    /**
     * Get idPlayer3
     *
     * @return string
     */
    public function getIdPlayer3()
    {
        return $this->id_player3;
    }

    /**
     * Set idPlayer4
     *
     * @param string $idPlayer4
     *
     * @return Market
     */
    public function setIdPlayer4($idPlayer4)
    {
        $this->id_player4 = $idPlayer4;

        return $this;
    }

    /**
     * Get idPlayer4
     *
     * @return string
     */
    public function getIdPlayer4()
    {
        return $this->id_player4;
    }

    /**
     * Set idPlayer5
     *
     * @param string $idPlayer5
     *
     * @return Market
     */
    public function setIdPlayer5($idPlayer5)
    {
        $this->id_player5 = $idPlayer5;

        return $this;
    }

    /**
     * Get idPlayer5
     *
     * @return string
     */
    public function getIdPlayer5()
    {
        return $this->id_player5;
    }

    /**
     * Set players
     *
     *@param integer []
     *
     * @return Market
     */
    public function setPlayers($players)
    {
        $this->id_player1 = $players[0];
        $this->id_player2 = $players[1];
        $this->id_player3 = $players[2];
        $this->id_player4 = $players[3];
        $this->id_player5 = $players[4];
        return $this;
    }

    /**
     * Get players
     *
     * @return integer []
     */
    public function getPlayers()
    {
        $players = [$this->id_player1, $this->id_player2, $this->id_player3, $this->id_player4, $this->id_player5];
        return $players;
    }
}
