<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sidebar and Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d4a44b;
            text-align: center;
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #ddd;
        }

        .sidebar a {
            color: #6c757d;
            text-decoration: none;
            display: block;
            padding: 10px 1rem;
            font-size: 1rem;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #f2f2f2;
            color: #000;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .search-box {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 0.3rem 1rem;
            width: 100%;
            max-width: 300px;
        }

        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar .profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 1050;
                width: 250px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1049;
            }

            .overlay.active {
                display: block;
            }
        }

        .custom-button {
            background-color: #B27E02;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px 0;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: #946B02;
        }

        .menu-content {
            display: none;
        }

        .active-content {
            display: block;
        }

        .banner-buttons {
            margin-top: 20px;
            display: flex;
            gap: 10px; /* Space between buttons */
            flex-wrap: wrap; /* Ensures buttons wrap if screen is too small */
            justify-content: flex-start; /* Align items to the left */
        }

        .banner-buttons .custom-button {
            flex: 1; /* Buttons take equal width */
            max-width: 200px; /* Limit button width */
        }

        .project-details-container {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .project-heading {
            font-size: 1.5rem;
            margin-bottom: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <div class="logo">LUXURY<br>PROPERTY SERVICES</div>
        
        <!-- Media Menu -->
        <a href="#" class="menu-link active">Media</a>

        <!-- Landing Pages Menu -->
        <div>
            <a href="#landingPagesMenu" data-bs-toggle="collapse" class="menu-link">Landing Pages</a>
            <div id="landingPagesMenu" class="collapse">
                <a href="#" id="bannerMenuLink" class="menu-link ps-4">Banner</a>
                <a href="#" id="projectDetailsLink" class="menu-link ps-4">Project Details</a>
            </div>
        </div>

        <div class="mt-auto text-center">
            <div class="profile">
                <img src="https://via.placeholder.com/35" alt="User">
                <span>Super Admin</span>
            </div>
        </div>
    </nav>

    <!-- Overlay for mobile view -->
    <div class="overlay"></div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg px-3">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary d-lg-none" id="toggleSidebar">☰</button>
                <form class="d-flex ms-auto">
                    <input type="text" class="search-box" placeholder="Search">
                </form>
                <div class="profile ms-3">
                    <img src="https://via.placeholder.com/35" alt="User">
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="p-4">
            <!-- Banner Content -->
            <div id="bannerContent" class="menu-content">
                <div class="project-heading">Banner</div>
                <div class="banner-buttons">
                    <button class="custom-button" id="addDesktopBannerBtn">Desktop Banner</button>
                    <button class="custom-button" id="mobileBannerBtn">Mobile Banner</button>
                </div>
            </div>

            <!-- Project Details Content -->
            <div id="projectDetailsContent" class="menu-content">
                <div class="project-heading">Add Project Details</div>
                <div class="project-details-container">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="builderName" class="form-label">Builder Name</label>
                                    <input type="text" class="form-control" id="builderName" placeholder="Enter builder name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="projectName" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" id="projectName" placeholder="Enter project name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="projectLocation" class="form-label">Project Location</label>
                                    <input type="text" class="form-control" id="projectLocation" placeholder="Enter location">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="projectAddress" class="form-label">Project Address</label>
                                    <input type="text" class="form-control" id="projectAddress" placeholder="Enter address">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="reraNumber" class="form-label">RERA Number</label>
                                    <input type="text" class="form-control" id="reraNumber" placeholder="Enter RERA number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="projectLogo" class="form-label">Logo</label>
                                    <input type="file" class="form-control" id="projectLogo">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="imageName" class="form-label">Image Name</label>
                            <input type="text" class="form-control" id="imageName" placeholder="Enter image name">
                        </div>
                        <div class="mb-3">
                            <label for="altText" class="form-label">Alt Text</label>
                            <input type="text" class="form-control" id="altText" placeholder="Enter alt text">
                        </div>
                        <div class="submit-btn-container">
                            <button class="custom-button" id="submitProjectDetailsBtn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add this Modal HTML below your existing content -->
<div class="modal fade" id="desktopBannerModal" tabindex="-1" aria-labelledby="addDesktopBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDesktopBannerModalLabel">Add Desktop Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addDesktopBannerForm">
                    <div class="mb-3">
                        <label for="bannerFileName" class="form-label">File Name</label>
                        <input type="text" class="form-control" id="bannerFileName" placeholder="Enter file name">
                    </div>
                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">Upload Image</label>
                        <input type="file" class="form-control" id="bannerImage" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="projectDropdown" class="form-label">Project Name</label>
                        <select class="form-select" id="projectDropdown">
                            <option value="" disabled selected>Select a project</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bannerAltText" class="form-label">Alternative Text</label>
                        <input type="text" class="form-control" id="bannerAltText" placeholder="Enter alternative text">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBannerBtn">Save</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".menu-link").on("click", function() {
            $(".menu-content").removeClass("active-content");
            if (this.id === "bannerMenuLink") {
                $("#bannerContent").addClass("active-content");
            } else if (this.id === "projectDetailsLink") {
                $("#projectDetailsContent").addClass("active-content");
            }
        });

        $("#toggleSidebar").on("click", function() {
            $(".sidebar").toggleClass("active");
            $(".overlay").toggleClass("active");
        });

        $(".overlay").on("click", function() {
            $(".sidebar").removeClass("active");
            $(this).removeClass("active");
        });

        // Desktop and Mobile Banner button actions
        $("#desktopBannerBtn").on("click", function() {
            alert("Desktop Banner button clicked!");
        });

        $("#mobileBannerBtn").on("click", function() {
            alert("Mobile Banner button clicked!");
        });

    $("#submitProjectDetailsBtn").on("click", function (e) {
    e.preventDefault();

    // Client-side validation
    let errors = [];
    const builderName = $("#builderName").val().trim();
    const projectName = $("#projectName").val().trim();
    const projectLocation = $("#projectLocation").val().trim();
    const projectAddress = $("#projectAddress").val().trim();
    const reraNumber = $("#reraNumber").val().trim();
    const imageName = $("#imageName").val().trim();
    const altText = $("#altText").val().trim();
    const logoInput = $("#projectLogo")[0].files[0];

    if (!builderName) errors.push("Builder Name is required.");
    if (!projectName) errors.push("Project Name is required.");
    if (!projectLocation) errors.push("Project Location is required.");
    if (!projectAddress) errors.push("Project Address is required.");
    if (!reraNumber) errors.push("RERA Number is required.");
    if (!imageName) errors.push("Image Name is required.");
    if (!altText) errors.push("Alt Text is required.");
    if (!logoInput) {
        errors.push("Project Logo is required.");
    } else if (!["image/jpeg", "image/png", "image/gif"].includes(logoInput.type)) {
        errors.push("Invalid logo file format. Only JPG, PNG, or GIF allowed.");
    }

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return;
    }

    // Prepare form data
    const formData = new FormData();
    formData.append("builder_name", builderName);
    formData.append("project_name", projectName);
    formData.append("project_location", projectLocation);
    formData.append("project_address", projectAddress);
    formData.append("rera_number", reraNumber);
    formData.append("image_name", imageName);
    formData.append("alt_text", altText);
    formData.append("project_logo", logoInput);

    
    // AJAX request
    $.ajax({
        url: "submit_project_details.php",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === "success") {
                alert(response.message);
                $("form")[0].reset();
            } else {
                const serverErrors = response.errors ? Object.values(response.errors).join("\n") : response.message;
                alert("Error: " + serverErrors);
            }
        },
        error: function () {
            alert("An error occurred while submitting the form.");
        }
    });
});
});


$(document).ready(function () {
    $("#addDesktopBannerBtn").on("click", function () {
        // Open modal (assumes modal has id #desktopBannerModal)
        $("#desktopBannerModal").modal("show");
    });

    $("#submitDesktopBanner").on("click", function (e) {
        e.preventDefault();

        // Client-side validation
        let errors = [];
        const fileName = $("#desktopBannerFileName").val().trim();
        const projectId = $("#desktopBannerProject").val().trim();
        const altText = $("#desktopBannerAltText").val().trim();
        const bannerImage = $("#desktopBannerImage")[0].files[0];

        if (!fileName) errors.push("File Name is required.");
        if (!projectId) errors.push("Project is required.");
        if (!altText) errors.push("Alt Text is required.");
        if (!bannerImage) {
            errors.push("Banner Image is required.");
        } else if (!["image/jpeg", "image/png", "image/gif"].includes(bannerImage.type)) {
            errors.push("Invalid image format. Only JPG, PNG, or GIF allowed.");
        }

        if (errors.length > 0) {
            alert(errors.join("\n"));
            return;
        }

        // Prepare form data
        const formData = new FormData();
        formData.append("file_name", fileName);
        formData.append("project_id", projectId);
        formData.append("alt_text", altText);
        formData.append("banner_image", bannerImage);

        // AJAX request
        $.ajax({
            url: "submit_banner.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status === "success") {
                    alert(response.message);
                    $("#desktopBannerForm")[0].reset(); // Reset the form
                    $("#desktopBannerModal").modal("hide"); // Close the modal
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function () {
                alert("An error occurred while submitting the banner.");
            },
        });
    });
});


</script>

</body>
</html>
