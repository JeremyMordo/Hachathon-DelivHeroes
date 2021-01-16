<?php

namespace App\Form;

use App\Entity\Ticket;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class TicketType extends AbstractType
{

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'group_by' => 'type',
                'placeholder' => 'Choisir une catégorie',
                'label' => 'Votre problème'
                ])
            ->add('localisation', TextType::class, [
                'label' => 'Le lieu de l\'intervention'])
            ->add('interventionSchedule', ChoiceType::class, [
                'label' => 'Date d\'intervention',
                'placeholder' => 'Choisir une horaire',
                'choices' => [
                    'Tout de suite !' => new \DateTime('now'),
                    'Demain' => new \DateTime('+1 day'),
                    'La semaine prochaine' => new \DateTime('+1 week'),
                    'Dans un mois' => new \DateTime('+1 month'),
                ],
                'group_by' => function($choice, $key, $value) {
                    if ($choice <= new \DateTime('+3 days')) {
                        return 'Rapidement';
                    }
            
                    return 'Je ne suis pas pressé';
                },
            ])
            ->add('resume', TextareaType::class,[
                'label' => 'Commentaire à destination du héro']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
