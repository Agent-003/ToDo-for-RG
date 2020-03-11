<?php


namespace App\Models;

use App\Application;
use App\Loader\DatabaseLoader;

class ProjectModel extends Model
{
    public function getAllProjects($id)
    {
        $result = $this->db->prepare('SELECT * FROM projects WHERE user_id = :id');
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->execute();

        $projects = $result->fetchAll(\PDO::FETCH_ASSOC);

        if ($projects) {
            return $projects;
        } else {

        }
    }

    public function createProject($name, $user)
    {
        $result = $this->db->prepare('INSERT INTO projects (`name`, user_id) VALUES (:name, :user_id) ');
        $result->bindParam(':name', $name, \PDO::PARAM_STR);
        $result->bindParam(':user_id', $user, \PDO::PARAM_INT);

        if (!$result->execute()) {
            $arr = $result->errorInfo();
            var_dump($arr);
        } else {
            return $this->db->lastInsertId();
        }
    }

    public function updateProject($project_id, $name)
    {
        $result = $this->db->prepare('UPDATE projects
                                    SET `name` = :name
                                    WHERE id = :id;');

        $result->bindParam(':name', $name, \PDO::PARAM_STR);
        $result->bindParam(':id', $project_id, \PDO::PARAM_INT);

        if ($result->execute()==true) {
            return true;
        }
    }

    public function deleteProject($project_id)
    {
        $result = $this->db->prepare('DELETE FROM projects WHERE id = :id');
        $result->bindParam(':id', $project_id, \PDO::PARAM_INT);

        if ($result->execute()) {
            $result = $this->db->prepare('DELETE FROM tasks WHERE project_id = :id');
            $result->bindParam(':id', $project_id, \PDO::PARAM_INT);

            return $result->execute();
        }
    }

}