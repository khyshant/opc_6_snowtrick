<?php

namespace App\Form;

use App\Entity\GroupTrick;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupTrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('author_id')
            ->add('cover_id')
            ->add('group_id')
            ->add('description')
            ->add('metatitle')
            ->add('meta_description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupTrick::class,
        ]);
    }
}
