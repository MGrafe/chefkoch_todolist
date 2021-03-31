<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\Todolist;
use App\Repository\TaskRepository;
use App\Repository\TodolistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    /**
     * TODOLISTS
     */

    /**
     * @param TodolistRepository $TodolistRepository
     * @return JsonResponse
     * @Route("/todolist", name="lists", methods={"GET"})
     */
    public function getTodolists(TodolistRepository $TodolistRepository)
    {
        $data = $TodolistRepository->findAll();
        return $this->response($data);
    }


    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TodolistRepository $TodolistRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/todolist", name="todolist_add", methods={"POST"})
     */
    public function addTodolist(Request $request, EntityManagerInterface $entityManager)
    {

        try{
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') ){
                $data = [
                    'status' => 404,
                    'success' => "Name can't be NULL",
                ];
                return $this->response($data);
            }

            $todolist = new Todolist();
            $todolist->setName($request->get('name'));
            $todolist->setDescription($request->get('description'));

            $entityManager->persist($todolist);
            $entityManager->flush();

            return $this->response($todolist);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data not valid",
            ];
            return $this->response($data, 422);
        }

    }

    /**
     * @param TodolistRepository $TodolistRepository
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     * @Route("/todolist/{id}", name="todolist_get", methods={"GET"})
     */
    public function getTodolist(TodolistRepository $TodolistRepository, $id)
    {
        $todolist = $TodolistRepository->find($id);

        if (!$todolist){
            $data = [
                'status' => 404,
                'errors' => "Todolist not found",
            ];
            return $this->response($data, 404);
        }

        $listTasks = $todolist->getTasks();

        $todoArray = array();
        foreach($listTasks as $i => $todos) {
            $todoArray[] = $todos;
        }

        $wholeList = [
            "id" => $todolist->getId(),
            "name" => $todolist->getName(),
            "description" => $todolist->getDescription(),
            "tasks" => $todoArray
        ];

        return $this->response($wholeList);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TodolistRepository $TodolistRepository
     * @param $id
     * @return JsonResponse
     * @Route("/todolist/{id}", name="todolist_put", methods={"PUT"})
     */
    public function updateTodolist(Request $request, EntityManagerInterface $entityManager, TodolistRepository $TodolistRepository, $id)
    {

        try{
            $todolist = $TodolistRepository->find($id);

            if (!$todolist){
                $data = [
                    'status' => 404,
                    'errors' => "Todolist not found",
                ];
                return $this->response($data, 404);
            }

            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') ){
                $data = [
                    'status' => 404,
                    'success' => "Name can't be NULL",
                ];
                return $this->response($data);
            }

            $todolist->setName($request->get('name'));
            $todolist->setDescription($request->get('description'));
            $entityManager->flush();

            $data = [
                'status' => 200,
                'errors' => "Todolist updated successfully",
            ];
            return $this->response($todolist);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data not valid",
            ];
            return $this->response($data, 422);
        }

    }


    /**
     * @param TodolistRepository $TodolistRepository
     * @param $id
     * @return JsonResponse
     * @Route("/todolist/{id}", name="todolist_delete", methods={"DELETE"})
     */
    public function deleteTodolist(EntityManagerInterface $entityManager, TodolistRepository $TodolistRepository, $id)
    {
        $todolist = $TodolistRepository->find($id);

        if (!$todolist){
            $data = [
                'status' => 404,
                'errors' => "Todolist not found",
            ];
            return $this->response($data, 404);
        }

        $entityManager->remove($todolist);
        $entityManager->flush();
        $data = [
            'status' => 200,
            'errors' => "TodoList deleted successfully",
        ];
        return $this->response($data);
    }



    /**********************************
     *              TASKS
     *********************************/

    /**
     * @param TaskRepository $TaskRepository
     * @return JsonResponse
     * @Route("/tasks", name="tasks", methods={"GET"})
     */
    public function getTasks(TaskRepository $TaskRepository)
    {
        $data = $TaskRepository->findAll();
        return $this->response($data);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TaskRepository $TaskRepository
     * @return JsonResponse
     * @throws \Exception
     * @Route("/tasks", name="tasks_add", methods={"POST"})
     */
    public function addTask(Request $request, EntityManagerInterface $entityManager)
    {

        try{
            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') ){
                $data = [
                    'status' => 404,
                    'success' => "Name can't be NULL",
                ];
                return $this->response($data);
            }

            $task = new Task();
            $task->setName($request->get('name'));
            $task->setDescription($request->get('description'));

            $todolist = $entityManager->getRepository(Todolist::class)->find(1);

            $task->setTodolist($todolist);
            $entityManager->persist($task);
            $entityManager->flush();

            /* TODO: Would like to have a status in the response
            $data = [
                'status' => 200,
                'success' => "Task added successfully",
            ];
            */
            return $this->response($task);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data not valid",
            ];
            return $this->response($data, 422);
        }

    }


    /**
     * @param TaskRepository $TaskRepository
     * @param $id
     * @return JsonResponse
     * @Route("/tasks/{id}", name="tasks_get", methods={"GET"})
     */
    public function getTask(TaskRepository $TaskRepository, $id)
    {
        $task = $TaskRepository->find($id);

        if (!$task){
            $data = [
                'status' => 404,
                'errors' => "Task not found",
            ];
            return $this->response($data, 404);
        }
        return $this->response($task);
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param TaskRepository $TaskRepository
     * @param $id
     * @return JsonResponse
     * @Route("/tasks/{id}", name="tasks_put", methods={"PUT"})
     */
    public function updateTask(Request $request, EntityManagerInterface $entityManager, TaskRepository $TaskRepository, $id)
    {
        try{
            $task = $TaskRepository->find($id);

            if (!$task){
                $data = [
                    'status' => 404,
                    'errors' => "Task not found",
                ];
                return $this->response($data, 404);
            }

            $request = $this->transformJsonBody($request);

            if (!$request || !$request->get('name') ){
                $data = [
                    'status' => 404,
                    'success' => "Name can't be NULL",
                ];
                return $this->response($data);
            }

            $task->setName($request->get('name'));
            $task->setDescription($request->get('description'));
            $todolist = $entityManager->getRepository(Todolist::class)->find(1);
            $task->setTodolist($todolist);
            $entityManager->persist($task);
            $entityManager->flush();


            /* TODO: Would like to have a status in the response
            $data = [
                'status' => 200,
                'errors' => "Task updated successfully",
            ];
            */

            return $this->response($task);

        }catch (\Exception $e){
            $data = [
                'status' => 422,
                'errors' => "Data not valid",
            ];
            return $this->response($data, 422);
        }

    }


    /**
     * @param TaskRepository $TaskRepository
     * @param $id
     * @return JsonResponse
     * @Route("/tasks/{id}", name="tasks_delete", methods={"DELETE"})
     */
    public function deleteTask(EntityManagerInterface $entityManager, TaskRepository $TaskRepository, $id)
    {
        $task = $TaskRepository->find($id);

        if (!$task){
            $data = [
                'status' => 404,
                'errors' => "Task not found",
            ];
            return $this->response($data, 404);
        }

        $entityManager->remove($task);
        $entityManager->flush();
        $data = [
            'status' => 200,
            'errors' => "Task deleted successfully",
        ];
        return $this->response($data);
    }

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }

    protected function transformJsonBody(\Symfony\Component\HttpFoundation\Request $request)
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }

}
