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
                       ->getManager();
                       
                $factory = $this->get('security.encoder_factory'); 
  
                $encoder = $factory->getEncoder($user);
                $password = $encoder->encodePassword( $user->getPassword(), $user->getSalt());
                $user->setPassword($password);
                $em->persist($user);
                $em->flush();
                
                $message = \Swift_Message::newInstance()
                    ->setSubject('LS user created')
                    ->setFrom( $this->container->getParameter('ls_main.emails.account.from' ))
                    ->setTo( $user->getEmail() )
                    ->setBody($this->renderView('LSMainBundle:User:signupEmail.txt.twig', array('user' => $user)));
                $this->get('mailer')->send($message);
                
                $message2 = \Swift_Message::newInstance()
                    ->setSubject('New LS user signup')
                    ->setFrom( $this->container->getParameter('ls_main.emails.account.from' ))
                    ->setTo( $this->container->getParameter('ls_main.emails.account.to' ))
                    ->setBody($this->renderView('LSMainBundle:User:signupEmail.txt.twig', array('user' => $user))); 
                $this->get('mailer')->send($message2);
               
                $this->get('session')->getFlashBag()->add('notice', 'Thank you for signing up. An email has been sent to you. Thank you!');
                
                return $this->redirect($this->generateUrl('LSMainBundle_signup'));
            }
        }

        return $this->render('LSMainBundle:User:signup.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
 
}