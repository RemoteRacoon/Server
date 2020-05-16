<?php

namespace App\Controller;

use App\Entity\EducationCenter;
use App\Form\EducationCenterType;
use App\Services\ImageUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EducationCenterController extends AbstractController
{
    /**
     * @Route("/admin/educ_center/create", name="admin.educ_center.create")
     */
    public function createEducationCenter(Request $request, ImageUploader $uploader) {

        $form = $this->createForm(EducationCenterType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $educ = new EducationCenter();

            /**
             * @param UploadedFile
             */
            $file = $request->files->get('education_center')['attachment'];

            if ($file) {
                $em = $this->getDoctrine()->getManager();

                $uploader->setPublicPath($this->getParameter('university_logos'));

                $filename = $uploader->save($file);

                $educ->setLogo($filename);
                $educ->setName($form->get('name')->getData());
                $em->persist($educ);
                $em->flush();

                $this->addFlash('success', 'Education center creation success');

                return $this->redirect($this->generateUrl('admin.educ_center.create'));
            }

            
        }

        return $this->render('admin/education/create.html.twig', [
            'education_center_form' => $form->createView()
        ]);
    }
}
