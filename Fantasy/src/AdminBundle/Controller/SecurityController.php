<?php

namespace AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
	public function loginAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();

		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR))
		{
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
			return $this->render('AdminBundle::login.html.twig', array('last_username' => $session->get(SecurityContext::LAST_USERNAME),'message' => "Invalid credentials"));
		}
		else
		{
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
			return $this->render('AdminBundle::login.html.twig', array('last_username' => $session->get(SecurityContext::LAST_USERNAME),'message' => false));
		}
		
	}

	public function logoutAction()
	{
		$request = $this->getRequest();
		$session = $request->getSession();
		$session->clear();
		return $this->render('UserBundle:User:index.html.twig');
	}
}
?>