<?php 

namespace LS\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SignupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username'); 
        
        $builder->add('email', 'email');  
        
        $builder->add('password', 'repeated', array(
            'type' => 'password',
            'first_name' => "Password",
            'second_name' => "Confirmation",
            'invalid_message' => 'The password fields must match.', 
        ));
    }

    public function getName()
    {
        return 'signup';
    }
}