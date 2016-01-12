<?php
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BlogBundle\Entity\Comment;
use BlogBundle\Form\CommentType;

class CommentController extends Controller
{
    public function newAction()
    {
        $comment = new Comment();
        $form = $this->createForm(new CommentType(), $comment);
        return $this->render('BlogBundle:Comment:form.html.twig', array('comment' => $comment,'form' => $form->createView()));
    }

    public function createAction()
    {
        $comment  = new Comment();
        $request = $this->getRequest();
        $form = $this->createForm(new CommentType(), $comment);
        $form->bind($request);

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('blogger_blog_list'));
        }
        return $this->render('BlogBundle:Comment:create.html.twig', array('comment' => $comment, 'form' => $form->createView()));
    }
}
?>