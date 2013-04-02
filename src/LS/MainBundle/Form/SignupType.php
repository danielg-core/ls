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
        $builder->add('password'); 
    }

    public function getName()
    {
        return 'signup';
    }
}