<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
use UserBundle\Entity\Eleven;
use UserBundle\Entity\Team;
use UserBundle\Entity\Belong;
use UserBundle\Entity\Compete;
use Symfony\Component\HttpFoundation\Session\Session;

class TeamController extends Controller
{
	public function indexAction()
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		if ($user != null)
		{
			return $this->redirectToRoute('user_listTeams');
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
		}
	}

	public function listTeamsAction()
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		if ($user)
		{
			$user_id = $user->getId();
			$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
			return $this->render('UserBundle:Team:list.html.twig', array('items' => $teams, 'title' => "Teams", 'message' => false, 'type' => "Team"));
		}
		else
		{
			return $this->render('UserBundle:Team:list.html.twig', array('items' => false, 'title' => "Teams", 'message' => false, 'type' => "Team"));
		}
	}

	public function newTeamAction($league_id)
	{
		return $this->render('UserBundle:Team:teamform.html.twig', array('league_id' => $league_id));
	}

	public function saveTeamAction($league_id, $team_id)
	{
		$session = $this->getRequest()->getSession();
		$session->set('league_id', $league_id);
		$session->set('team_id', $team_id);
		return $this->redirectToRoute('user_showRanking');
	}

	public function showTeamAction($edit)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		$user_id = $user->getId();
		$league_id = $session->get('league_id');
		$team_id = $session->get('team_id');
		$result = $this->get('doctrine')->getManager()->getRepository('UserBundle:Compete')->findOneBy(array('team_id' => $team_id, 'league_id' => $league_id));
		$result2 = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findOneBy(array('user_id' => $user_id, 'team_id' => $team_id));
		if ($result != null && $result2 != null)
		{
			if ($edit == 0)
			{
				$eleven = $this->get('doctrine')->getManager()->getRepository('UserBundle:Eleven')->findOneBy(array('team_id' => $team_id));
				if ($eleven != null)
				{
					$aux = $eleven->getPlayers();
					$players = array();
					foreach ($aux as $id)
					{
						$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $id));
						array_push($players, $player);
					}
					return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Starting eleven", 'message' => false, 
					'type' => "ListPlayers"));
				}
				else
				{
					return $this->render('UserBundle:User:list.html.twig', array('items' => false, 'title' => "Starting eleven", 'message' => false, 
						'type' => "ListPlayers"));
				}
			}
			else if ($edit < 0)
			{
				$belongs = $this->get('doctrine')->getManager()->getRepository('UserBundle:Belong')->findBy(array('team_id' => $team_id, 'league_id' => $league_id));
				$players = array();
				foreach ($belongs as $belong)
				{
					$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $belong->getPlayerId()));
					array_push($players, $player);
				}
				return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Add players to the market", 'message' => false, 
						'type' => "AddPlayers"));
			}
			else
			{
				$belongs = $this->get('doctrine')->getManager()->getRepository('UserBundle:Belong')->findBy(array('team_id' => $team_id, 'league_id' => $league_id));
				$players = array();
				foreach ($belongs as $belong)
				{
					$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($belong->getPlayerId());
					array_push($players, $player);
				}
				$eleven = $this->get('doctrine')->getManager()->getRepository('UserBundle:Eleven')->findOneBy(array('team_id' => $team_id, 'user_id' => $user_id));
				if ($eleven != null)
				{
					$eleven = $eleven->getPlayers();
					$currentplayers = array();
					foreach ($eleven as $currentplayer)
					{
						$currentplayer = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($currentplayer);
						array_push($currentplayers, $currentplayer);
					}
					return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'eleven' => $currentplayers, 'title' => "Choose your starting eleven", 'message' => false, 
						'type' => "EditPlayers"));
				}
				else
				{
					return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'eleven' => false, 'title' => "Choose your starting eleven", 'message' => false, 
					'type' => "EditPlayers"));
				}
			}
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
		}
	}

	public function createTeamAction(Request $request, $league_id)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		$user_id = $user->getId();

		if($request->getMethod()=='POST')
		{
			$team = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findOneBy(array('league_id'=>$league_id, 'user_id' => $user_id));
			if($team)
			{
				return $this->redirectToRoute('user_listTeams');
			}
			else
			{
				$team_name = $request->get('team_name');
				$league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->find($league_id);
				$league_name = $league->getLeagueName();
				$team = new Team();
				$team->setTeamName($team_name);
				$team->setLeagueId($league_id);
				$team->setLeagueName($league_name);
				$team->setUserId($user_id);
				$team->setPoints(0);
				$team->setMoney(20000000);
				$em->persist($team);
				$em->flush();

				$compete = new Compete();
				$compete->setLeagueId($league_id);
				$compete->setLeagueName($league_name);
				$compete->setTeamId($team->getTeamId());

				$em->persist($compete);
				$em->flush();

				$players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findAll();
				$player_ids = array();

				foreach ($players as $player)
		        {
		            array_push($player_ids, $player->getId());
		        }

				$market = $this->get('doctrine')->getManager()->getRepository('UserBundle:Market')->findOneBy(array('league_id' => $league_id));
	            $league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->find($league_id);
	            $unavailable_players = $market->getPlayers();
	            $available_players = array_diff($player_ids, $unavailable_players);
	            $available_players = array_values($available_players);

	            for ($i = 0; $i < 5; $i++)
	            {
	                $random = rand(0, (count($available_players) - 1));
	                $belong = new Belong();
					$belong->setTeamId($team->getTeamId());
					$belong->setLeagueId($league_id);
					$belong->setPlayerId($available_players[$random]);
	                unset($available_players[$random]);
	                $available_players = array_values($available_players);
	                $em->persist($belong);
	            }

	            $em->flush();

				$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
				return $this->render('UserBundle:Team:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => 'Team succesfully created', 'type' => "Team"));
			}
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
		}

		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$user_id = $user->getId();
		$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('user_id' => $user_id));
		return $this->render('UserBundle:Team:list.html.twig', array('items' => $teams, 'title' => "Your teams", 'message' => false, 'type' => "Team"));
	}

	public function updateElevenAction(Request $request)
	{
		$session = $this->getRequest()->getSession();
		$league_id = $session->get('league_id');
		$team_id = $session->get('team_id');
		$user = $session->get('user');
		$user_id = $user->getId();

		if($request->getMethod()=='POST')
		{
			$em = $this->getDoctrine()->getEntityManager();

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

			$eleven = $this->get('doctrine')->getManager()->getRepository('UserBundle:Eleven')->findOneBy(array('team_id' => $team_id, 'user_id' => $user_id));
			if ($eleven == null)
			{
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
				$em->persist($eleven);
			}
			else
			{
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
			}

			$em->flush();
			return $this->redirectToRoute('user_showRanking');
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
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

	public function showRankingAction()
	{
		$session = $this->getRequest()->getSession();
		$league_id = $session->get('league_id');
		$competes = $this->get('doctrine')->getManager()->getRepository('UserBundle:Compete')->findBy(array('league_id' => $league_id));
		$teams = array();
		foreach ($competes as $compete)
		{
			$team = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findOneBy(array('team_id' => $compete->getTeamId()));
			array_push($teams, $team);
		}
		for ($i = 0; $i < count($teams); $i++)
		{
			for ($j = 0; $j < count($teams) - 1 - $i; $j++)
			{
				if ($teams[$i]->getPoints() < $teams[$i + 1]->getPoints())
				{
					$aux = $teams[$i];
					$teams[$i] = $teams[$i + 1];
					$teams[$i + 1] = $aux;
				}
			}

		}
		return $this->render('UserBundle:Team:list.html.twig', array('items' => $teams, 'title' => "Ranking", 'message' => false, 
			'type' => "TeamRanking"));
	}
}
?>