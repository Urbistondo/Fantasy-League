<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketController extends Controller
{
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

	public function placeBidAction($player_id, $bid)
	{
		$session = $this->getRequest()->getSession();
		$bid = new Bid();
		$bid->setLeagueId($session->get('league_id'));
		$bid->setTeamId($session->get('team_id'));
		$bid->setUserId($session->get('user')->getId());
		$bid->setPlayerId($player_id);
		$bid->setBid($bid);
		$em->persist($bid);
		$em->flush();
		return $this->redirectToRoute('user_showRanking');
	}
}
?>