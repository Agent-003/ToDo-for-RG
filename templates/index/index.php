<div class="container">
    <div class="py-5 text-center">
        <h2>SIMPLE TODO LISTS</h2>
        <p class="lead">FROM RUBY GARAGE</p>
        <form action="../user/logOut" method="post" class="text-center">
            <div class="form-group row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-secondary">Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($data)) {
        foreach ($data as $project) { ?>
        <div class="row project" id="project-<?php echo $project['id']; ?>">
            <div class="card w-75">
                <div class="card-header bg-primary  text-white">
                    <div class="row">
                        <div class="col-xs-7 col-sm-7 col-md-9">
                        <span id="title-<?php echo $project['id']; ?>">
                        <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $project['name']; ?></span>
                        </div>
                        <div class="btn-group col-xs-5 col-sm-5 col-md-3" role="group">
                            <button class="btn btn-link" onclick="editProject(<?php echo $project['id']; ?>)">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="btn btn-link"
                                    onclick="deleteProject(<?php echo $project['id']; ?>)">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-header bg-light ">
                    <div class="row">
                        <div class="col-1 text-center pt-2">
                            <p><i class="fa fa-plus"></i></p>
                        </div>
                        <div class="col-11">
                            <div class="input-group">
                                <input type="text" class="form-control" name="task"
                                           id="task-<?php echo $project['id']; ?>"
                                           placeholder="Start typing here to create a task..." required>

                                    <div class="input-group-prepend">
                                        <button class="btn-success input-group-text btn btn-success"
                                                onclick="addTask(<?php echo $project['id']; ?>)">Add Task
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if (isset($project['tasks'])) { ?>
                    <div class="card-body">
                        <table class="table" id="table-<?php echo $project['id']; ?>">
                            <tbody >
                            <?php foreach ($project['tasks'] as $task) { ?>
                                <tr id="<?php echo $task['id'] ?>" class="sortable">
                                    <td class="text-center">
                                        <input class="form-check-input" type="checkbox"
                                               value="<?php echo $task['status'] ?>"
                                               id="check<?php echo $task['id']; ?>"
                                               onclick="check(<?php echo $task['id'] ?>)"
                                            <?php echo $task['status'] == 1 ? 'checked' : ''; ?>>
                                    </td>

                                    <td id="name-<?php echo $task['id']; ?>"
                                        class="<?php echo $task['status'] == 1 ? 'check' : ''; ?> "><span><?php echo $task['name'] ?> </span>
                                    </td>

                                    <td class="text-center w-25">
                                        <div class="btn-group buttons" role="group">
                                            <button class="btn btn-link"
                                                    onclick="editTask(<?php echo $task['id']; ?>)">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-link"
                                                    onclick="deleteTask(<?php echo $task['id']; ?>)">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php }
    }?>

</div>

<div class="container center-block">
    <div class="row justify-content-md-center">
        <button class="btn btn-primary" onclick="newProject()">
            <i class=" fa fa-plus"></i> Add TODO List
        </button>
    </div>
</div>