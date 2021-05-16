<!DOCTYPE html>
<?php include 'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
$perPage = (isset($_GET['per-page']) && (int)($_GET['per-page']) <= 50 ? (int)$_GET['per-page'] : 5);
$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;


$sql = "select * from tasks limit " . $start . "," . $perPage . " ";
$total = $db->query("select * from tasks")->num_rows;
$Count = mysqli_num_rows($db->query("select * from tasks"));

$pages = ceil($total / $perPage);


$data = $db->query($sql);

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
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <div class="container p-3 mb-2 bg-light text-dark">
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

                <div class="input-group">
                    <form action="search.php" method="POST">
                        <input type="text" class="form-control" placeholder="🔍Search" name="search">
                    </form>
                </div>


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
                            <td class="col-md-10 text-dark"><?php echo $row['name']; ?></td>
                            <td><a href="update.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-outline-primary btn-sm">Edit</a></td>
                            <td><a href="delete.php?id=<?php echo $row['id'] ?>"
                                    class="btn btn-outline-danger btn-sm">Delete</a></td>
                        </tr>
                        <?php $i++ ?>
                        <?php endwhile;  ?>
                    </tbody>
                </table>
                <center>
                    <ul class="pagination" style="padding-left: 50%;">
                        <li>
                            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                            <a class="btn btn-group  btn-outline-secondary " aria-label="Toolbar with button groups"
                                href="?page=<?php echo $i; ?>&per-page=<?php echo $perPage; ?>"><?php echo $i; ?></a>
                            <?php endfor ?>
                        </li>
                    </ul>
                </center>
            </div>

        </div>
    </div>


</body>

</html>