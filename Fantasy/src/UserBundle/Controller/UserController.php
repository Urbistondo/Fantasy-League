<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
	public function indexAction()
	{
		return $this->render('UserBundle:User:index.html.twig');
	}

	public function loginAction()
	{
		$error = false;
		return $this->render('UserBundle:User:login.html.twig', array('error' => $error));
	}

	public function loginAttemptAction($username, $password)
	{
		$users = $this->get('doctrine')->getManager()->getRepository('UserBundle:User')->getUsers();
		foreach ($users as $user)
		{
    		if ($user->getUsername() == $username && $user->getPassword() == $password)
    		{
    			return $this->render('UserBundle:User:home.html.twig', array('user' => $user));
    		}
		}

		$error = true;
		return $this->render('UserBundle:User:login.html.twig', array('error' => $error));
	}

	public function signupAction()
	{
		return $this->render('UserBundle:User:signup.html.twig');
	}

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
}
?>