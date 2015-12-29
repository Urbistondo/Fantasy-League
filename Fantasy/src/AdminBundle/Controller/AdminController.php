<?php
// src/Blogger/AdminBundle/Controller/Admin.php
namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
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
    	return $this->render('AdminBundle::player.html.twig');
    }

    public function createPlayerAction()
    {
    	return $this->render('AdminBundle::playerform.html.twig');
    }

    public function removePlayerAction()
    {
    	$players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findAll();
    	return $this->render('AdminBundle::list.html.twig', array('items' => $players, 'title' => "Players", 'message' => false, 'type' => 'Player', 'modify' => "false"));
    }

    public function removePlayerIdAction($player_id)
    {
    	$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->findOneBy(array('id' => $player_id));
    	$em = $this->getDoctrine()->getEntityManager();
    	$em->remove($player);
		$em->flush();
    	return $this->render('AdminBundle::player.html.twig');
    }
}   