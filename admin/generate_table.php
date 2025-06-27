<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Incidents</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        /* Your existing styles */
    </style>
</head>
<body>

<form id="filterForm">
    <!-- Your form content -->
</form>

<div id="tableContainer">
    <!-- The generated table will be placed here -->
</div>

<script>
$(document).ready(function() {
    // Intercept form submission
    $("#filterForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Send an AJAX request
        $.ajax({
            type: "POST",
            url: "generate_table.php", // Path to your PHP file
            data: formData,
            success: function(response) {
                // Update the table container with the new table HTML
                $("#tableContainer").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });
});
</script>

</body>
</html>
