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
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $constraint = new UserPassword();
        $this->buildUserForm($builder, $options);
        $builder->add('current_password', 'password', array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => $constraint,
        ));
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username',
                'text',
                array(
                    'label' => 'form.username',
                    'translation_domain' => 'FOSUserBundle',
                )
            )
            ->add(
                'email',
                'email',
                array(
                    'label' => 'form.email',
                    'translation_domain' => 'FOSUserBundle',
                )
            )
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
        return 'gingy_user_profile';
    }

}