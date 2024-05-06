<?php
session_start();
include('db-connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!--    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mt4">
            <?php if(isset($_SESSION['success_message'])): ?>
                <h5 class="alert alert-success text-center"><?php echo $_SESSION['success_message']; ?></h5>
                <?php unset($_SESSION['success_message']); endif; ?>

            <?php if(isset($_SESSION['error_message'])): ?>
                <h5 class="alert alert-danger text-center"><?php echo $_SESSION['error_message']; ?></h5>
                <?php unset($_SESSION['error_message']); endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3>PHP PDO CRUD <a href="student-add.php" class="btn btn-primary float-end">Add Student</a></h3>
                </div>
            </div>
                <div class="mt-5">
                    <table class="table table-border border-primary">
                        <thead class="table-dark fs-4 text-center align-middle ">
                        <tr class="">
                            <td>Name</td>
                            <td>Email</td>
                            <td>Address</td>
                            <td>Phone</td>
                            <td>Gender</td>
                            <td>Division</td>
                            <td>District</td>
                            <td>Birthdate</td>
                            <td>Image Path</td>
                            <td>Edit</td>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody class="text-center ">
                        <?php
                        $query = "SELECT s.*, d.title_en AS division_name, dt.title_en AS district_name FROM students_info s inner join loc_divisions d on s.division = d.id inner join loc_districts dt on s.district = dt.id";
                        $statement = $conn->prepare($query);
                        $statement->execute();
                        $result = $statement->fetchAll(PDO::FETCH_OBJ);
                        if($result){
                            foreach($result as $row){
                                ?>
                                <tr>
                                    <td> <?= $row->name; ?> </td>
                                    <td> <?= $row->email; ?> </td>
                                    <td> <?= $row->address; ?> </td>
                                    <td> <?= $row->phone; ?> </td>
                                    <td> <?= $row->gender; ?> </td>
                                    <td> <?= $row->division_name; ?> </td>
                                    <td> <?= $row->district_name?> </td>
                                    <td> <?= $row->dob; ?> </td>
                                    <td> <?= $row->image; ?> </td>
                                    <td> <a href="student-edit.php?id=<?= $row->id; ?> " class="btn btn-primary">edit</a> </td>
                                    <td> <form action="code.php" method="post">
                                            <button type="submit" name="delete_student" class="btn btn-danger" value=" <?= $row->id; ?> "> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr >
                                <td colspan="9"> No record found</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>



</script>

</body>
</html>
