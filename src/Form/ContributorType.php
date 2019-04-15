<?php

namespace App\Form;

use App\Entity\Contributor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContributorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var Contributor $contributor
         */
        $contributor = $options['data'];
        //dump($contributor);
        $builder
        ->add('decisions',CollectionType::class,[
            'entry_type'=>DecisionType::class,
            'data'=>$contributor->getDecisions()
        ])
            ->add('save',SubmitType::class,[
                'label'=> 'Save'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contributor::class,
        ]);
    }
}
