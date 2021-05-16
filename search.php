<!DOCTYPE html>
<?php include 'db.php';

if(isset($_POST['search'])){
    $name = htmlspecialchars($_POST['search']);
    $sql = "select * from tasks where name like '%$name%'";
    $data = $db->query($sql);
    
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
            <br>
            <center>
                <h1> To Do List 📝 </h1>
            </center>

            <div class="col-md-12 col-md-offset-1">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-outline-success">ADD
                    TASK</button>
                <hr><br>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title"> + Add a Task</h4>

                                <button type="button" class="btn-close" aria-label="Close"
                                    data-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="POST" action="add.php">
                                    <div class="form-group">
                                        <label>Task Name</label>
                                        <input type="text" required name="task" class="form-control">
                                    </div>
                                    <br>
                                    <input type="submit" name="send" value=" + Add" class="btn btn-success float-right">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

                <a href="index.php" class="btn btn-warning">Back</a>

                <?php if(mysqli_num_rows($data)<1): ?>
                <h2 class="text-danger text-center">Nothing Found</h2>

                <?php else: ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tasks</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php $i = 1; ?>
                            <?php while ($row = $data->fetch_assoc()) : ?>


                            <th scope="row"><?php echo $i; ?></th>
                            <td class="col-md-10"><?php echo $row['name']; ?></td>
                            <td><a href="update.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-outline-primary btn-sm">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-outline-danger btn-sm">Delete</a></td>
                        </tr>
                        <?php $i++ ?>
                        <?php endwhile;  ?>
                    </tbody>
                </table>

                <?php endif; ?>


            </div>

        </div>
    </div>


</body>

</html>