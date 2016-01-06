<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MarketController extends Controller
{
	public function listMarketAction()
	{
		$session=$this->getRequest()->getSession();
		$user=$session->get('user');
		$league_id=$session->get('league_id');
		if ($league_id != null)
		{
			
			$market = $this->get('doctrine')->getManager()->getRepository('UserBundle:Market')->findOneBy(array('league_id' => $league_id));
				if ($market != null)
				{
					$aux = array();
					$aux = $market->getPlayers();
					$players = array();
					foreach ($aux as $id)
					{
						
						$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $id));
						array_push($players, $player);
					}
					return $this->render('UserBundle:User:list.html.twig', array('items' => $players, 'title' => "Market", 'message' => false, 
						'type' => "Player", 'edit' => 'market'));
				}
		}
		else
		{
			return $this->redirectToRoute('user_index');
		}
	}
}
