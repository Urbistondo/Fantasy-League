<?php
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Entity\League;
use UserBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{
	public function indexAction()
	{
		$session=$this->getRequest()->getSession();
		$user = $session->get('user');
		if ($user != null)
		{
			return $this->redirect($this->generateUrl('user_listTeams'));
		}
		else
		{
			return $this->render('UserBundle:User:index.html.twig');
		}
	}

	public function loginAction()
	{
		return $this->render('UserBundle:User:login.html.twig', array('message' => false));
	}

	public function signupAction()
	{
		return $this->render('UserBundle:User:signup.html.twig', array('message' => false));
	}

	public function loginAttemptAction(Request $request)
	{
		$session = $this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UserBundle:User');

		if($request->getMethod()=='POST')
		{
			$session->clear();
			$username=$request->get('username');
			$password=$request->get('password');

			$user = $repository->findOneBy(array('username'=>$username, 'password'=>$password));
			if($user)
			{
				$session->set('user', $user);

				return $this->redirect($this->generateUrl('user_listTeams'));
			}
			else
			{
				return $this->render('UserBundle:User:login.html.twig', array('message' => "Invalid username or password"));
			}
		}
		else
		{
			return $this->render('UserBundle:User:login.html.twig', array('message' => "There was an error submitting the form</br>Please try again or contact the administrators"));
		}
	}

	public function signupAttemptAction(Request $request)
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('UserBundle:User');

		if($request->getMethod() == 'POST')
		{
			$username = $request->get('username');
			$password = $request->get('password');
			$encodedPass = sha1($password);
			$name = $request->get('name');
			$email = $request->get('email');

			$user = $repository->findOneBy(array('username'=>$username));
			if($user)
			{
				return $this->render('UserBundle:User:signup.html.twig', array('message' => 'That username is taken. Please choose another one'));
			}
			else
			{
				$user = new User();
				$user->setUsername($username);
				$user->setPassword($encodedPass);
				$user->setName($name);
				$user->setEmail($email);
				$user->setPrivileges(false);

				$em = $this->getDoctrine()->getEntityManager();
				$em->persist($user);
				$em->flush();
				return $this->render('UserBundle:User:home.html.twig', array('message' => 'User added to database succesfully'));
			}
		}
		else
		{
			return $this->render('UserBundle:User:signup.html.twig', array('message' => 'There was an unexpected problem. Please try again or contact the administrators'));
		}
	}

	public function exitAction()
	{
		$session=$this->getRequest()->getSession();
		$session->clear();
		return $this->render('UserBundle:User:index.html.twig');
	}
}
?>