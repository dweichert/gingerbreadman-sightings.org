<?php
/**
 * This file is part of gingerbreadman-sightings.org.
 *
 * (c) David Weichert <info@davidweichert.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gingy\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add(
                'birthday',
                'birthday',
                array(
                    'label' => 'form.birthday',
                    'translation_domain' => 'FOSUserBundle',
                    'input' => 'datetime',
                    'format' => 'ddMMMyyyy',
                    'widget' => 'choice'
                )
            )
            ->add(
                'timezone',
                'timezone',
                array(
                    'label' => 'form.timezone',
                    'translation_domain' => 'FOSUserBundle',
                )
            )
        ;
    }

    public function getName()
    {
        return 'gingy_user_registration';
    }
}