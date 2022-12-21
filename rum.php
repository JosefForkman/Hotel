<!DOCTYPE html>
<html lang="SE">
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='css/main.css'>

        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.0.0/index.global.min.js"></script>
        <script>



    </script>

        <title>Hotel</title>
    </head>
    <body>
        <?php
            require_once('include/header.include.php')
        ?>

        <main class="pageMargin rum">
            <section class="introduktion">
                <a class="text-Russian-Green" href="boende.php"><i class="fa-solid fa-angle-left"></i> Leta vidare</a>
                <img src="img/luxury.jpg" alt="">
                <h2>Två rum <span>luxury</span></h2>
                <p>Lorem ipsum dolor sit amet consectetur. Laoreet ac diam sit sit pharetra volutpat. Erat a tincidunt vitae at molestie elit ut. Duis dolor vel id amet volutpat orci ultricies etiam ultrices. Sollicitudin neque sapien eget sodales luctus maecenas feugiat. Arcu nisl lorem pharetra auctor. Sit nibh aliquet a amet netus. Etiam neque mi eu ultricies.</p>
            </section>

            <section>
                <div style="font-size: 13px;" id="calendar"></div>
            </section>

            <div class="boka bg-Russian-Green">
                <h2 class="text-Snow">500kr / natt</h2>
                <p class="text-Snow">1 Jan - 5 Jan</p>
                <button class="btn bg-Amaranth-Purplen text-Snow">Boka</button>
            </div>
        </main>

        <?php
            require_once('include/footer.include.php')
        ?>
        <script src="js/index.js"></script>
        <script src="js/fullcalendar.js"></script>
    </body>
</html>
