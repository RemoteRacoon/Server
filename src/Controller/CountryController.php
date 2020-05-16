<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Country;
use App\Repository\CountryRepository;
use App\Services\Base64ImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{

    /**
     * @Route("/admin/country", name="admin.country", methods={"GET"})
     */
    public function index(CountryRepository $repos) {
        $countries = $repos->findAll();

        if (!empty($countries)) {
            return $this->redirect($this->generateUrl('admin.index'));
        }

        $this->addFlash('notice', 'You do not have any countries yet. Populate it?');
        return $this->render('admin/country/create.html.twig');
    }

    
    /**
     * @Route("/admin/country/create", name="admin.country.create", methods={"POST"})
     */
    public function create(Request $request, Base64ImageUploader $uploader)
    {
        $countries = json_decode($request->request->get('countries'));
        $errors = json_last_error();

        if (!empty($errors)) {
            $response = json_encode(['message' => 'Make sure that data is consistent']);
            return new Response($response, 306, ['Content-Type' => 'application/json']);
        }

        $em = $this->getDoctrine()->getManager();
        $uploader->setPublicPath($this->getParameter('country_flags'));

        foreach ($countries as $country) {
            $newCountry = new Country();


            $flagFilename = $uploader->save($country->flag);

            $newCountry->setName($country->name);
            $newCountry->setLanguage($country->language);
            $newCountry->setFlag($flagFilename);
            $newCountry->setCode((int)$country->code);
            $newCountry->setCapital($country->capital);

            $em->persist($newCountry);
            $em->flush();

        }
    }
}
