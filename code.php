<?php
session_start();
include('db-connect.php');
//$errors = [];

if(isset($_POST['delete_student'])){
    $student_id = $_POST['delete_student'];
    try{
        $sql = "Delete from students_info WHERE id =:stud_id";
        $query_run = $conn->prepare($sql);
        $data = [
            ':stud_id' => $student_id ];
        $result = $query_run->execute($data);
        if ($result) {
            $_SESSION['success_message'] = "Student information deleted successfully";
        } else {
            $_SESSION['error_message'] = "Failed to deleted student information";
        }
        header("Location: index.php");
        exit(0);
    }
    catch (PDOException $e) {
        echo $e->getMessage();
    }
}

if (isset($_POST['update_student_info'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $division = $_POST['division'];
    $district = $_POST['district'];
    $dob = $_POST['dob'];
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $image = $target_file;
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        } else {
            echo "File is not an image.";
            exit;
        }
    } else {
        $query = "SELECT image FROM students_info WHERE id = :stud_id LIMIT 1";
        $statement = $conn->prepare($query);
        $data = [':stud_id' => $id];
        $statement->execute($data);
        $result = $statement->fetch(PDO::FETCH_OBJ);
        if ($result && !empty($result->image)) {
            // If an existing image path is found, use it
            $image = $result->image;
        } else {

            $_SESSION['error_message'] = "Please insert your image.";
            header("Location: student-edit.php?id=$id"); // Redirect back to edit page
//            echo "PLEASE ENTER YOUR IMAGE!";
            exit(0);
        }
    }

    try {
        // Proceed with updating the student information
        $sql = "UPDATE students_info SET name = :name, email = :email, address = :address, phone = :phone, gender = :gender, division = :division, district = :district, dob = :dob, image = :image WHERE id = :stud_id LIMIT 1";
        $query_run = $conn->prepare($sql);
        $data = [
            ':stud_id' => $id,
            ':name' => $name,
            ':email' => $email,
            ':address' => $address,
            ':phone' => $phone,
            ':gender' => $gender,
            ':division' => $division,
            ':district' => $district,
            ':dob' => $dob,
            ':image' => $image,
        ];
        $result = $query_run->execute($data);
        if ($result) {
            $_SESSION['success_message'] = "Student information updated successfully";
        } else {
            $_SESSION['error_message'] = "Failed to update student information";
        }
        header("Location: index.php");
        exit(0);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


//if(isset($_POST['save_student_info'])) {
//    if (empty($_POST['name'])) {
//        $errors['name'] = "Name is required";
//    } else {
//        $name = $_POST['name'];
//    }
//    if (empty($_POST['email'])) {
//        $errors['email'] = "Email is required";
//    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//        $errors['email'] = "Invalid email format";
//    } else {
//        $email = $_POST['email'];
//    }
//    if (empty($_POST['address'])) {
//        $errors['address'] = "Address is required";
//    } else {
//        $address = $_POST['address'];
//    }
//    if (empty($_POST['phone'])) {
//        $errors['phone'] = "Phone number is required";
//    } elseif (!preg_match("/^(01[1-9])[0-9]{8}$/", $_POST['phone'])) {
//        $errors['phone'] = "Invalid phone number format";
//    } else {
//        $phone = $_POST['phone'];
//    }
//    if (empty($_POST['gender'])) {
//        $errors['gender'] = "Gender is required";
//    } else {
//        $gender = $_POST['gender'];
//    }
//    if (empty($_POST['division'])) {
//        $errors['division'] = "Division is required";
//    } else {
//        $division = $_POST['division'];
//    }
//    if (empty($_POST['district'])) {
//        $errors['district'] = "District is required";
//    } else {
//        $district = $_POST['district'];
//    }
//    if (empty($_POST['dob'])) {
//        $errors['dob'] = "Date of birth is required";
//    } else {
//        $dob = $_POST['dob'];
//    }
//
//    if (empty($_FILES['image']['name'])) {
//        $errors['image'] = "Image is required";
//    } else {
//        $target_dir = "images/";
//        $target_file = $target_dir . basename($_FILES["image"]["name"]);
//        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
//        $image = $target_file;
//        $check = getimagesize($_FILES["image"]["tmp_name"]);
//        if ($check === false) {
//            $errors['image'] = "File is not an image";
//        } else {
//            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
//        }
//    }
//
//    try {
//        if (empty($errors)) {
//            $sql = "INSERT INTO students_info (name, email, address, phone, gender, division, district, dob, image) VALUES (:name, :email, :address, :phone, :gender, :division, :district, :dob, :image)";
//            $query_run = $conn->prepare($sql);
//            $data = [
//                ':name' => $name,
//                ':email' => $email,
//                ':address' => $address,
//                ':phone' => $phone,
//                ':gender' => $gender,
//                ':division' => $division,
//                ':district' => $district,
//                ':dob' => $dob,
//                ':image' => $image,
//            ];
//            $result = $query_run->execute($data);
//            if ($result) {
//                $_SESSION['success_message'] = "Student information inserted successfully";
//            } else {
//                $_SESSION['error_message'] = "Failed to insert student information";
//            }
//            header("Location: index.php");
//            exit;
//        } else {
//            $_SESSION['errors'] = $errors;
//            header("Location: student-add.php");
//            exit;
//        }
//    } catch (PDOException $e) {
//        $_SESSION['error_message'] = "Database error: " . $e->getMessage();
//        header("Location: student-add.php");
//        exit;
//    }
//}
if(isset($_POST['save_student_info'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone= $_POST['phone'];
    $gender = $_POST['gender'];
    $division = $_POST['division'];
    $district = $_POST['district'];
    $dob = $_POST['dob'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image = $target_file;
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    } else {
        echo "File is not an image.";
        exit;
    }
//    $image= $_POST['image'];

    $sql = "INSERT INTO students_info (name , email, address, phone, gender, division, district, dob, image) VALUES (:name , :email, :address, :phone, :gender, :division, :district, :dob, :image)";
    $query_run = $conn->prepare($sql);
    $data = [
            ':name' => $name,
            ':email' => $email,
            ':address' => $address,
            ':phone' => $phone,
            ':gender' => $gender,
            ':division' => $division,
            ':district' => $district,
            ':dob' => $dob,
            ':image' => $image,
    ];
    $result = $query_run ->execute($data);
    if($result){
        $_SESSION['success_message'] = "Student information inserted successfully";
    } else {
        $_SESSION['error_message'] = "Failed to insert student information";
    }

    header("Location: index.php");
    exit(0);
}
?>