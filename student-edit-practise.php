<?php
session_start();
include('db-connect.php');
$query = "SELECT * FROM loc_divisions";
$statement = $conn->prepare($query);
$statement->execute();
$divisions = $statement->fetchAll(PDO::FETCH_ASSOC);

// Fetch districts
$query = "SELECT * FROM loc_districts";
$statement = $conn->prepare($query);
$statement->execute();
$districts = $statement->fetchAll(PDO::FETCH_ASSOC);
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
      <?php if(isset($_SESSION['success_message'])): ?>
          <h5 class="alert alert-success text-center"><?php echo $_SESSION['success_message']; ?></h5>
          <?php unset($_SESSION['success_message']); endif; ?>

      <?php if(isset($_SESSION['error_message'])): ?>
          <h5 class="alert alert-danger text-center"><?php echo $_SESSION['error_message']; ?></h5>
          <?php unset($_SESSION['error_message']); endif; ?>
      <div class="card mb-5">
          <div class="card-header">
              <h3 class="text-center" >Student Information Edit and Update<a href="index.php" class="btn btn-danger float-right">Back</a></h3>
          </div>
      </div>
      <?php
      if(isset($_GET['id'])){
          $student_id =$_GET['id'];
          $query ="SELECT * FROM students_info WHERE id=:stud_id LIMIT 1";
          $statement =$conn->prepare($query);
          $data = [':stud_id' => $student_id];
          $statement-> execute($data);
          $result = $statement->fetch(PDO:: FETCH_OBJ);
      }
      ?>
    <form action="code.php" method="POST" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" name="id" value="<?= $result->id ?>">
        <div class="col form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="<?= $result->name; ?>" name="name" required>
        </div>
        <div class="col form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" value="<?= $result->email; ?>" name="email" required>
        </div>
    </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input type="text" class="form-control" id="address" value="<?= $result->address; ?>"name="address" required>
      </div>
      <div class="row">
      <div class="col form-group">
        <label for="phone">Phone:</label>
        <input type="text" class="form-control" id="phone" value="<?= $result->phone; ?>" name="phone" required>
      </div>
      <div class="col form-group">
        <label for="gender">Gender:</label>
        <div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="male" name="gender" value="male" <?= ($result->gender === 'male') ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="female" name="gender" value="female" <?= ($result->gender === 'female') ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" id="other" name="gender" value="other" <?= ($result->gender === 'other') ? 'checked' : ''; ?> required>
                <label class="form-check-label" for="other">Other</label>
            </div>
        </div>
      </div>
      </div>

      <div class="row">
      <div class="col form-group">
        <label for="division">Division:</label>
        <select class="form-control" id="division" name="division" required>
            <?php
            $query = "SELECT * FROM loc_divisions";
            $statement = $conn->prepare($query);
            $statement->execute();
            $divisions = $statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($divisions as $division) {
                $selected = ($result->division === $division['title_en']) ? 'selected' : '';
                echo "<option value='" . $division['id'] . "' $selected>" . $division['title_en'] . "</option>";
            }
            ?>
<!--          <option value="Dhaka" --><?php //= ($result->division === 'Dhaka') ? 'selected' : ''; ?><!-->Dhaka</option>-->
<!--          <option value="Chattogram" --><?php //= ($result->division === 'Chattogram') ? 'selected' : ''; ?><!-- >Chattogram</option>-->
<!--          <option value="Sylhet" --><?php //= ($result->division === 'Sylhet') ? 'selected' : ''; ?><!-->Sylhet</option>-->
<!--          <option value="Rajshahi" --><?php //= ($result->division === 'Rajshahi') ? 'selected' : ''; ?><!-->Rajshahi</option>-->
<!--          <option value="Khulna" --><?php //= ($result->division === 'Khulna') ? 'selected' : ''; ?><!-->Khulna</option>-->
<!--          <option value="Barishal" --><?php //= ($result->division === 'Barishal') ? 'selected' : ''; ?><!-->Barishal</option>-->
        </select>
      </div>
          <div class="col form-group">
              <label for="district">District:</label>
              <select class="form-control" id="district" name="district" required>
                  <?php
                  $query = "SELECT * FROM loc_districts";
                  $statement = $conn->prepare($query);
                  $statement->execute();
                  $districts = $statement->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($districts as $district) {
                      $selected = ($result->district === $district['title_en']) ? 'selected' : '';
                      echo "<option value='" . $district['id'] . "' $selected>" . $district['title_en'] . "</option>";
                  }
                  ?>
<!--                  <option value="Cumilla" --><?php //= ($result->district === 'Cumilla') ? 'selected' : ''; ?><!-->Cumilla</option>-->
<!--                  <option value="Sherpur" --><?php //= ($result->district === 'Sherpur') ? 'selected' : ''; ?><!-->Sherpur</option>-->
<!--                  <option value="Jamalpur" --><?php //= ($result->district === 'Jamalpur') ? 'selected' : ''; ?><!-->Jamalpur</option>-->
<!--                  <option value="Chandpur" --><?php //= ($result->district === 'Chandpur') ? 'selected' : ''; ?><!-->Chandpur</option>-->
<!--                  <option value="Cox's Bazar" --><?php //= ($result->district === "Cox's Bazar") ? 'selected' : ''; ?><!-->Cox's Bazar</option>-->
<!--                  <option value="Jessore" --><?php //= ($result->district === 'Jessore') ? 'selected' : ''; ?><!-->Jessore</option>-->
<!--                  <option value="Narail" --><?php //= ($result->district === 'Narail') ? 'selected' : ''; ?><!-->Narail</option>-->
<!--                  <option value="Gazipur" --><?php //= ($result->district === 'Gazipur') ? 'selected' : ''; ?><!-->Gazipur</option>-->
<!--                  <option value="Narayanganj" --><?php //= ($result->district === 'Narayanganj') ? 'selected' : ''; ?><!-->Narayanganj</option>-->
<!--                  <option value="Sirajganj" --><?php //= ($result->district === 'Sirajganj') ? 'selected' : ''; ?><!-->Sirajganj</option>-->
<!--                  <option value="Tangail" --><?php //= ($result->district === 'Tangail') ? 'selected' : ''; ?><!-->Tangail</option>-->
              </select>
          </div>

      </div>
      <div class="row">
      <div class="col form-group">
        <label for="dob">Date of Birth:</label>
        <input type="date" class="form-control" id="dob" value="<?= $result->dob; ?>"  name="dob" required>
      </div>
      <div class="col form-group">
          <div class="col form-group">
              <label for="image">Image:</label>
              <input type="file" class="form-control-file" id="image" name="image">
          </div>
      </div>
      </div>
    <button type="submit" class="btn btn-primary" STYLE="" name="update_student_info">Update</button>
    </form>
  </div>
</body>
</html>
