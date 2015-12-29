<?php
// src/Blogger/AdminBundle/Controller/Admin.php
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
    	return $this->render('AdminBundle::admin.html.twig');
    }

    public function playersAction()
    {
    	return $this->render('AdminBundle::player.html.twig', array('message' => false));
    }

    public function createPlayerAction()
    {
    	return $this->render('AdminBundle::playerform.html.twig', array('edit' => false, 'message' => false));
    }

    public function addPlayerAction(Request $request, $edit)
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

            $player = new Player();
            $player->setName($name);
            $player->setLastname($lastname);
            $player->setBirth(new \DateTime($birth));
            $player->setNationality($nationality);
            $player->setClub($club);
            $player->setPosition($position);
            $player->setPoints($points);
            $player->setValue($values);

            $em = $this->getDoctrine()->getEntityManager();
            if ($edit != true)
            {
                $em->persist($player);
            }
            else
            {   
                $em->merge($player);
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
    	return $this->render('AdminBundle::player.html.twig');
    }
}   