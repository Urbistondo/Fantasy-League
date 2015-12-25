<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class UserController extends Controller
{
	public function pruebaAction(Request $request)
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
				return $this->render('UserBundle:User:home.html.twig', array('name' => $user->getEmail()));
			}
			else
			{
				return $this->render('UserBundle:User:login.html.twig', array('error' => false));
			}
		}
		else
		{
			return $this->render('UserBundle:User:login.html.twig', array('error' => false));
		}
	}

	public function prueba2Action(Request $request)
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

			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($user);
			$em->flush();
			return $this->render('UserBundle:User:home.html.twig', array('name' => 'Motherfucking player'));
		}
		else
		{
			return $this->render('UserBundle:User:signup.html.twig', array('error' => false));
		}
	}

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

	public function loginAttemptAction($username, $password)
	{
		$users = $this->get('doctrine')->getManager()->getRepository('UserBundle:User')->getUsers();
		foreach ($users as $user)
		{
    		if ($user->getUsername() == $username && $user->getPassword() == $password)
    		{
    			return $this->render('UserBundle:User:home.html.twig', array('user' => $user));
    		}
		}

		$error = true;
		return $this->render('UserBundle:User:login.html.twig', array('error' => $error));
	}

	public function newAction()
	{
		$user = new User();
		$form = $this->createForm(new UserType(), $user);

		return $this->render('UserBundle:User:form.html.twig', array('form' => $form->createView()));
	}

	public function createAction()
	{
		/*$users = $this->get('doctrine')->getManager()->getRepository('UserBundle:User')->getUsers();
		foreach ($users as $user)
		{
    		if ($user->getUsername() == $username)
    		{
    			$error = true;
				return $this->render('UserBundle:User:signup.html.twig', array('error' => $error));
    		}
		}*/

		/*Falta por comprobar que no existe un usuario con el username elegido*/

		$user = new User();
		/*$user->setUsername($username);
		$user->setPassword($password);
		$user->setName($name);
		$user->setEmail($email);
		$user->setPoints(0);*/
		$request = $this->getRequest();
		$form = $this->createForm(new UserType(), $user);
		$form->bind($request);

		if ($form->isValid())
		{
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('user_loginAttempt', array('username' => $user->getUsername() . '#password-' . $user->getPassword())));
        }

		return $this->render('UserBundle:User:create.html.twig', array('user' => $user, 'form' => $form->createView()));
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