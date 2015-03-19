<?php

namespace Gingy\CoreBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrganisationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Organisation Name'))
            ->add('description', 'text')
            ->add('country', 'text')
            // geo - longitude, latitude
            ->add('organiser', 'entity', array('class' => 'Gingy\UserBundle\Entity\User'))
            ->add('membersonly', 'checkbox', array('label' => 'For members/By invitation only?'))
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('country')
            ->add('organiser')
            ->add('membersonly')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->add('country')
            ->add('organiser')
        ;
    }
}
