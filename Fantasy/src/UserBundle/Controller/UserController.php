<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

	public function listAction()
	{
		$players = $this->get('doctrine')->getManager()->createQuery('SELECT name FROM UserBundle:Player')->getPlayers();

		return $this->render('UserBundle:User:list.html.php', array('players' => $players));
	}

	public function showAction($id)
	{
		$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($id);
		if (!$player)
		{
			throw $this->createNotFoundException();
		}
		
		return $this->render('UserBundle:User:show.html.php', array('player' => $player));
	}
}
?>