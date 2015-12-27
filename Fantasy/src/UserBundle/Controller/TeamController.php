<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
use Symfony\Component\HttpFoundation\Session\Session;

class TeamController extends Controller
{
	public function indexAction()
	{
		return $this->render('UserBundle:User:index.html.twig');
	}

	public function listTeamsAction()
	{
		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$user_id = $user->getId();
		$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
		return $this->render('UserBundle:User:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => false, 'type' => "Team"));
	}
}
?>