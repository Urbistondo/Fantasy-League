<?php
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{

	public function listAction()
	{
		$posts = $this->get('doctrine')->getManager()->getRepository('BlogBundle:Post')->getLatestPosts();
		return $this->render('BlogBundle:Blog:list.html.twig', array('posts' => $posts));
	}

	public function showAction($id)
	{
		$post = $this->get('doctrine')->getManager()->getRepository('BlogBundle:Post')->find($id);
		
		if (!$post) {
			throw $this->createNotFoundException('No se ha encontrado el post.');
		}

		$comments = $this->get('doctrine')->getManager()->getRepository('BlogBundle:Comment')->getCommentsForPost($post->getId());

		return $this->render('BlogBundle:Blog:show.html.twig', array('post' => $post, 'comments' => $comments));
	}

	public function contactAction()
	{
		return $this->render('BlogBundle:Blog:contact.html.twig');
	}

	public function aboutAction()
	{
		return $this->render('BlogBundle:Blog:about.html.twig');
	}
}
?>