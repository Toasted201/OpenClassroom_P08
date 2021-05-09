<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * @param FormBuilderInterface<string|FormBuilderInterface> $builder
     * @param array<string> $option
     * @return void
     * @SuppressWarnings("unused")
     */
    public function buildForm(FormBuilderInterface $builder, array $option): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenu'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
