<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
use UserBundle\Form\UserType;

class UserController extends Controller
{
	public function indexAction()
	{
		return $this->render('UserBundle:User:index.html.twig');
	}

	public function loginAction()
	{
		$error = false;
		return $this->render('UserBundle:User:login.html.twig', array('error' => $error));
	}

	public function signupAction()
	{
		$error = false;
		return $this->render('UserBundle:User:signup.html.twig', array('error' => $error));
	}

	public function loginAttemptAction(Request $request)
	{
		if($request->getMethod()=='POST')
		{
			$username=$request->get('username');
			$password=$request->get('password');

			$em = $this->getDoctrine()->getEntityManager();
			$repository = $em->getRepository('UserBundle:User');

			$user = $repository->findOneBy(array('username'=>$username, 'password'=>$password));
			if($user)
			{
				return $this->render('UserBundle:User:home.html.twig', array('message' => false));
			}
			else
			{
				return $this->render('UserBundle:User:login.html.twig', array('error' => "Invalid username or password"));
			}
		}
		else
		{
			return $this->render('UserBundle:User:login.html.twig', array('error' => "There was an error submitting the form</br>Please try again or contact the administrators"));
		}
	}

	public function signupAttemptAction(Request $request)
	{
		if($request->getMethod()=='POST')
		{
			$username=$request->get('username');
			$password=$request->get('password');
			$name=$request->get('name');
			$email=$request->get('email');

			$user = new User();
			$user->setUsername($username);
			$user->setPassword($password);
			$user->setName($name);
			$user->setEmail($email);
			$user->setPrivileges(false);

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($user);
			$em->flush();
			return $this->render('UserBundle:User:home.html.twig', array('message' => 'User added to database succesfully'));
		}
		else
		{
			return $this->render('UserBundle:User:signup.html.twig', array('error' => false));
		}
	}

	public function homeAction()
	{
		return $this->render('UserBundle:User:home.html.twig', array('message' => false));
	}

	public function listTeamsAction()
	{
		$teams = $this->get('doctrine')->getManager()->getRepository('UserBundle:Team')->findBy(array('team_name' => 'Equipo prueba', 'league_id' => 1));

		return $this->render('UserBundle:User:list.html.twig', array('items' => $teams, 'title' => "Teams"));
	}

	public function listLeaguesAction()
	{
		$leagues = $this->get('doctrine')->getManager()->getRepository('UserBundle:League')->findAll();

		return $this->render('UserBundle:User:list.html.twig', array('items' => $leagues, 'title' => "Leagues"));
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

	public function listAction()
	{
		$players = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->getPlayers();

		return $this->render('UserBundle:User:list.html.twig', array('players' => $players));
	}

	public function showAction($id)
	{
		$player = $this->get('doctrine')->getManager()->getRepository('UserBundle:Player')->find($id);
		if (!$player)
		{
			throw $this->createNotFoundException();
		}
		
		return $this->render('UserBundle:User:show.html.php', array('player' => $player));
	}
}
?>