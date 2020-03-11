<?php


namespace App\Controllers;

use App\Models\TaskModel;

class TaskController extends AbstractController
{
    public function __construct($pdo)
    {
        $this->model = new TaskModel($pdo);
    }

    public function index()
    {

    }

    public function getAllTasks($project_id)
    {
        $tasks = $this->model->getAllTasks($project_id);
        return $tasks;
    }

    public function getTask($task_id)
    {
        $task = $this->model->getTask($task_id);
        return $task;
    }

    public function add()
    {
        $task = $_POST['task'];
        $project_id = $_POST['project_id'];

        $task_id = $this->model->addTask($task, $project_id);

        if ($task_id) {
            echo json_encode($task_id);
        }
    }

    public function edit()
    {
        $project_id = $_POST['project_id'];
        $task = $_POST['id'];
        $task = $this->model->editTask($task);
    }

    public function update()
    {
        $task = $_POST['id'];
        $name = trim($_POST['name']);

        if ($task = $this->model->updateTask($task, $name)) {
            echo json_encode(true);
        }
    }

    public function delete()
    {
        $id = $_POST['task'];
        $task = $this->model->deleteTask($id);
        echo json_encode($task);
    }

    public function updateCheck()
    {
        $id = $_POST['task'];
        $status = $_POST['status'];
        $check = $this->model->updateCheck($id, $status);

        echo json_encode($check);
    }

    public function changePriority()
    {
        $priorities = $_POST;

        foreach ($priorities as $priority => $id) {

            $this->model->updatePriority($id, $priority);
        }
    }
}