<?php

namespace App\Form;

use App\Entity\GroupTrick;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
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
            ->add('GroupTrick', EntityType::class, [
                // looks for choices from this entity
                'class' => GroupTrick::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'name',

                // used to render a select box, check boxes or radios
                 //'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('meta_description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
