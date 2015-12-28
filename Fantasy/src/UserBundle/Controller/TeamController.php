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
	public function showTeamAction($league_id, $team_id, $modify)
	{
		$session=$this->getRequest()->getSession();
		$session->set('league_id', $league_id);
		$session->set('team_id', $team_id);
		if ($modify == "false")
		{
			$eleven = $this->get('doctrine')->getManager()->getRepository('UserBundle:Eleven')->findOneBy(array('team_id' => $team_id));
			$aux = array();
			$aux = $eleven->getPlayers();
			$players = array();
			foreach ($aux as $id)
			{
				$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $id));
				array_push($players, $player);
			}
			return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Starting eleven", 'message' => false, 
				'type' => "Player", 'modify' => $modify));
		}
		else
		{
			$player_ids = $this->get('doctrine')->getManager()->getRepository('UserBundle:Belong')->findBy(array('team_id' => $team_id));
			$players = array();
			foreach ($player_ids as $id)
			{
				$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $id));
				array_push($players, $player);
			}
			return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Choose your starting eleven", 'message' => false, 
				'type' => "Player", 'modify' => $modify));
		}
		
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
		$session = $this->getRequest()->getSession();
		$league_id = $session->get('league_id');
		$team_id = $session->get('team_id');
		return $this->redirectToRoute('user_showTeam', array('league_id' => $league_id, 'team_id' => $team_id, 'modify' => "true"), 301);
	}

	public function updateElevenAction(Request $request)
	{
		$session = $this->getRequest()->getSession();
		$league_id = $session->get('league_id');
		$team_id = $session->get('team_id');

		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UserBundle:Eleven');

		if($request->getMethod()=='POST')
		{
			$username=$request->get('username');
			$password=$request->get('password');
			$name=$request->get('name');
			$email=$request->get('email');

			$user = $repository->findOneBy(array('username'=>$username));
			if($user)
			{
				return $this->render('UserBundle:User:signup.html.twig', array('message' => 'That username is taken. Please choose another one'));
			}
			else
			{
				$user = new User();
				$user->setUsername($username);
				$user->setPassword($password);
				$user->setName($name);
				$user->setEmail($email);
				$user->setPrivileges(false);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();
				return $this->render('UserBundle:User:home.html.twig', array('message' => 'User added to database succesfully'));
			}
		}
		else
		{
			return $this->render('UserBundle:User:signup.html.twig', array('message' => 'There was an unexpected problem. Please try again or contact the administrators'));
		}

		return $this->render('UserBundle:User:index.html.twig');
	}
}
?>