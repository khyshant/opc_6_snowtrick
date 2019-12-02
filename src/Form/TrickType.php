<?php

namespace App\Form;

use App\Entity\GroupTrick;
use App\Entity\Trick;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', EntityType::class, [
                // looks for choices from this entity
                'class' => User::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'username',

                // used to render a select box, check boxes or radios
                //'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('name')
            ->add('description')
            ->add('metatitle')
            ->add('meta_description')
            ->add('GroupTricks', EntityType::class, [
                // looks for choices from this entity
                'mapped' => false,
                'class' => GroupTrick::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,])
            ->add("medias", CollectionType::class, [
                "entry_type" => MediaType::class,
                "allow_add" => true,
                "allow_delete" => true,
                "by_reference" => false
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
            'translation_domain' => 'forms'
        ]);
    }
}
