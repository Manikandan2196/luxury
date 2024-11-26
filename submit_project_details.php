<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *"); // Allow requests from any origin (replace * with a specific domain for security)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow specific headers
header("Access-Control-Allow-Credentials: true"); // Optional: Use if credentials like cookies or HTTP auth are involved

// Database connection settings
define('DB_HOST', 'localhost');
define('DB_NAME', 'luxurydb');
define('DB_USER', 'root'); // Change if needed
define('DB_PASSWORD', ''); // Change if needed

/**
 * Validate the input data.
 *
 * @param array $data Form data
 * @return array An array with validation results
 */
function validateProjectDetails($data, $files)
{
    $errors = [];

    // Validate text fields
    if (empty($data['builder_name'])) {
        $errors['builder_name'] = 'Builder Name is required.';
    }
    if (empty($data['project_name'])) {
        $errors['project_name'] = 'Project Name is required.';
    }
    if (empty($data['project_location'])) {
        $errors['project_location'] = 'Project Location is required.';
    }
    if (empty($data['project_address'])) {
        $errors['project_address'] = 'Project Address is required.';
    }
    if (empty($data['rera_number'])) {
        $errors['rera_number'] = 'RERA Number is required.';
    }
    if (empty($data['image_name'])) {
        $errors['image_name'] = 'Image Name is required.';
    }
    if (empty($data['alt_text'])) {
        $errors['alt_text'] = 'Alt Text is required.';
    }

    // Validate file upload
    if (isset($files['project_logo']) && $files['project_logo']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($files['project_logo']['type'], $allowedTypes)) {
            $errors['project_logo'] = 'Only JPG, PNG, or GIF files are allowed for the logo.';
        }
    } else {
        $errors['project_logo'] = 'Project Logo is required.';
    }

    return $errors;
}

/**
 * Save project details to the database
 *
 * @param array $data Form data
 * @param array $files Uploaded files
 * @return array Status and message
 */
function saveProjectDetails($data, $files)
{
    // Validate input
    $validationErrors = validateProjectDetails($data, $files);
    if (!empty($validationErrors)) {
        return ['status' => 'error', 'message' => 'Validation failed.', 'errors' => $validationErrors];
    }

    // Connect to the database
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        return ['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error];
    }

    // Extract data from POST
    $builderName = $conn->real_escape_string($data['builder_name']);
    $projectName = $conn->real_escape_string($data['project_name']);
    $projectLocation = $conn->real_escape_string($data['project_location']);
    $projectAddress = $conn->real_escape_string($data['project_address']);
    $reraNumber = $conn->real_escape_string($data['rera_number']);
    $imageName = $conn->real_escape_string($data['image_name']);
    $altText = $conn->real_escape_string($data['alt_text']);
    $projectLogo = '';

    // Handle file upload
    if (isset($files['project_logo']) && $files['project_logo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $projectLogo = $uploadDir . basename($files['project_logo']['name']);
        move_uploaded_file($files['project_logo']['tmp_name'], $projectLogo);
    }

    // Insert data into the database
    $stmt = $conn->prepare(
        "INSERT INTO project_details (builder_name, project_name, project_location, project_address, rera_number, project_logo, image_name, alt_text) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "ssssssss",
        $builderName,
        $projectName,
        $projectLocation,
        $projectAddress,
        $reraNumber,
        $projectLogo,
        $imageName,
        $altText
    );

    if ($stmt->execute()) {
        $response = ['status' => 'success', 'message' => 'Project details saved successfully.'];
    } else {
        $response = ['status' => 'error', 'message' => 'Failed to save project details: ' . $stmt->error];
    }

    $stmt->close();
    $conn->close();

    return $response;
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode(saveProjectDetails($_POST, $_FILES));
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
