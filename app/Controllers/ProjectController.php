<?php


namespace App\Controllers;

use App\Models\ProjectModel;
use App\Controllers\TaskController;

class ProjectController extends AbstractController
{
    public $model;
    public $tasks;

    public function __construct($pdo)
    {
        $this->model = new ProjectModel($pdo);
        $this->tasks = new TaskController($pdo);

    }

    public function index()
    {

    }

    public function getAllProjects()
    {
        $user_id = $_SESSION['user_id'];
        $projects = $this->model->getAllProjects($user_id);

        $data = $this->getAllProjectsWithTasks($projects);
        return $data;
    }


    public function getAllProjectsWithTasks($projects)
    {

        if (isset($projects)) {

            foreach ($projects as $project) {
                $project['tasks'] = $this->tasks->getAllTasks($project['id']);
                $data[] = $project;

            }
            return $data;
        }
    }

    public function create()
    {
        $name = $_POST['name'];
        $user = $_SESSION['user_id'];

        $data = $this->model->createProject($name, $user);

        echo json_encode($data);
    }


    public function update()
    {
        $project_id = $_POST['id'];
        $name = trim($_POST['name']);

        if ($this->model->updateProject($project_id, $name)) {
            echo json_encode(true);
        }
    }

    public function delete()
    {
        $project_id = $_POST['id'];
        if ($this->model->deleteProject($project_id)) {
            echo json_encode(true);
        }
    }


}