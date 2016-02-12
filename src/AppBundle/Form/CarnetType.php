<?php
/**
 * Created by PhpStorm.
 * User: Lily
 * Date: 12/02/2016
 * Time: 18:02
 */

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarnetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('member', EntityType::class, array(
                'class' => 'AppBundle:User',
                'choices' => $options['users']
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired(array('users'));
    }
}