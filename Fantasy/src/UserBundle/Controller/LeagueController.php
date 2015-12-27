<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\Team;
use Symfony\Component\HttpFoundation\Session\Session;

class LeagueController extends Controller
{
	public function listLeaguesAction()
	{
		$leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();
		return $this->render('UserBundle:User:list.html.twig', array('items' => $leagues, 'title' => "Leagues", 'message' => false, 'type' => "League"));
	}

	public function newLeagueAction()
	{
		$error = false;
		return $this->render('UserBundle:User:league.html.twig', array('error' => $error));
	}

	public function createLeagueAction(Request $request)
	{
		if($request->getMethod()=='POST')
		{
			$name = $request->get('name');
			$password = $request->get('password');
			$capacity = $request->get('capacity');
			$admin_id = 0;

			$league = new League();
			$league->setLeagueName($name);
			$league->setLeaguePassword($password);
			$league->setLeagueCapacity($capacity);
			$league->setLeagueAdminId($admin_id);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($league);
			$em->flush();

			$leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();
			return $this->render('UserBundle:User:list.html.twig', array('items' => $leagues, 'title' => "Leagues", 'message' => 'League added to database succesfully'));
		}
		else
		{
			return $this->render('UserBundle:User:league.html.twig', array('error' => false));
		}
	}

	public function joinLeagueAction()
	{
		$error = false;
		return $this->render('UserBundle:User:league.html.twig', array('error' => $error));
	}
}
?>