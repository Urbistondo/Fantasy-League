<?php
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{

	public function listAction()
	{
		$comments = $this->get('doctrine')->getManager()->getRepository('BlogBundle:Comment')->getComments();
		return $this->render('BlogBundle:Comment:list.html.twig', array('comments' => $comments));
	}
}
?>