<?php   // Hi, To make this work set the value to Null on database. - Think IT
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: /cdrrmo-project/login.php");
    exit();
} 
include('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response=$_POST['response'];
    $departure=$_POST['departure'];
    $arrival=$_POST['arrival'];
    $dept=$_POST['dept'];
    $base=$_POST['base'];
    $level=$_POST['level'];
    $person=$_POST['person'];
    $co_number= isset($_POST['co_number']) ? $_POST['co_number'] : '';
    $last=$_POST['last'];
    $first=$_POST['first'];
    $middle=$_POST['middle'];
    $brand=$_POST['brand'];
    $vehicle=$_POST['vehicle'];
    $others=$_POST['others'];
    $platenumber=$_POST['platenumber'];
    $ln=$_POST['ln'];
    $fn=$_POST['fn'];
    $mi=$_POST['mi'];
    $severity = isset($_POST['severity']) ? $_POST['severity'] : [];
    $other=$_POST['other'];
    $atd=$_POST['atd'];   
    $victim_ln=$_POST['victim_ln'];
    $victim_fn=$_POST['victim_fn'];
    $victim_mi=$_POST['victim_mi'];
    $victim_age=$_POST['victim_age'];
    $victim_gender=$_POST['victim_gender'];
    $victim_address=$_POST['victim_address'];
    $victim_status=$_POST['victim_status'];
    $victim_item=$_POST['victim_item'];
    $othervictims1=$_POST['othervictims1'];
    $othervictims2=$_POST['othervictims2'];
    $other_dispatch= $_POST['other_dispatch'];
    $victim_ln2=$_POST['victim_ln2'];
    $victim_fn2=$_POST['victim_fn2'];
    $victim_mi2=$_POST['victim_mi2'];
    $victim_age2=$_POST['victim_age2'];
    $victim_gender2=$_POST['victim_gender2'];
    $victim_address2=$_POST['victim_address2'];
    $victim_status2=$_POST['victim_status2'];
    $victim_item2=$_POST['victim_item2'];
    $leader_fullname=$_POST['leader_fullname'];
    $driver_fullname=$_POST['driver_fullname'];
    $nurse_fullname=$_POST['nurse_fullname'];
    $emt_fullname=$_POST['emt_fullname'];
    $selectedValues = [];

    $fileInput = saveUploadedFile('fileInput', '../Patient_care_report/', $fileInput);
    $fileInput2 = saveUploadedFile('fileInput2', '../Incident_Image/', $fileInput2);
    
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['id'])) {
        $idToUpdate = $_GET['id'];

        // Fetch existing values from the database for the fields that are not provided in the form
        $existingValues = getExistingValues($conn, $idToUpdate);

        // Merge existing values with the values from the form
        $fields = [
            // List all your fields here
            'response', 'departure', 'arrival', 'dept', 'base', 'level', 'person', 
            'co_number', 'last', 'first', 'middle', 'brand', 'vehicle', 'others', 
            'platenumber', 'ln', 'fn', 'mi', 'severity', 'other', 'atd', 'victim_ln', 
            'victim_fn', 'victim_mi', 'victim_age', 'victim_gender', 'victim_address', 
            'victim_status', 'victim_item', 'victim_ln2', 'victim_fn2', 'victim_mi2', 
            'victim_age2', 'victim_gender2', 'victim_address2', 'victim_status2', 
            'victim_item2', 'leader_fullname', 'driver_fullname', 'nurse_fullname', 'othervictims1', 'othervictims2', 'other_dispatch',
            'emt_fullname', 'fileInput', 'fileInput2'
        ];

        foreach ($fields as $field) {
            ${$field} = isset($_POST[$field]) && !empty($_POST[$field]) ? $_POST[$field] : $existingValues[$field];
        }

        $sql = "UPDATE incidents SET 
            response=?, departure=?, arrival=?, dept=?, base=?, level=?, person=?, 
            co_number=?, last=?, first=?, middle=?, brand=?, vehicle=?, others=?, 
            platenumber=?, ln=?, fn=?, mi=?, severity=?, other=?, atd=?, victim_ln=?, 
            victim_fn=?, victim_mi=?, victim_age=?, victim_gender=?, victim_address=?, 
            victim_status=?, victim_item=?, victim_ln2=?, victim_fn2=?, victim_mi2=?, 
            victim_age2=?, victim_gender2=?, victim_address2=?, victim_status2=?, 
            victim_item2=?, leader_fullname=?, driver_fullname=?, nurse_fullname=?, othervictims1=?, othervictims2=?,
            other_dispatch=?, emt_fullname=?, fileInput=?, fileInput2=? WHERE id=?";

        $stmt = $conn->prepare($sql);

        // Check if the number of parameters matches the expected number
        $expectedParams = count($fields) + 1; // Fields count + 1 for 'id'
        $paramValues = [];

        $fileInput = !empty(trim($_FILES["fileInput"]["name"])) ? basename($_FILES["fileInput"]["name"]) : $fileInput;
        $fileInput2 = !empty(trim($_FILES["fileInput2"]["name"])) ? basename($_FILES["fileInput2"]["name"]) : $fileInput2;
        

        foreach ($fields as $field) {
            $paramValues[] = &${$field};
        }
        
        $paramValues[] = &$idToUpdate;
        $paramTypes = str_repeat('s', $expectedParams - 1) . 'i'; // Assuming the last parameter is an integer (id)

        // Combine the data types with the actual parameters
        array_unshift($paramValues, $paramTypes);

        // Use the call_user_func_array to dynamically bind parameters
        call_user_func_array([$stmt, 'bind_param'], $paramValues);

        if ($stmt->execute()) {
            header("Location: incident-list.php");
            exit();
        } else {
            echo "Error updating record: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
}

function saveUploadedFile($inputName, $targetDirectory, $databaseValue = null) {
    // Check if the file input is empty or contains only whitespace characters
    if (empty(trim($_FILES[$inputName]['name']))) {
        return $databaseValue; // No file uploaded, return the value from the database
    }

    $targetFile = $targetDirectory . basename($_FILES[$inputName]['name']);

    if ($_FILES[$inputName]['error'] > 0) {
        // Handle file upload errors
        return null;
    } elseif (move_uploaded_file($_FILES[$inputName]['tmp_name'], $targetFile)) {
        return basename($_FILES[$inputName]['name']);
    } else {
        // Handle file upload errors
        return null;
    }
}



function getExistingValues($conn, $id)
{
    $sql = "SELECT * FROM incidents WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existingValues = $result->fetch_assoc();
    $stmt->close();

    return $existingValues;
}
?>