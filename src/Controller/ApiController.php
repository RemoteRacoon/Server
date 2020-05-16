<?php

namespace App\Controller;

use App\Entity\Student;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\map;



class ApiController extends AbstractController
{

    


    /**
     * @Route("/api/student", name="api.student.index")
     */
    public function index(Request $request, StudentRepository $repos)
    {
        $appUrl = $this->getParameter('app_url');
        $imageApi = $this->getParameter('student_image_api');

        $func = function (Student $student) use ($appUrl, $imageApi) {
            $student->getProfile()->setImage(
                    $appUrl .
                    $imageApi .
                    $student->getProfile()->getImage()
                );

            return $student->toArray();
        };

        $students = $repos->findAll();


        $students = array_map($func, $students);

        return new JsonResponse(json_encode($students), 200, [], true);
    }

}
