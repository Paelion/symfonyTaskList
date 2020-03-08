<?php

namespace App\Controller;

use App\Entity\Users;
use App\Entity\Tasks;
use App\Form\UpdateUserType;
use App\Form\UsersType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {

        $user = new Users();

        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        $taskRepository = $this->getDoctrine()
            ->getRepository(Tasks::class);


        if ($form->isSubmitted() && $form->isValid()){

            $task = $taskRepository->find($request->request->get('taskId'));

            $user = $form->getData();
            $user->setTaskId($task);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }
        
        $usersRepository = $this->getDoctrine()
        ->getRepository(Users::class)->findAll();
        $tasks = $taskRepository->findAll();

        return $this->render('users/index.html.twig', [
            'users' => $usersRepository,
            'userForm' => $form->createView(),
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/users/update/{id}", name="updateUser")
     */
    public function update($id, Request $request, EntityManagerInterface $entityManager)
    {
        $user = $this->getDoctrine()
            ->getRepository(Users::class)->find($id);


        $form = $this->createForm(UpdateUserType::class, $user);
        $form->handleRequest($request);

        $userRepository = $this->getDoctrine()
            ->getRepository(Users::class);


        if ($form->isSubmitted() && $form->isValid()){

            $user = $userRepository->find($request->request->get('userId'));

            $task = $form->getData();
            $task->setTaskId($user);

            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        $tasksRepository = $this->getDoctrine()
            ->getRepository(Tasks::class)->findAll();
        $users = $userRepository->findAll();

        return $this->render('users/update.html.twig', [
            'tasks' => $tasksRepository,
            'formUpdateUser' => $form->createView(),
            'users' => $users
        ]);
    }


}
