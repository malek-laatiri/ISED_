<?php

namespace App\Form;

use App\Entity\Admission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class Admission1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('demande_insc')
            ->add('cinFile', VichFileType::class)
            ->add('bacFile', VichFileType::class)
            ->add('att_travailFile', VichFileType::class)
            ->add('att_titulaireFile', VichFileType::class)
            ->add('autorisationFile', VichFileType::class)
            ->add('cvFile', VichFileType::class)
            ->add('notes', CollectionType::class, [
                'entry_type' => ReleveNotesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'by_reference' => false,
                'disabled' => false,
            ])
            ->add('diplomes', CollectionType::class, [
                'entry_type' => DiplomeType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'by_reference' => false,
                'disabled' => false,
            ])
            ->add('user');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admission::class,
        ]);
    }
}
