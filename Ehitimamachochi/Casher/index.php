<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier Page - Ehototmamachochi Hotel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Ensure sidebar links do not break lines */
        .sidebar .nav-link {
            white-space: nowrap;
        }

        /* Sidebar Styling */
        .sidebar {
            overflow-y: auto;
            /* Enable vertical scroll if content exceeds height */
            max-height: 100vh;
        }

        /* i dont like the horizontal scroll instead increase(++)the width of Sidebar at each level */
        /* Nested Items Indentation and Dynamic Width */
        .sidebar .collapse .nav-link {
            padding-left: 1px;
            /* First level */
        }

        .sidebar .collapse .collapse .nav-link {
            padding-left: 1px;
            /* Second level */
        }

        .sidebar .collapse .collapse .collapse .nav-link {
            padding-left: 1px;
            /* Third level */
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse show">
                <div class="position-sticky pt-3 text-white">
                    <!-- Profile Section -->
                    <div class="text-center mb-4">
                        <img src="image.png" alt="Profile Picture" class="rounded-circle" width="80" height="80">
                        <p class="text-white mt-2 mb-0 fw-bold">Casher Name</p>
                        <small class="text-muted">ID: 12345</small>
                    </div>

                    <!-- Navigation Menu with Collapsible Sections -->
                    <ul class="nav flex-column mt-4">
                        <!-- Home -->
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" href="index.php">Home</a>
                        </li>

                        <!-- Collapsible Reports Section -->
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" data-bs-toggle="collapse" href="#reportsCollapse"
                                role="button" aria-expanded="false" aria-controls="reportsCollapse">
                                Reports
                            </a>
                            <div class="collapse" id="reportsCollapse">
                                <ul class="nav flex-column ms-4 border-start border-secondary ps-2">
                                    <li><a class="nav-link text-white" href="#">Daily Report</a></li>
                                    <li><a class="nav-link text-white" href="#">Monthly Report</a></li>
                                    <li><a class="nav-link text-white" href="#">Annual Report</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Collapsible Account Settings Section -->
                        <li class="nav-item">
                            <a class="nav-link text-white fw-bold" data-bs-toggle="collapse" href="#settingsCollapse"
                                role="button" aria-expanded="false" aria-controls="settingsCollapse">
                                Settings
                            </a>
                            <div class="collapse" id="settingsCollapse">
                                <ul class="nav flex-column ms-4 border-start border-secondary ps-2">
                                    <!-- System Settings Submenu -->
                                    <li>
                                        <a class="nav-link text-white" data-bs-toggle="collapse" href="#systemSettings"
                                            role="button" aria-expanded="false" aria-controls="systemSettings">System
                                            Settings</a>
                                        <div class="collapse" id="systemSettings">
                                            <ul class="nav flex-column ms-4 border-start border-secondary ps-2">
                                                <li><a class="nav-link text-white" href="#">Change Background Color</a>
                                                </li>
                                                <li><a class="nav-link text-white" href="#">Change Font Style</a></li>
                                                <li><a class="nav-link text-white" href="#">Change Font Color</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <!-- Account Settings Submenu -->
                                    <li>
                                        <a class="nav-link text-white" data-bs-toggle="collapse" href="#accountSettings"
                                            role="button" aria-expanded="false" aria-controls="accountSettings">Account
                                            Settings</a>
                                        <div class="collapse" id="accountSettings">
                                            <ul class="nav flex-column ms-4 border-start border-secondary ps-2">
                                                <li><a class="nav-link text-white" href="#">Change Profile Picture</a>
                                                </li>
                                                <li><a class="nav-link text-white" href="#">Change Username</a></li>
                                                <li><a class="nav-link text-white" href="#">Change Password</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                }

                * {
                    box-sizing: border-box;
                }

                .container {
                    position: relative;
                    margin-top: 20px;
                }

                /* Hide the images by default */
                .mySlides {
                    display: none;
                    background-color: #ddd;
                    /* Gray background for slides */
                    height: 300px;
                }

                /* Add a pointer when hovering over the thumbnail boxes */
                .cursor {
                    cursor: pointer;
                }

                /* Next & previous buttons */
                .prev,
                .next {
                    cursor: pointer;
                    position: absolute;
                    top: 50%;
                    width: auto;
                    padding: 16px;
                    margin-top: -50px;
                    color: white;
                    font-weight: bold;
                    font-size: 20px;
                    border-radius: 0 3px 3px 0;
                    user-select: none;
                    -webkit-user-select: none;
                }

                .next {
                    right: 0;
                    border-radius: 3px 0 0 3px;
                }

                /* On hover, add a black background color */
                .prev:hover,
                .next:hover {
                    background-color: rgba(0, 0, 0, 0.8);
                }

                .numbertext {
                    color: #f2f2f2;
                    font-size: 12px;
                    padding: 8px 12px;
                    position: absolute;
                    top: 0;
                }

                .caption-container {
                    text-align: center;
                    background-color: #222;
                    padding: 2px 16px;
                    color: white;
                }

                /* Flex layout for thumbnails */
                .row {
                    display: flex;
                    justify-content: space-between;
                }

                .column {
                    width: 16.66%;
                    padding: 5px;
                }

                .demo {
                    opacity: 0.6;
                    width: 100%;
                    height: 80px;
                    background-color: #ddd;
                    /* Placeholder background color */
                }

                .active,
                .demo:hover {
                    opacity: 1;
                    background-color: #bbb;
                    /* Highlight color on hover */
                }

                .card {
                    width: 100%;
                    height: 100%;
                    background-color: #f4f4f4;
                    border: 2px solid #ddd;
                    text-align: center;
                    padding: 10px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 18px;
                    color: #555;
                    cursor: pointer;
                }

                .expanded {
                    transform: scale(1.1);
                    transition: transform 0.3s ease-in-out;
                    z-index: 10;
                    background-color: #fff;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                }
                *{
                margin: 0;
                }
            </style>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex flex-column min-vh-100">
                <section class="">
                    <h1 class="text-center">Activities</h1>
                        <!-- Slideshow for expanded cards -->
                        <div class="mySlides">
                            <div class="numbertext">1 / 6</div>
                            <div style="background-color: #ffadad; height: 300px;">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>18</td>
                                            <td>A</td>
                                            <td>Math</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>19</td>
                                            <td>B+</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Sam Brown</td>
                                            <td>17</td>
                                            <td>A-</td>
                                            <td>Science</td>
                                        </tr>
                                        <tr>
                                            <td>Amy White</td>
                                            <td>20</td>
                                            <td>B</td>
                                            <td>History</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">2 / 6</div>
                            <div style="background-color: #ffc3a0; height: 70%;">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>18</td>
                                            <td>A</td>
                                            <td>Math</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>19</td>
                                            <td>B+</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Sam Brown</td>
                                            <td>17</td>
                                            <td>A-</td>
                                            <td>Science</td>
                                        </tr>
                                        <tr>
                                            <td>Amy White</td>
                                            <td>20</td>
                                            <td>B</td>
                                            <td>History</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">3 / 6</div>
                            <div style="background-color: #ff677d; height: 300px;">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>18</td>
                                            <td>A</td>
                                            <td>Math</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>19</td>
                                            <td>B+</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Sam Brown</td>
                                            <td>17</td>
                                            <td>A-</td>
                                            <td>Science</td>
                                        </tr>
                                        <tr>
                                            <td>Amy White</td>
                                            <td>20</td>
                                            <td>B</td>
                                            <td>History</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">4 / 6</div>
                            <div style="background-color: #d4a5a5; height: 300px;">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>18</td>
                                            <td>A</td>
                                            <td>Math</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>19</td>
                                            <td>B+</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Sam Brown</td>
                                            <td>17</td>
                                            <td>A-</td>
                                            <td>Science</td>
                                        </tr>
                                        <tr>
                                            <td>Amy White</td>
                                            <td>20</td>
                                            <td>B</td>
                                            <td>History</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">5 / 6</div>
                            <div style="background-color: #392f5a; height: 300px;">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>John Doe</td>
                                            <td>18</td>
                                            <td>A</td>
                                            <td>Math</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith</td>
                                            <td>19</td>
                                            <td>B+</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>Sam Brown</td>
                                            <td>17</td>
                                            <td>A-</td>
                                            <td>Science</td>
                                        </tr>
                                        <tr>
                                            <td>Amy White</td>
                                            <td>20</td>
                                            <td>B</td>
                                            <td>History</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">6 / 6</div>
                            <div style="background-color: #5f4b8b; height: 300px;">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Name</th>
                                            <th>Age</th>
                                            <th>Grade</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>4et5 Doe</td>
                                            <td>1878</td>
                                            <td>A</td>
                                            <td>Math</td>
                                        </tr>
                                        <tr>
                                            <td>dfrtyu</td>
                                            <td>19</td>
                                            <td>B+</td>
                                            <td>English</td>
                                        </tr>
                                        <tr>
                                            <td>edrfgt Brown</td>
                                            <td>1789</td>
                                            <td>A-</td>
                                            <td>Science</td>
                                        </tr>
                                        <tr>
                                            <td>ty tgy</td>
                                            <td>280</td>
                                            <td>B</td>
                                            <td>History</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Next/Prev buttons for the slideshow -->
                        <a class="prev" onclick="plusSlides(-1)">❮</a>
                        <a class="next" onclick="plusSlides(1)">❯</a>

                        <div class="caption-container">
                            <p id="caption"></p>
                        </div>

                        <!-- Thumbnail boxes that trigger the slideshow -->
                        <div class="row">
                            <div class="column">
                                <div class="card" onclick="expandCard(this)">
                                    Box 1
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" onclick="expandCard(this)">
                                    Box 2
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" onclick="expandCard(this)">
                                    Box 3
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" onclick="expandCard(this)">
                                    Box 4
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" onclick="expandCard(this)">
                                    Box 5
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" onclick="expandCard(this)">
                                    Box 6
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <script>
                let slideIndex = 1;
                showSlides(slideIndex);

                function plusSlides(n) {
                    showSlides(slideIndex += n);
                }

                function currentSlide(n) {
                    showSlides(slideIndex = n);
                }

                function showSlides(n) {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("demo");
                    let captionText = document.getElementById("caption");
                    if (n > slides.length) { slideIndex = 1 }
                    if (n < 1) { slideIndex = slides.length }
                    for (i = 0; i < slides.length; i++) {
                        slides[i].style.display = "none";
                    }
                    for (i = 0; i < dots.length; i++) {
                        dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex - 1].style.display = "block";
                    dots[slideIndex - 1].className += " active";
                    captionText.innerHTML = "Box " + slideIndex; // Caption update
                }

                function expandCard(card) {
                    // If the clicked card is already expanded, collapse it
                    if (card.classList.contains('expanded')) {
                        card.classList.remove('expanded');
                    } else {
                        // Collapse all cards first
                        let cards = document.querySelectorAll('.card');
                        cards.forEach(function (c) {
                            c.classList.remove('expanded');
                        });

                        // Expand the clicked card
                        card.classList.add('expanded');
                        let cardIndex = Array.from(cards).indexOf(card);
                        currentSlide(cardIndex + 1); // Display corresponding slide
                    }
                }
            </script>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>