function check(id) {
    var check = ($('#check' + id).prop("checked"));

    if (check) {
        $.ajax({
            url: '../task/updateCheck',
            type: 'post',
            data: {
                task: id,
                status: 1
            },
            success: function (data) {
                if (data) {
                    $('#name-' + id).addClass('check');
                }
            }
        });

    } else {
        $.ajax({
            url: '../task/updateCheck',
            type: 'post',
            data: {
                task: id,
                status: 0
            },
            success: function (data) {
                if (data) {
                    $('#name-' + id).removeClass('check');
                    // $('#' + id).remove();
                }
            }
        });
    }
}


// --------------------------------------------- Projects ------------------------------------------------------------//

function newProject() {

    console.log($("div.project:last").length);
    if ($("div.project:last").length == 0) {

        $("div.py-5:first").after('<div class="row project">' +
            '<div class="card w-75">' +
            '<div class="card-header bg-primary  text-white" id="project-new">' +
            '<div class="row">' +
            '<div class="col-xs-7 col-sm-7 col-md-9">' +
            '<input type="text" class="form-control form-control-sm" name="title" id="title-new" ' +
            'placeholder="Title of new project" required >' +
            '</div>' +
            '<div class="btn-group col-xs-5 col-sm-5 col-md-3" role="group">' +
            '<button class="btn btn-success" onclick="createProject()"><i class="fa fa-check"></i></button>' +
            // '<button class="btn btn-secondary" onclick=""><i class="fa fa-trash-o" aria-hidden="true"></i></button>' +
            '</div>' +
            '        </div>' +
            '        </div>' +
            '    </div>' +
            '</div>');
        $("div.container:last").remove();
    } else {
        $("div.project:last").after('<div class="row project">' +
            '<div class="card w-75">' +
            '<div class="card-header bg-primary  text-white" id="project-new">' +
            '<div class="row">' +
            '<div class="col-xs-7 col-sm-7 col-md-9">' +
            '<input type="text" class="form-control form-control-sm" name="title" id="title-new" ' +
            'placeholder="Title of new project" required >' +
            '</div>' +
            '<div class="btn-group col-xs-5 col-sm-5 col-md-3" role="group">' +
            '<button class="btn btn-success" onclick="createProject()"><i class="fa fa-check"></i></button>' +
            // '<button class="btn btn-secondary" onclick=""><i class="fa fa-trash-o" aria-hidden="true"></i></button>' +
            '</div>' +
            '        </div>' +
            '        </div>' +
            '    </div>' +
            '</div>');
        $("div.container:last").remove();
    }
}

function createProject() {
    var value = $("#title-new").val();

    if (value == '') {
        $('#title-new').addClass('alert-danger');
    } else {

        $.ajax({
            url: '../project/create',
            type: 'post',
            data: {
                name: value
            },
            success: function (id) {

                if (id) {
                    //$("#title-new").replaceWith(value);

                    var data = JSON.parse(id);

                    $("div.project:last").replaceWith('<div class="row project" id="project-' + data + '\">' +
                        '<div class="card w-75">' +
                        '<div class="card-header bg-primary text-white" >' +
                        '<div class="row">' +
                        '<div class="col-xs-7 col-sm-7 col-md-9" >' +
                        '<span id="title-' + data + '"><i class="fa fa-calendar" aria-hidden="true"></i>' + value + '</span>' +
                        '</div>' +
                        '<div class="btn-group col-xs-5 col-sm-5 col-md-3" role="group"> ' +
                        '<button class="btn btn-link" onclick="editProject(' + data + ')">' +
                        '<i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-link" onclick="deleteProject(' + data + ')">' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                        '</button></div></div></div>' +
                        '<div class="card-header bg-light "><div class="row">' +
                        '<div class="col-1 text-center pt-2"><p><i class="fa fa-plus"></i></p> ' +
                        '</div><div class="col-11">' +
                        '<div class="input-group"> ' +
                        '<input type="text" class="form-control" name="task" id="task-' + data + '" placeholder="Start typing here to create a task..." required> ' +
                        '<div class="input-group-prepend"> ' +
                        '<button class="btn-success input-group-text btn btn-success" onclick="addTask(' + data + ')">Add Task ' +
                        '</button></div></div></div></div></div></div></div>' +
                        '<div class="container center-block">' +
                        '    <div class="row justify-content-md-center">' +
                        '        <button class="btn btn-primary" onclick="newProject()">' +
                        '            <i class=" fa fa-plus"></i> Add TODO List ' +
                        '        </button>' +
                        '    </div>' +
                        '</div>');
                }
            }
        });
    }
}

function editProject(id) {
    var value = $("#title-" + id).text();

    $("#title-" + id).replaceWith('<input type="text" class="form-control form-control-sm" name="title" id="title-edit-' + id + '" ' +
        'value="' + value + '">');

    $("#project-" + id + " .card-header div.btn-group").replaceWith('<div class="btn-group col-xs-5 col-sm-5 col-md-3" role="group">' +
        '<button class="btn btn-success" onclick="updateProject(' + id + ')">' +
        '<i class="fa fa-check" aria-hidden="true"></i></button></div>');
}

function updateProject(id) {
    var name = document.getElementById("title-edit-" + id).value;

    if (name == '') {
        $('#title-edit-' + id).addClass('alert-danger');
    } else {
        $.ajax({
            url: '../project/update',
            type: 'post',
            data: {
                id: id,
                name: name
            },
            success: function (data) {

                if (data) {
                    $("#title-edit-" + id).replaceWith('<span id="title-' + id + '">' +
                        '<i class="fa fa-calendar" aria-hidden="true"></i> ' + name + '</span>');
                    $("#project-" + id + " div.btn-group").replaceWith('<div class="btn-group col-xs-5 col-sm-5 col-md-3" role="group"> ' +
                        '<button class="btn btn-link" onclick="editProject(' + data['id'] + ')">' +
                        '<i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-link" onclick="deleteProject(' + data['id'] + ')">' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i>' +
                        '</button></div>');
                }
            }
        });
    }
}

function deleteProject(id) {
    $.ajax({
        url: '../project/delete',
        type: 'post',
        data: {
            id: id
        },

        success: function (data) {
            if (data) {
                $('div#project-' + id).remove();
            }
        }
    });
}

// ----------------------------------------------- Tasks -------------------------------------------------------------//

function addTask(id) {
    var task = document.getElementById("task-" + id).value;
    var table = document.getElementById("table-" + id);

    if (task == '') {
        $('#task-' + id).addClass('alert-danger');
    } else {

        $.ajax({
            url: '../task/add',    // путь к обработчику
            type: 'post',               // метод передачи
            data: {
                task: task,
                project_id: id
            },
            success: function (taskId) {
                $('#task-' + id).val('');
                var data = JSON.parse(taskId);

                if (typeof (table) != 'undefined' && table != null) {
                    $("#table-" + id + " tr:last").after(
                        '<tr id="' + data + '" class="sortable ui-sortable-handle">' +
                        '<td class="text-center">' +
                        '<input class="form-check-input" type="checkbox" value="0" id="check' + data + '" onclick="check(' + data + ')"></td>' +
                        '<td id="name-' + data + '" class=" "><span>' + task + '</span></td>' +
                        '<td class="text-center w-25">' +
                        '<div class="btn-group buttons" role="group" >' +
                        '<button class="btn btn-link" onclick="editTask(' + data + ')">' +
                        '<i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-link" onclick="deleteTask(' + data + ')">' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i></button></div></td></tr>');
                } else {
                    $("#project-" + id + " div.card-header:last").after('<div class="card-body">' +
                        '<table class="table" id="table-' + data + '">' +
                        '<tbody class="ui-sortable">' +
                        '<tr id="' + data + '" class="sortable ui-sortable-handle"><td class="text-center">' +
                        '<input class="form-check-input" type="checkbox" value="0" id="check' + data + '" onclick="check(' + data + ')"></td>' +
                        '<td id="name-' + data + '" ><span>' + task + '</span></td>' +
                        '<td class="text-center w-25">' +
                        '<div class="btn-group buttons" role="group" >' +
                        '<button class="btn btn-link" onclick="editTask(' + data + ')">' +
                        '<i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-link" onclick="deleteTask(' + data + ')">' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i></button></div></td></tr>' +
                        '</tbody></table></div>');
                }
            }
        });
    }
}

function deleteTask(id) {
    $.ajax({
        url: '../task/delete',
        type: 'post',
        data: {task: id},

        success: function (data) {
            if (data) {
                $('#' + id).remove();
            }
        }
    });
}

function editTask(id) {
    var value = $("#name-" + id).text();

    $("#name-" + id).replaceWith('<td id="name-' + id + '">' +
        '<input type="text" class="form-control form-control-sm" name="task" id="name-edit-' + id + '" value="' + value + '" required>' +
        '</td>');
    $("#" + id + " div.btn-group").replaceWith(
        '<div class="btn-group buttons" role="group" >' +
        '<button class="btn btn-success" onclick="updateTask(' + id + ')">' +
        '<i class="fa fa-check" aria-hidden="true"></i></button>' +
        '</div>');
}

function updateTask(id) {

    var name = document.getElementById("name-edit-" + id).value;

    if (name == '') {
        $('#name-edit-' + id).addClass('alert-danger');
    } else {
        $('#name-edit-' + id).val('');

        $.ajax({
            url: '../task/update',
            type: 'post',
            data: {
                id: id,
                name: name
            },
            success: function (data) {
                if (data) {
                    $("#name-edit-" + id).replaceWith('<span>' + name + '</span>');
                    $("#" + id + " div.btn-group").replaceWith('<div class="btn-group" role="group" >' +
                        '<button class="btn btn-link" onclick="editTask(' + id + ')">' +
                        '<i class="fa fa-edit"></i></button>' +
                        '<button class="btn btn-link" onclick="deleteTask(' + id + ')">' +
                        '<i class="fa fa-trash-o" aria-hidden="true"></i></button></div>');
                }
            }
        });
    }
}

// -------------------------------------------------------------------------------------------------------------------//

$(document).ready(function () {
    var result;
    $("tbody").sortable({
        update: function (event, ui) {
            var result = $(this).sortable('toArray', {attribute: 'id'});

            var object = {};
            result.forEach(function (value, key) {
                object[key] = value;
            });
            console.log(object);

            $.ajax({
                url: '../task/changePriority',
                type: 'post',
                data: object
            });
        }
    });
});

$(document).ready(function () {
    $("#register").click(function () {
        var email = $("#inputEmail").val();
        var password = $("#inputPassword").val();
        var cpassword = $("#confirmPassword").val();

        if (email == '' || password == '' || cpassword == '') {
            $('#inputEmail').addClass('alert-danger');
            $('#inputPassword').addClass('alert-danger');
            $('#confirmPassword').addClass('alert-danger');

            alert("Please fill all fields !");
        } else if ((password.length) < 8) {
            $('#inputEmail').removeClass('alert-danger');
            $('#inputPassword').addClass('alert-danger');

            alert("Password should 8 character in length ");

        } else if (!(password).match(cpassword)) {
            $('#inputEmail').removeClass('alert-danger');
            $('#inputPassword').addClass('alert-danger');
            $('#confirmPassword').addClass('alert-danger');

            alert("Your passwords don't match. Try again?");
        } else {

            $.ajax({
                url: '../user/actionRegister',     // путь к обработчику
                type: 'post',                   // метод передачи
                data: {
                    email: email,
                    password: password,
                    cpassword: cpassword
                },
                success: function (result) {

                    var data = JSON.parse(result);
                    if (data.error) {
                        $('div.alert').remove();
                        $("div.py-5:last").after('<div class="alert alert-danger" role="alert">' +
                            '<span>' + data.error + '</span></div>');
                    } else if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                }
            })
        }
    })
});