<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Livre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AuteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('biographie')
            ->remove('image')
            ->add('active')
            ->add('imageFile', FileType::class, ["label"=>"photo", "required"=>false])
            ->add('livres', EntityType::class, ["multiple"=>true, "class"=>Livre::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Auteur::class,
        ]);
    }
}
