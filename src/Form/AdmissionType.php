<?php

namespace App\Form;

use App\Entity\Admission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AdmissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('demande_insc')
            ->add('cinFile',VichFileType::class)
            ->add('bacFile',VichFileType::class)
            ->add('att_travailFile',VichFileType::class)
            ->add('att_titulaireFile',VichFileType::class)
            ->add('autorisationFile',VichFileType::class)
            ->add('cvFile',VichFileType::class)
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admission::class,
        ]);
    }
}
