<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AnnonceForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('type', TextType::class)
            ->add('superficie', IntegerType::class)
            ->add('nb_pieces', IntegerType::class)
            ->add('localisation', NumberType::class)
            ->add('prix', NumberType::class)
            ->add('photo', TextType::class)
            ->add('description', TextType::class)
            ->add('contact', TextType::class);
    }

    public function getName(){
        return "Annonce";
    }
}

