<?php


namespace App\Models;


class TaskModel extends Model
{
    public function getAllTasks($id)
    {
        $result = $this->db->prepare('SELECT * FROM tasks WHERE project_id = :id ORDER BY priority ASC');
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->execute();

        $tasks = $result->fetchAll(\PDO::FETCH_ASSOC);

        if ($tasks) {
            return $tasks;
        } else {

        }
    }

    public function getTask($task_id)
    {
        $result = $this->db->prepare('SELECT * FROM tasks WHERE id = :id');
        $result->bindParam(':id', $task_id, \PDO::PARAM_INT);
        $result->execute();
        $task = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $task;
    }

    public function addTask($task_name, $project_id)
    {
        $status = 0;
        $priority = 0;

        $result = $this->db->prepare('INSERT INTO tasks (`name`, project_id, `status`, priority) VALUES (:name, :project_id , :status, :priority) ');
        $result->bindParam(':name', $task_name, \PDO::PARAM_STR);
        $result->bindParam(':project_id', $project_id, \PDO::PARAM_INT);
        $result->bindParam(':status', $status, \PDO::PARAM_INT);
        $result->bindParam(':priority', $priority, \PDO::PARAM_INT);

        if (!$result->execute()) {
            $arr = $result->errorInfo();
            var_dump($arr);
        } else {
            return $this->db->lastInsertId();
        }
    }

    public function editTask($task_id)
    {
        $result = $this->db->prepare('SELECT * FROM tasks WHERE id = :id');
        $result->bindParam(':id', $task_id, \PDO::PARAM_INT);
        $result->execute();
        $task = $result->fetchAll(\PDO::FETCH_ASSOC);

        return $task;
    }

    public function updateTask($id, $name)
    {
        $status = 0;

        $result = $this->db->prepare('UPDATE tasks
                                    SET `name` = :name, `status` = :status
                                    WHERE id = :id;');

        $result->bindParam(':name', $name, \PDO::PARAM_STR);
        $result->bindParam(':status', $status, \PDO::PARAM_INT);
        //$result->bindParam(':project_id', $project_id, \PDO::PARAM_INT);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($result->execute()) {
            return true;
        };
    }

    public function deleteTask($task_id)
    {
        $result = $this->db->prepare('DELETE FROM tasks WHERE id = :id');
        $result->bindParam(':id', $task_id, \PDO::PARAM_INT);

        return $result->execute();
    }

    public function updateCheck($id, $status)
    {
        $result = $this->db->prepare('UPDATE tasks
                                    SET `status` = :status
                                    WHERE id = :id;');

        $result->bindParam(':status', $status, \PDO::PARAM_INT);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        if ($result->execute()) {
            return true;
        };
    }


    public function updatePriority($id, $priority)
    {
        $result = $this->db->prepare('UPDATE tasks
                                    SET `priority` = :priority
                                    WHERE id = :id;');

        $result->bindParam(':priority', $priority, \PDO::PARAM_INT);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        if (!$result->execute()) {
            $arr = $result->errorInfo();
            var_dump($arr);
        }

//
//        if (!$result->execute()) {
//            $arr = $result->errorInfo();
//            var_dump($arr);
    }
}