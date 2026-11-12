<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $attrs = ['class' => 'w-full rounded p-2 border border-gray-400'];

        $builder
            ->add('title', null, ['attr' => $attrs, 'label' => 'Titulo'])
            ->add('description', null, ['attr' => $attrs, 'label' => 'Descrição'])
            ->add('body', null, ['attr' => $attrs, 'label' => 'Conteúdo'])
            ->add('slug', null, ['attr' => $attrs, 'label' => 'Slug'])
            ->add('startEvent', null, ['attr' => $attrs, 'label' => 'Inicio Evento'])
            ->add('endEvent', null, ['attr' => $attrs, 'label' => 'Encerramento Evento'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
