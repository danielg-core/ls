<?php 

namespace LS\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use LS\MainBundle\Form\SignupType;
use LS\MainBundle\Entity\User;

class UserController extends Controller
{
    public function signupAction()
    { 
      
        $user = new User();
        $form = $this->createForm(new SignupType(), $user);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()
                       ->getEntityManager();
                $em->persist($user);
                $em->flush();
                return $this->redirect($this->generateUrl('LSMainBundle_homepage'));
            }
        }

        return $this->render('LSMainBundle:User:signup.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
 
}