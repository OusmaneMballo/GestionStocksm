<?php

namespace App\Form;

use App\Entity\Entree;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class EntreeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entrer_at',Date::class, array('label'=>'Date', 'attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
            ->add('produit')
            ->add('qtE', TextType::class, array('label'=>'Quantite', 'attr'=>array('require'=>'require', 'class'=>'form-control form-group')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entree::class,
        ]);
    }
}
