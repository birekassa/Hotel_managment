<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shaff Page - Ehototmamachochi Hotel</title>
    <? include 'asset/bootstrap_links.php'; ?>
    <style>
        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        #defaultSection {
            display: block;
            /* Ensure the default section is visible by default */
        }
    </style>
</head>

<body style="font-family: 'Times New Roman', Times, serif;">

    <div class="d-flex flex-column min-vh-100">
        <? include 'asset/nav-bar.php'; ?>
        <section class="container mt-4">
            <div class="row g-5 justify-content-center">
                <h1 style="display:flex; justify-content:center;">Today's Activities</h1>

                <!-- Card 1 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header" style="background-color:green;color:white;">
                            Today's Outstoked Items for you
                        </div>
                        <div class="card-body">
                            <p>This is under construction.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header" style="background-color:#333;color:white;">
                            Today's Expenditure for you
                        </div>
                        <div class="card-body">
                            <p>This is under construction.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <? include 'asset/footer.php'; ?>
</body>

</html>