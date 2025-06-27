<?php
include('config.php');

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign default values if keys are not set
    $Incident_ID = isset($_POST['Incident_ID']) ? $_POST['Incident_ID'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $source = isset($_POST['source']) ? $_POST['source'] : '';
    $caller_last_name = isset($_POST['caller_last_name']) ? $_POST['caller_last_name'] : '';
    $caller_first_name = isset($_POST['caller_first_name']) ? $_POST['caller_first_name'] : '';
    $caller_middle_initial = isset($_POST['caller_middle_initial']) ? $_POST['caller_middle_initial'] : '';
    $caller_address = isset($_POST['caller_address']) ? $_POST['caller_address'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $age = isset($_POST['age']) && is_numeric($_POST['age']) ? $_POST['age'] : null;
    $location = isset($_POST['location']) ? $_POST['location'] : '';
    $specific_location = isset($_POST['specific_location']) ? $_POST['specific_location'] : '';
    $additional_details = isset($_POST['additional_details']) ? $_POST['additional_details'] : '';
    $vehicle_type = isset($_POST['vehicle_type']) ? $_POST['vehicle_type'] : '';
    $number_affected = isset($_POST['number_affected']) && is_numeric($_POST['number_affected']) ? $_POST['number_affected'] : null;
    $action_taken_others = isset($_POST['action_taken_others']) ? $_POST['action_taken_others'] : '';
    $verified_by = isset($_POST['verified_by']) ? $_POST['verified_by'] : '';

    // Initialize an empty array to store selected checkbox values
    $selectedValues = [];

    // Loop through each checkbox and add its value to the array if it's checked
    $checkboxes = array(
        "Medical", "Trauma", "Extrication", "Cond-trans",
        "Stanby", "Pedestrian", "Missing-person", "Power-outage",
        "Self-accident", "Vehicular-accident", "Wound-care",
        "Crime", "Damaged-property", "Fire", "Telco-outage", "Flooding"
    );

    foreach ($checkboxes as $checkbox) {
        if (isset($_POST[$checkbox])) {
            $selectedValues[] = $checkbox;
        }
    }

    //If vehicle is involved
    $vehicle_involved = isset($_POST['vehicle_involved']) ? $_POST['vehicle_involved'] : '';

    //If individuals are involved
    $individuals_affected = isset($_POST['individuals_affected']) ? $_POST['individuals_affected'] : '';

    $action_taken = isset($_POST['action_taken']) ? $_POST['action_taken'] : '';

    // Combine the selected values into a single string, separated by commas
    $selectedValuesStr = implode(", ", $selectedValues);

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO incidents (Incident_ID, status, date, time, source, caller_last_name, caller_first_name, caller_middle_initial, caller_address, contact, age, location, specific_location, incident_type, additional_details, vehicle_involved, individuals_affected, vehicle_type, number_affected, verified_by, action_taken, action_taken_others) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("ssssssssssssssssssssss", $Incident_ID, $status, $date, $time, $source, $caller_last_name, $caller_first_name, $caller_middle_initial, $caller_address, $contact, $age, $location, $specific_location, $selectedValuesStr, $additional_details, $vehicle_involved, $individuals_affected, $vehicle_type, $number_affected, $verified_by, $action_taken, $action_taken_others);

    // Execute the statement
    if ($stmt->execute()) {
        // Insertion successful
        header("Location: incident-report.php"); // Redirect to the incident list page
        exit();
    } else {
        // Insertion failed
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
