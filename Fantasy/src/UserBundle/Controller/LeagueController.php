<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\Team;
use UserBundle\Entity\League;
use Symfony\Component\HttpFoundation\Session\Session;

class LeagueController extends Controller
{
	public function listLeaguesAction()
	{
		$session = $this->getRequest()->getSession();
		$user = $session->get('user');
		if ($user != null)
		{
			$leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();
			return $this->render('UserBundle:League:list.html.twig', array('items' => $leagues, 'title' => "Leagues", 'message' => false, 'type' => "League"));
		}
		else
		{
			return $this->render('UserBundle:User:error.html.twig');
		}
	}

	public function leaguePasswordAction($league_id)
	{
		$request = $this->getRequest();
		$league = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->find($league_id);
		$league_password = $league->getLeaguePassword();
		if($request->getMethod() == 'POST')
		{
			$input_password = $request->get('league_password');
			if ($league_password == $input_password)
			{
				return $this->redirectToRoute('user_newTeam', array('league_id' => $league_id));
			}
			else
			{
				return $this->render('UserBundle:League:leaguepassword.html.twig', array('league_id' => $league_id, 'league_password' => $league_password, 'message' => "Incorrect password"));
			}
		}
		else
		{
			return $this->render('UserBundle:League:leaguepassword.html.twig', array('league_id' => $league_id, 'league_password' => $league_password, 'message' => false));
		}
	}

	public function newLeagueAction()
	{
		return $this->render('UserBundle:League:league.html.twig', array('message' => false));
	}

	public function createLeagueAction(Request $request)
	{
		if($request->getMethod() == 'POST')
		{
			$name = $request->get('name');
			$password = $request->get('password');
			$capacity = $request->get('capacity');
			$session = $this->getRequest()->getSession();
			$user = $session->get('user');
			$admin_id = $user->getId();

			$em = $this->getDoctrine()->getEntityManager();
			$repository = $em->getRepository('UserBundle:League');
			$league_name = $repository->findOneBy(array('league_name' => $name));
			if ($league_name)
			{
				return $this->render('UserBundle:League:league.html.twig', array('message' => 'That username is taken. Please choose another one'));
			}
			else
			{
				$league = new League();
				$league->setLeagueName($name);
				$league->setLeaguePassword($password);
				$league->setLeagueCapacity($capacity);
				$league->setLeagueAdminId($admin_id);

				$em->persist($league);
				$em->flush();

				$leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();
				return $this->render('UserBundle:User:list.html.twig', array('items' => $leagues, 'title' => "Leagues", 'message' => 'League added to database succesfully', 'type' => "League"));
			}
		}
		else
		{
			return $this->render('UserBundle:League:league.html.twig', array('message' => false));
		}
	}

	public function joinLeagueAction()
	{
		return $this->render('UserBundle:League:league.html.twig', array('message' => false));
	}
}
?>