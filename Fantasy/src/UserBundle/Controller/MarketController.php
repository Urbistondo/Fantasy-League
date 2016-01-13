<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\Bid;
use UserBundle\Entity\Market;

class MarketController extends Controller
{
	public function createMarketAction($league_id)
	{
		$market = new Market();
        $players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findAll();
        $available_players = array();
        $new_players = array();
        foreach ($players as $player)
        {
            array_push($available_players, $player->getId());
        }
        for ($i = 0; $i < 5; $i++)
        {
            $random = mt_rand(0, (count($available_players) - 1));
            array_push($new_players, $available_players[$random]);
            unset($available_players[$random]);
            $available_players = array_values($available_players);
        }
        $market->setPlayers($new_players);
        $market->setLeagueId($league_id);
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($market);
        $em->flush();
        $leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();
        return $this->render('UserBundle:User:list.html.twig', array('items' => $leagues, 'title' => "Leagues", 'message' => 'League added to database succesfully', 'type' => "League"));
	}

	public function listMarketAction()
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		$league_id = $session->get('league_id');
		if ($league_id != null)
		{
			$market = $this->get('doctrine')->getManager()->getRepository('UserBundle:Market')->findOneBy(array('league_id' => $league_id));
			if ($market != null)
			{
				$aux = $market->getPlayers();
				$players = array();
				foreach ($aux as $id)
				{
					$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $id));
					if ($player != null)
					{
						array_push($players, $player);
					}
				}
				return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Market", 'message' => false, 
					'type' => "MarketPlayers"));
			}
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
		}
	}

	public function sellPlayerAction($player_id)
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		$league_id = $session->get('league_id');
		if ($league_id != null)
		{
			$market = $this->get('doctrine')->getManager()->getRepository('UserBundle:Market')->findOneBy(array('league_id' => $league_id));
			$player_ids = $market->getPlayers();
			$players = array();
			$boolean = 0;
			foreach ($player_ids as $id)
			{
				if ($id == $player_id)
				{
					$boolean = 1;
				}
			}
			$market->setNextPlayer($player_id);
			$em = $this->getDoctrine()->getEntityManager();
   			$em->flush();
   			return $this->redirectToRoute('user_showRanking');
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
		}
	}

	public function placeBidAction(Request $request, $player_id)
	{
		$session = $this->getRequest()->getSession();
		$bid_value = $request->get('bid');
		$bid = new Bid();
		$bid->setLeagueId($session->get('league_id'));
		$bid->setTeamId($session->get('team_id'));
		$bid->setUserId($session->get('user')->getId());
		$bid->setPlayerId($player_id);
		$bid->setBid($bid_value);
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($bid);
		$em->flush();
		return $this->redirectToRoute('user_showRanking');
	}
}
?>