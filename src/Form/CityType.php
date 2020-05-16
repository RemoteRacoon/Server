<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CityType extends AbstractType
{
    private $countryRepository;

    public function __construct(CountryRepository $repos) {
        $this->countryRepository = $repos;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = $this->countryRepository->findBy([], ['name' => 'ASC']);

        $builder
            ->add('name')
            ->add('country', ChoiceType::class, [
                'choices' => $countries,
                'choice_label' => function(?Country $country) {
                    return $country ? $country->getName() : '';
                }
            ])
            ->add('submit', SubmitType::class)
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
