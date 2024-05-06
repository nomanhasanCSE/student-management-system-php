<?php
include('db-connect.php');
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
      <div class="card mb-5">
          <div class="card-header">
              <h3 class =" text-center">Student Information Form<a href="index.php" class="btn btn-danger float-right">Back</a></h3>
          </div>
      </div>
<!--    <h1 class="text-center bg-primary rounded text-white my-5">Student Information Form</h1>-->
    <form action="code.php" method="POST" enctype="multipart/form-data">
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
            <option value= ""> Select Division </option>
//             <?php
//            $query = "SELECT * FROM loc_divisions";
//            $statement = $conn->prepare($query);
//            $statement->execute();
//            $divisions = $statement->fetchAll(PDO::FETCH_ASSOC);
//            foreach ($divisions as $division) {
//                echo "<option value='" . $division['id'] . "'>" . $division['title_en'] . "</option>";
//            }
//            ?>
        </select>
      </div>
      <div class="col form-group">
        <label for="district">District:</label>
        <select class="form-control" id="district" name="district" required>
            <option value= "">Select Division First</option>
//          <?php
//            $query = "SELECT * FROM loc_districts";
//            $statement = $conn->prepare($query);
//            $statement->execute();
//            $districts = $statement->fetchAll(PDO::FETCH_ASSOC);
//            foreach ($districts as $district) {
//                echo "<option value='" . $district['id'] . "'>" . $district['title_en'] . "</option>";
//            }
//            ?>
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
    <button type="submit" class="btn btn-primary" name="save_student_info">Submit</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script>
      $(document).ready(function(){
          function loadData(type, category_id){
              $.ajax({
                  url :"get-districts.php",
                  type: "post",
                  data: {type: type, id : category_id},
                  success : function(data){
                      if( type == "districtData"){
                          $("#district").html(data);
                      } else {
                          $("#division").append(data);
                      }
                  }
              });
          }
          loadData();
          $("#division").on("change",function(){
              var division =  $("#division").val();
              loadData("districtData", division);
          });
      });
  </script>

</body>
</html>
