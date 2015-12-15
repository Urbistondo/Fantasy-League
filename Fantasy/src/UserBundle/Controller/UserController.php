<?php
namespace Fantasy\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

	public function listAction()
	{
		$players = $this->get('doctrine')->getManager()->createQuery('SELECT id, name, lastname, club FROM FantasyUserBundle:Player p')->execute();

		return $this->render('FantasyUserBundle:Blog:list.html.php', array('players' => $players));
	}

	public function showAction($id)
	{
		$player = $this->get('doctrine')->getManager()->getRepository('FantasyUserBundle:Post')->find($id);
		if (!$player)
		{
			throw $this->createNotFoundException();
		}
		
		return $this->render('FantasyUserBundle:Blog:show.html.php', array('player' => $player));
	}
}
?>