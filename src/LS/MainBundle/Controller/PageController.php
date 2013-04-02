<?php 

namespace LS\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
    
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $users = $em->createQueryBuilder()
                    ->select('u')
                    ->from('LSMainBundle:User',  'u')
                    ->addOrderBy('u.created', 'DESC')
                    ->getQuery()
                    ->getResult();

        return $this->render('LSMainBundle:Page:index.html.twig', array(
            'users' => $users
        ));
    }
    
    public function contactAction()
    {
        return $this->render('LSMainBundle:Page:contact.html.twig');
    }
}