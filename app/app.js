$(document).ready(function() {
    $.ajax ( {
        url: "list.php",
        type: "POST",
        success: function(data) {
            $("#list").html(data);
        },
        error: function(data) {
            alert('Error on showing list');
        }
    });
    
    $("#add-btn").on("click", function() {
        var task = $("#task").val();
        var task_length = $('#task').val().length;
        var user = $("#user").val();
        if (task  == '') {
            alert('You must enter a task');
            return false;
        }
        if (task_length > 50) {
            alert('Task length must be less than 50 characters');
            return false;
        }
        $.ajax ( {
            url: "add.php",
            type: "POST",
            data: {task: task, user: user},
            success: function(data) {
                location.reload();
                if (data == 0) {
                    alert('Error');
                }
                if (data != 0) {
                    $("#task").val('');
                }
            },
            error: function(data) {
                alert('Error on adding task');
            }
        });
    });
    
    $(document).on("click", "#delete-btn", function() {
        var id = $(this).data('id');
        $.ajax ( {
            url: "delete.php",
            type: "POST",
            data: {id: id},
            success: function(data) {
                location.reload();
                if (data == 0) {
                    alert("Error");
                }
            },
            error: function(data) {
                alert('Error on deleting task');
            }
        });
    });
});