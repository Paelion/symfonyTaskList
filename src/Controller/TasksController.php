<?php

namespace App\Controller;

use App\Entity\Tasks;
use App\Entity\Users;
use App\Form\TasksType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TasksController extends AbstractController
{

    /**
     * @Route("/tasks", name="tasks")
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {
        $newTask = new Tasks();

        $form = $this->createForm(TasksType::class, $newTask);
        $form->handleRequest($request);
    
        $userRepository = $this->getDoctrine()
                            ->getRepository(Users::class);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $userRepository->find($request->request->get('userId'));
            
            $newTask = $form->getData();
            $newTask->setUserId($user);

            $entityManager->persist($newTask);
            $entityManager->flush();

            return $this->redirectToRoute('tasks');
        }

        $tasks = $this->getDoctrine()
        ->getRepository(Tasks::class)->findAll();
        $users = $userRepository->findAll();

        return $this->render('tasks/index.html.twig', [
            'tasks' => $tasks,
            'taskForm' => $form->createView(),
            'users' => $users
        ]);
    }





    /**
     * @Route("/tasks/update/{id}", name="updateTask")
     */
    public function update($id, Request $request, EntityManagerInterface $entityManager)
    {
        $task = $this->getDoctrine()
            ->getRepository(Tasks::class)->find($id);


        $form = $this->createForm(TasksType::class, $task);
        $form->handleRequest($request);

        $taskRepository = $this->getDoctrine()
            ->getRepository(Tasks::class);


        if ($form->isSubmitted() && $form->isValid()){

            $task = $taskRepository->find($request->request->get('taskId'));

            $user = $form->getData();
            $user->setTaskId($task);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('tasks');
        }

        $usersRepository = $this->getDoctrine()
            ->getRepository(Users::class)->findAll();
        $tasks = $taskRepository->findAll();

        return $this->render('tasks/update.html.twig', [
            'users' => $usersRepository,
            'formUpdate' => $form->createView(),
            'tasks' => $tasks
        ]);
    }

    }
