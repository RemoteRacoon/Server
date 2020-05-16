<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\EducationCenter;
use App\Entity\EducationStatus;
use App\Entity\Profile;
use App\Entity\RelationshipStatus;
use App\Entity\Sex;
use App\Repository\CityRepository;
use App\Repository\EducationCenterRepository;
use App\Repository\EducationStatusRepository;
use App\Repository\RelationshipStatusRepository;
use App\Repository\SexRepository;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Date;

class ProfileType extends AbstractType
{
    private $sexRepository;
    private $cityRepository;
    private $educationStatusRepository;
    private $educationCenterRepository;
    private $relationshipStatusRepository;

    public function __construct(
        SexRepository $sexRep,
        CityRepository $cityRep,
        EducationStatusRepository $edStatusRep,
        EducationCenterRepository $edCenterRep,
        RelationshipStatusRepository $relStatusRep
    ) {
        $this->sexRepository = $sexRep;
        $this->cityRepository = $cityRep;
        $this->educationStatusRepository = $edStatusRep;
        $this->educationCenterRepository = $edCenterRep;
        $this->relationshipStatusRepository = $relStatusRep;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $sexes = $this->sexRepository->findAll();
        $cities = $this->cityRepository->findAll();
        $educationCenters = $this->educationCenterRepository->findAll();
        $educationStates = $this->educationStatusRepository->findAll();
        $relations = $this->relationshipStatusRepository->findAll();
        $current_year = (new DateTime())->format('Y');
        $years = [];

        for ($i = 1950; $i <= $current_year; $i++) {
            $years[] = $i;
        }

        $builder
            ->add('name')
            ->add('second_name')
            ->add('age')
            ->add('profile_image', FileType::class, [ // input for image field
                'mapped' => false,
                'required' => false
            ])
            ->add('phone_number')
            ->add('about', TextareaType::class, [
                'required' => false
            ])
            ->add('birth_date', DateType::class, [
                'years' => $years
            ])
            ->add('sex', ChoiceType::class, [
                'placeholder' => 'Choose gender',
                'choices' => $sexes,
                'choice_label' => function(?Sex $sex) {
                    return $sex->getSex();
                },
            ])

            ->add('relationship_status', ChoiceType::class, [
                'placeholder' => 'Choose a reslationship status',
                'choices' => $relations,
                'choice_label' => function (?RelationshipStatus $status) {
                    return $status->getStatus();
                }
            ])

            ->add('education_status', ChoiceType::class, [
                'placeholder' => 'Choose an education status',
                'choices' => $educationStates,
                'choice_label' => function (?EducationStatus $status) {
                    return $status->getStatus();
                }
            ])

            ->add('city', ChoiceType::class, [
                'placeholder' => 'Choose a city',
                'choices' => $cities,
                'choice_label' => function (?City $city) {
                    return $city->getName();
                }
            ])

            ->add('education_center', ChoiceType::class, [
                'placeholder' => 'Choose an education center',
                'choices' => $educationCenters,
                'choice_label' => function (?EducationCenter $center) {
                    return $center->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
