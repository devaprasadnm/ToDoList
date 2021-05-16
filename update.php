<!DOCTYPE html>
<?php include 'db.php';
$id = (int)$_GET['id'];
$sql = "select * from tasks where id ='$id'";
$data = $db->query($sql);

$row = $data->fetch_assoc();

if(isset($_POST['send'])){
    $task =htmlspecialchars( $_POST['task']);
    $sql = "update tasks set name='$task' where id ='$id'";
$val = $db->query($sql);
header('location:index.php');

}

?>
<html lang="en">

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDoList</title>
</head>

<body>

    <div class="container">
        <div class="rows">
            <center>
                <h1> Update To Do List 📝 </h1>
            </center>

            <div class="col-md-10 col-md-offset-1">
                <h4>Update Task</h4>
                <hr>

                <!-- Modal Header -->
                <div class="modal-header">



                    <!-- Modal body -->
                    <div class="modal-body">
                        <form method="POST">
                            <div class="form-group">
                                <label>Task Name</label>
                                <input type="text" required name="task" value="<?php echo $row['name']; ?>"
                                    class="form-control">
                            </div>
                            <br>
                            <input type="submit" name="send" value="Update" class="btn btn-success">
                            <a href="index.php" class="btn btn-danger float-right">Cancel</a>
                        </form>
                    </div>

                </div>
            </div>
        </div>


    </div>

    </div>
    </div>


</body>

</html>