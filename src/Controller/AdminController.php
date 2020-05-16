<?php

namespace App\Controller;

use App\Entity\EducationCenter;
use App\Form\CityType;
use App\Form\EducationCenterType;
use App\Form\EducationStatusType;
use App\Form\RelationshipStatusType;
use App\Repository\CountryRepository;
use App\Services\UniversityImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="admin.index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
