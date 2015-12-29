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

	

    public function adminAction(){
        
    	return $this->render('AdminBundle::admin.html.twig', array('creado' => false));
    }

   
 }   