<?php
$configFilePath = 'checkboxes_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newCheckboxes = $_POST['new_checkboxes'];

    // Validate and sanitize the input (you may need more robust validation)
    $newCheckboxes = json_decode($newCheckboxes, true);

    // Load the current configuration or use an empty array if the file is not found or doesn't return an array
    $currentCheckboxes = is_file($configFilePath) ? include $configFilePath : array();

    // Merge the new checkboxes with the current configuration
    $updatedCheckboxes = array_merge($currentCheckboxes, $newCheckboxes);

    // Save the updated configuration back to the file
    $configContent = '<?php return ' . var_export($updatedCheckboxes, true) . ';';
    file_put_contents($configFilePath, $configContent);

    echo 'Settings updated successfully!';
}

// Load the current configuration or use an empty array if the file is not found or doesn't return an array
$currentCheckboxes = is_file($configFilePath) ? include $configFilePath : array();
?>

<form method="post">
    <label for="new_checkboxes">Edit Checkboxes (JSON format):</label>
    <textarea name="new_checkboxes" rows="10" cols="30"><?= htmlspecialchars(json_encode($currentCheckboxes, JSON_PRETTY_PRINT)) ?></textarea>
    <br>
    <input type="submit" value="Update Settings">
</form>
