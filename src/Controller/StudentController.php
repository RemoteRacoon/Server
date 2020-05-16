<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use App\Services\ImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class StudentController extends AbstractController
{
    /**
     * @Route("/admin/student", name="admin.student.index")
     */
    public function index(StudentRepository $rep)
    {
        $students = $rep->findAll();

        return $this->render('/admin/student/index.html.twig',[
            'students' => $students
        ]);
    }

    /**
     * @Route("/admin/student/create", name="admin.student.create")
     */
    public function create(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        ImageUploader $uploader,
        EntityManagerInterface $em
      )
    {
        $form = $this->createForm(StudentType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $student = new Student();
            $uploader->setPublicPath($this->getParameter('profile_images'));

            $email = $form->get('email')->getData();
            $password = $form->get('password')->getData();
            $profile = $form->get('profile')->getData();
            $profile_image = $form->get('profile')['profile_image']->getData();

            if ($profile_image) {
                $filename = $uploader->save($profile_image);
                $profile->setImage($filename);
            }

            $em->persist($profile);

            $student->setEmail($email);
            $student->setPassword($encoder->encodePassword($student, $password));
            $student->setProfile($profile);

            $em->persist($student);
            $em->flush();

            $this->addFlash('success', 'Student creation success');

            $this->redirect($this->generateUrl('admin.student.create'));
        }

        return $this->render('admin/student/create.html.twig', [
            'student_form' => $form->createView()
        ]);

    }


    /**
     * @Route("/admin/student/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(
        Request $request,
        Student $student,
        ImageUploader $uploader,
        EntityManagerInterface $em
    ) {
        $form = $this->createForm(StudentType::class, $student);
        
        $form->handleRequest($request);

        $uploader->setPublicPath($this->getParameter('profile_images'));

        if ($form->isSubmitted() && $form->isValid()) {
            $profile_image = $form->get('profile')['profile_image']->getData();

            if ($profile_image) {
                $uploader->unlink($student->getProfile()->getImage());

                $filename = $uploader->save($profile_image);

                $student->getProfile()->setImage($filename);
            }

            $em->persist($student);
            $em->flush();

            $this->addFlash('success', 'User profile has been successfully edited!');
        }

        return $this->render('/admin/student/edit.html.twig', [
            'student_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/student/{id}/delete", name="student_delete", methods={"POST"}, requirements={"id":"\d+"})
     *  @ParamConverter("student", class="App\Entity\Student")
     */
    public function delete(
        Request $requst,
        Student $student,
        EntityManagerInterface $em,
        ImageUploader $uploader
    ) {
        $uploader->setPublicPath($this->getParameter('profile_images'));
        $uploader->unlink($student->getProfile()->getImage());
        $em->remove($student);
        $em->flush();

        $this->addFlash('success', 'User has been successfully deleted!');
        return $this->redirect($this->generateUrl('admin.student.index'));
    }
}
