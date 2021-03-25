<?php

namespace App\Form;

use App\Entity\Tag;
use App\Entity\User;
use App\Classes\SearchClass;
use App\Entity\ContentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\CrudAutocompleteType;
use EasyCorp\Bundle\EasyAdminBundle\Form\Filter\Type\EntityFilterType;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('string', TextType::class, [
                'label' => 'Votre recherche',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre recherche (Titre, mot clé)',
                    'class' => 'form-contron-sm'
                ] 
            ])
            ->add('contentType', EntityType::class, [
                'label' => 'Type de contenu',
                'required' => false,
                'class' => ContentType::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('tags', EntityType::class, [
                'label' => 'Tags',
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ])
            ->add('editor', EntityType::class, [
                'label' => 'Editeur',
                'required' => false,
                'class' => User::class,
                'choice_label' => 'lastname',
                'multiple' => false,
                'expanded' => false
            ])            
            ->add('submit', SubmitType::class, [
                'label' => "Filtrer",
                'attr' => [
                    'class' => 'btn btn-primary mb-1 mt-1 btn-block'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchClass::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
