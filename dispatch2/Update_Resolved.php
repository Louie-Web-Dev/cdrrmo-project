    <?php
    require_once "database.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the incident_id and new_status are set
        if (isset($_POST['incident_id'], $_POST['new_status'])) {
            // Sanitize and validate the input (you may need to do more security checks)
            $incidentId = $_POST['incident_id'];
            $newStatus = $_POST['new_status'];
            
            // Perform the status update in the database
            $updateStatusQuery = "UPDATE incidents SET status = '$newStatus' WHERE id = $incidentId";
            $resultUpdate = $conn->query($updateStatusQuery);

            if ($resultUpdate) {
                echo "Status updated successfully!";
            } else {
                echo "Error updating status: " . $conn->error;
            }
        } else {
            echo "Incident ID or new status not provided.";
        }
    } else {
        echo "Invalid request.";
    }
    ?>