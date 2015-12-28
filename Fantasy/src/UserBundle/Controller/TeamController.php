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

	public function newTeamAction()
	{
		return $this->render('UserBundle:User:teamform.html.twig');
	}
	public function showTeamAction($league_id, $team_id)
	{
		$session=$this->getRequest()->getSession();
		$session->set('league_id', $league_id);
		$user=$session->get('user');
		$user_id = $user->getId();
		$eleven = $this->get('doctrine')->getManager()->getRepository('UserBundle:Eleven')->findOneBy(array('user_id' => $user_id));
		$aux = array();
		$aux = $eleven->getPlayers();
		$players = array();
		foreach ($aux as $id)
		{
			$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $id));
			array_push($players, $player);
		}
		return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Starting eleven", 'message' => false, 'type' => "Player", 'team' => $team_id));
	}

	public function createTeamAction()
	{
		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$user_id = $user->getId();
		$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
		return $this->render('UserBundle:User:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => false, 'type' => "Team"));
	}

	public function modifyElevenAction()
	{
		return $this->render('UserBundle:User:index.html.twig');
	}
}
?>