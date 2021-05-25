<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->remove('image')
            ->add('active')
            ->add('imageFile', FileType::class, ["help"=>"Largeur & Hauteur min : 400px,  Largeur & Hauteur max : 600px;", "required"=>false])
            ->add('categorie')
            ->add('auteur')
            ->add('consult')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
