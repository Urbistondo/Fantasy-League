<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
use UserBundle\Entity\Eleven;
use UserBundle\Entity\Team;
use Symfony\Component\HttpFoundation\Session\Session;

class TeamController extends Controller
{
	public function indexAction()
	{
		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		if ($user != null)
		{
			return $this->redirectToRoute('user_listTeams');
		}
		else
		{
			return $this->render('UserBundle:User:index.html.twig');
		}
	}

	public function listTeamsAction()
	{
		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$user_id = $user->getId();
		$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
		return $this->render('UserBundle:User:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => false, 'type' => "Team"));
	}

	public function leaguePasswordAction($league_id)
	{
		return $this->render('UserBundle:League:leaguepassword.html.twig', array('league_id' => $league_id));
	}

	public function newTeamAction($league_id)
	{
		return $this->render('UserBundle:Team:teamform.html.twig', array('league_id' => $league_id));
	}

	public function showTeamAction($league_id, $team_id, $edit)
	{
		$session=$this->getRequest()->getSession();
		$user = $session->get('user');
		$user_id = $user->getId();
		$result = $this->get('doctrine')->getManager()->getRepository('UserBundle:Compete')->findOneBy(array('user_id' => $user_id, 'league_id' => $league_id));
		$result2 = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findOneBy(array('user_id' => $user_id, 'team_id' => $team_id));
		if ($result != null && $result2 != null)
		{
			$session->set('league_id', $league_id);
			$session->set('team_id', $team_id);
			if ($edit == "false")
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
					'type' => "Player", 'edit' => $edit));
			}
			else
			{
				$belongs = $this->get('doctrine')->getManager()->getRepository('UserBundle:Belong')->findBy(array('team_id' => $team_id, 'league_id' => $league_id));
				$players = array();
				foreach ($belongs as $belong)
				{
					$id = $belong->getPlayerId();
					$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($id);
					array_push($players, $player);
				}
				return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Choose your starting eleven", 'message' => false, 
					'type' => "Player", 'edit' => $edit));
			}
		}
		else
		{
			return $this->render('UserBundle:User:index.html.twig');
		}
	}

	public function createTeamAction(Request $request, $league_id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UserBundle:Team');
		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$user_id = $user->getId();

		if($request->getMethod()=='POST')
		{
			$team_name=$request->get('team_name');
			$league_id=$league_id;
			$user_id=$user_id;

			$team = $repository->findOneBy(array('league_id'=>$league_id, 'user_id' => $user_id));
			if($team)
			{
				return $this->render('UserBundle:User:home.html.twig', array('message' => 'You already have a team in that league'));
			}
			else
			{
				$team = new Team();
				$team->setTeamName($team_name);
				$team->setLeagueId($league_id);
				$team->setUserId($user_id);
				$team->setPoints(0);
				$team->setMoney(20000000);

				$em->persist($team);
				$em->flush();

				$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
				return $this->render('UserBundle:User:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => 'Team succesfully created', 'type' => "Team"));
			}
		}
		else
		{
			return $this->render('UserBundle:User:home.html.twig', array('message' => 'There was an unexpected problem. Please try again or contact the administrators'));
		}



		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$user_id = $user->getId();
		$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
		return $this->render('UserBundle:User:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => false, 'type' => "Team"));
	}

	public function editElevenAction()
	{
		$session = $this->getRequest()->getSession();
		$league_id = $session->get('league_id');
		$team_id = $session->get('team_id');
		return $this->redirectToRoute('user_showTeam', array('league_id' => $league_id, 'team_id' => $team_id, 'edit' => "true"), 301);
	}

	public function updateElevenAction(Request $request)
	{
		$session = $this->getRequest()->getSession();
		$league_id = $session->get('league_id');
		$team_id = $session->get('team_id');
		$user = $session->get('user');
		$user_id = $user->getId();

		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UserBundle:Eleven');

		if($request->getMethod()=='POST')
		{
			$goalkeeper=$request->get('select1');
			$defender1=$request->get('select2');
			$defender2=$request->get('select3');
			$defender3=$request->get('select4');
			$defender4=$request->get('select5');
			$midfielder1=$request->get('select6');
			$midfielder2=$request->get('select7');
			$midfielder3=$request->get('select8');
			$midfielder4=$request->get('select9');
			$striker1=$request->get('select10');
			$striker2=$request->get('select11');

			$players = array();
			array_push($players, $goalkeeper, $defender1, $defender2, $defender3, $defender4, $midfielder1, $midfielder2, $midfielder3, $midfielder4, 
				 $striker1, $striker2);

			$eleven = new Eleven();
			$eleven->setTeamId($team_id);
			$eleven->setUserId($user_id);
			$eleven->setGoalkeeper($goalkeeper);
			$eleven->setDefender1($defender1);
			$eleven->setDefender2($defender2);
			$eleven->setDefender3($defender3);
			$eleven->setDefender4($defender4);
			$eleven->setMidfielder1($midfielder1);
			$eleven->setMidfielder2($midfielder2);
			$eleven->setMidfielder3($midfielder3);
			$eleven->setMidfielder4($midfielder4);
			$eleven->setStriker1($striker1);
			$eleven->setStriker2($striker2);

			$em = $this->getDoctrine()->getEntityManager();
			$em->flush();
			return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Starting eleven", 'message' => false, 
				'type' => "Player", 'edit' => false));
		}
		else
		{
			return $this->render('UserBundle:User:signup.html.twig', array('message' => 'There was an unexpected problem. Please try again or contact the administrators'));
		}
	}

	public function showPlayerAction($player_id)
	{
		$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($player_id);
		if (!$player)
		{
			throw $this->createNotFoundException();
		}
		return $this->render('UserBundle:Team:showplayer.html.twig', array('player' => $player));
	}
}
?>