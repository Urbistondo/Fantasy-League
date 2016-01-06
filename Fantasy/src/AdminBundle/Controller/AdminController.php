<?php
namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
use UserBundle\Entity\Player;
use UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    public function homeAction()
    {
    	return $this->render('AdminBundle::admin.html.twig', array('message' => false));
    }

    public function playersAction()
    {
    	return $this->render('AdminBundle::player.html.twig', array('message' => false));
    }

    public function createPlayerAction()
    {
    	return $this->render('AdminBundle::playerform.html.twig', array('edit' => false, 'message' => false));
    }

    public function addPlayerAction(Request $request, $edit, $player_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('UserBundle:Player');

        if($request->getMethod()=='POST')
        {
            $name=$request->get('name');
            $lastname=$request->get('lastname');
            $birth=$request->get('birthdate');
            $nationality=$request->get('nationality');
            $club=$request->get('club');
            $position=$request->get('position');
            $points=$request->get('points');
            $values=$request->get('value');

            if ($edit != "true")
            {
                $player = new Player();
            }
            else if ($edit == "true")
            {
                $player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($player_id);
            }

            $player->setName($name);
            $player->setLastname($lastname);
            $player->setBirth(new \DateTime($birth));
            $player->setNationality($nationality);
            $player->setClub($club);
            $player->setPosition($position);
            $player->setPoints($points);
            $player->setValue($values);

            if ($edit != "true")
            {
                $em->persist($player);
            }
            $em->flush();
            return $this->render('AdminBundle::player.html.twig', array('message' => 'Player added to database succesfully'));
        }
        else
        {
            return $this->render('AdminBundle::playerform.html.twig', array('message' => 'There was an unexpected problem. Please try again or contact the administrators'));
        }
    }

    public function listPlayerAction($edit)
    {
        $players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findAll();
        return $this->render('AdminBundle::list.html.twig', array('items' => $players, 'title' => "Players", 'message' => false, 'type' => 'Player', 'edit' => $edit));
    }

    public function editPlayerAction($player_id)
    {
        $player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $player_id));
        return $this->render('AdminBundle::playerform.html.twig', array('edit' => true, 'player' => $player, 'message' => false));
    }

    public function removePlayerAction($player_id)
    {
    	$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $player_id));
    	$em = $this->getDoctrine()->getEntityManager();
    	$em->remove($player);
		$em->flush();
    	return $this->render('AdminBundle::player.html.twig', array('message' => 'Player removed from database succesfully'));
    }

    public function leaguesAction()
    {
        return $this->render('AdminBundle::league.html.twig', array('message' => false));
    }

    public function createLeagueAction()
    {
        return $this->render('AdminBundle::leagueform.html.twig', array('edit' => false, 'message' => false));
    }

    public function addLeagueAction(Request $request, $edit, $league_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $repository = $em->getRepository('UserBundle:League');

        if($request->getMethod()=='POST')
        {
            $league_name=$request->get('league_name');
            $league_password=$request->get('league_password');
            $league_capacity=$request->get('league_capacity');
            $league_admin_id=$request->get('league_admin_id');

            if ($edit != "true")
            {
                $league = new League();
            }
            else if ($edit == "true")
            {
                $league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->find($league_id);
            }

            $league->setLeagueName($league_name);
            $league->setLeaguePassword($league_password);
            $league->setLeagueCapacity($league_capacity);
            $league->setLeagueAdminId($league_admin_id);

            if ($edit != "true")
            {
                $em->persist($league);
            }
            $em->flush();
            return $this->render('AdminBundle::league.html.twig', array('message' => 'League added to database succesfully'));
        }
        else
        {
            return $this->render('AdminBundle::leagueform.html.twig', array('message' => 'There was an unexpected problem. Please try again or contact the administrators'));
        }
    }

    public function listLeagueAction($edit)
    {
        $leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();
        return $this->render('AdminBundle::list.html.twig', array('items' => $leagues, 'title' => "Leagues", 'message' => false, 'type' => 'League', 'edit' => $edit));
    }

    public function editLeagueAction($league_id)
    {
        $league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findOneBy(array('league_id' => $league_id));
        return $this->render('AdminBundle::leagueform.html.twig', array('edit' => true, 'league' => $league, 'message' => false));
    }

    public function removeLeagueAction($league_id)
    {
        $league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findOneBy(array('league_id' => $league_id));
        $em = $this->getDoctrine()->getEntityManager();
        $em->remove($league);
        $em->flush();
        return $this->render('AdminBundle::league.html.twig', array('message' => 'League removed from database succesfully'));
    }

    public function updateMarketsAction()
    {
        $markets = $this->get('doctrine')->getManager()->getRepository('UserBundle:Market')->findAll();
        $players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findAll();
        $player_ids = array();
        foreach ($players as $player)
        {
            array_push($player_ids, $player->getId());
        }
        foreach ($markets as $market)
        {
            $league_id = $market->getLeagueId();
            $league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->find($league_id);
            $unavailable_players = $market->getPlayers();
            $available_players = array_diff($player_ids, $unavailable_players);
            $available_players = array_values($available_players);
            $new_players = array();
            for ($i = 0; $i < 5; $i++)
            {
                $random = mt_rand(0, (count($available_players) - 1));
                array_push($new_players, $available_players[$random]);
                unset($available_players[$random]);
                $available_players = array_values($available_players);
            }
            $market->setPlayers($new_players);
            $em = $this->getDoctrine()->getEntityManager();
            $em->flush();
        }
        return $this->render('AdminBundle::admin.html.twig', array('message' => 'Markets updated succesfully'));
    }
}   