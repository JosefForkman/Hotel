<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/a913f4ac89.js" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='css/main.css'>
    <link rel='stylesheet' href='css/logbook.css'>
    <title>Hotel</title>
</head>

<body>
    <?php
    require_once('include/header.include.php');
    require_once('./checkDb.php');
    ?>

    <main class="pageMargin">

        <div class="vacation-title">
            <h2>My vacation:</h2>
        </div>
        <div class="card-wrapper">
        </div>
        <div class="card">
            <h4 class="revenue"> Total hotel revenue: $<?= countTotalCost(getReservations()); ?></h4>
            <h4 class="revenue"> Revenue per booking: $<?= bookingRevenue(getReservations()); ?></h4>
        </div>

    </main>

    <?php
    require_once('include/footer.include.php')
    ?>
    <script src="js/index.js"></script>
    <script src="js/logbook.js"></script>
</body>

</html>
