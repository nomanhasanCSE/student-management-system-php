<?php
include('db-connect.php');
$options = "";
if($_POST['type'] == ""){
    $query = "SELECT * FROM loc_divisions";
    $statement = $conn->prepare($query);
    $statement->execute();
    $divisions = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($divisions as $division) {
        $selected = ($division['id'] == $_POST['selected_division']) ? 'selected' : '';
        $options .= "<option value='{$division['id']}' $selected>{$division['title_en']}</option>";
    }
}
else if($_POST['type'] == "districtData"){
    $query = "SELECT * FROM loc_districts where loc_division_id = :div_id ";
    $statement = $conn->prepare($query);
    $data = [':div_id'=>$_POST['id']];
    $statement->execute($data);
    $districts = $statement->fetchAll(PDO::FETCH_ASSOC);
    var_dump($_POST['selected_district']);

    foreach ($districts as $district) {
        $selected = ($district['id'] == $_POST['selected_district']) ? 'selected' : '';
        $options .= "<option value='{$district['id']}' $selected>{$district['title_en']}</option>";
    }
}
echo $options;
?>
