<?php 


$db_name = "mysql:host=localhost;dbname=testing";
$user_name = "root";
$password = "";

try {
    $conn = new PDO($db_name, $user_name, $password);
    $title = "dhaka";
    $bbs_code = 30;

    /*Type 1

        $sql = $conn->prepare("SELECT * FROM loc_divisions WHERE title_en = ? and  bbs_code = ?");
        $sql-> bindParam(1,$title, PDO:: PARAM_STR);
        $sql-> bindParam(2,$bbs_code, PDO:: PARAM_INT);
        $sql->execute();
    */

    /* type 2

        $sql = $conn->prepare("SELECT * FROM loc_divisions WHERE title_en = ? and  bbs_code = ?");
        $sql->execute(array($title,$bbs_code));
     */

      /* type 3

        $sql = $conn->prepare("SELECT * FROM loc_divisions WHERE title_en = :title and  bbs_code = :bbs");
        $sql-> bindParam(':title',$title, PDO:: PARAM_STR);
        $sql-> bindParam(':bbs',$bbs_code, PDO:: PARAM_INT);
        $sql->execute();
       */

    //type 4
    $sql = $conn->prepare("SELECT * FROM loc_divisions WHERE title_en = :title and  bbs_code = :bbs");
    $sql->execute(array(':title'=>$title, ':bbs'=>$bbs_code));

    $result = $sql ->fetchALL();
     echo "<pre>";
     print_r($result);
     echo "</pre>";
//    while ($row = $sql->fetch(PDO::FETCH_OBJ)) {
//        echo "{$row->id} - {$row->title} - {$row->title_en} - {$row->bbs_code} <br>";
//        echo "{$row['id']} - {$row['title']} - {$row['title_en']} - {$row['bbs_code']} <br>";
        // echo "<pre>";
        // print_r($row);
        // echo "</pre>";
  //  }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// $db_name ="mysql:host=localhost;dbname=testing";
// $user_name = "root";
// $password = "";

// $conn = new PDO($db_name,$user_name,$password);
// $sql = new $conn-> query(" SELECT * FROM loc_divisions ");

// while( $row = $sql->fetch()){
//     echo "<pre>";
//     print_r($row);
//     echo "</pre>";
// }
    // class Database{
    //     private $db_host= "localhost";
    //     private $db_user= "root";
    //     private $db_pass= "";
    //     private $db_mame= "students_information";

    //     public function insert(){
            
    //     }
    //     public function update(){

    //     }
    //     public function show(){

    //     }
    //     public function destroy(){

    //     }
    //     public function __construct(){

    //     }
    // }


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Project</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="text-center bg-primary rounded text-white my-5">Student Information Form</h1>
    <form action="process.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" name="address" required>
      </div>
      <div class="row">
      <div class="col form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" name="phone" required>
      </div>
      <div class="col form-group">
        <label for="gender">Gender:</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="male" name="gender" value="male" required>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="female" name="gender" value="female" required>
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="other" name="gender" value="other" required>
                <label class="form-check-label" for="other">Other</label>
            </div>
        </div>
      </div>
      </div>

      <div class="row">
      <div class="col form-group">
        <label for="division">Division:</label>
        <select class="form-control" id="division" name="division" required>
          <option value="division1">Dhaka</option>
          <option value="division2">Chattogram</option>
          <option value="division3">Sylhet</option>
          <option value="division4">Rajshahi</option>
          <option value="division5">Khulna</option>
          <option value="division6">Barishal</option>
        </select>
      </div>
      <div class="col form-group">
        <label for="district">District:</label>
        <select class="form-control" id="district" name="district" required>
          <option value="district1">Cumilla</option>
          <option value="district2">Sherpur Jamalpur</option>
          <option value="district3">Jamalpur</option>
          <option value="district4">Chandpur</option>
          <option value="district5"> Cox's Bazar</option>
          <option value="district6">Jessore</option>
          <option value="district6">Narail</option>
          <option value="district7">Gazipur</option>
          <option value="district8">Narayanganj</option>
          <option value="district9">Sirajganj</option>
          <option value="district10">Tangail</option>
        </select>
      </div>
      </div>
      <div class="row">
      <div class="col form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" class="form-control" id="dob" name="dob" required>
      </div>
      <div class="col form-group">
        <label for="image">Image:</label>
        <input type="file" class="form-control-file" id="image" name="image" required>
      </div>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
