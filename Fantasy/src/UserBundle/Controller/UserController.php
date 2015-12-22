<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

	public function listAction()
	{
		$players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->getPlayers();

		return $this->render('UserBundle:User:list.html.twig', array('players' => $players));
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

	public function loginAction()
	{
		$users = $this->get('doctrine')->getManager()->getRepository('UserBundle:User')->getUsers();

		return $this->render('UserBundle:User:login.html.twig', array('users' => $users));
	}

	public function signupAction()
	{
		$players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->getPlayers();

		return $this->render('UserBundle:User:login.html.twig');
	}
}
?>