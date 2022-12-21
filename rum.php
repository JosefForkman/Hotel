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
        <header>
            <div class="hamburger bg-Russian-Green" id="hamburgerOpen"></div>
            <nav>
                <ul>
                    <li><a class="text-Amaranth-Purplen" href="">Hem</a></li>
                    <li><a class="text-Amaranth-Purplen" href="">Spa</a></li>
                    <li><a class="text-Amaranth-Purplen" href="">Restaurang</a></li>
                    <li><a class="text-Amaranth-Purplen" href="">Om oss</a></li>
                    <li><a class="text-Amaranth-Purplen" href="">Kontakta</a></li>
                </ul>
            </nav>

            <button class="btn bg-Amaranth-Purplen text-Snow">Boka</button>

        </header>

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

        <footer>
            <div class="Öppetider">
                <h2 class="text-Amaranth-Purplen">Öppetider</h2>
                <ul>
                    <li class="text-Gunmetal">Mon Fre: 8.00 - 22.00</li>
                    <li class="text-Gunmetal">Lör Sön: 8.00 - 18.00</li>
                </ul>
            </div>

            <div class="Sosiala">
                <a href="#"><i class="fa-brands fa-square-facebook text-Amaranth-Purplen"></i></a>
                <a href="#"><i class="fa-brands fa-instagram text-Amaranth-Purplen"></i></a>
                <a href="#"><i class="fa-brands fa-square-twitter text-Amaranth-Purplen"></i></a>
                <a href="#"><i class="fa-brands fa-discord text-Amaranth-Purplen"></i></a>
            </div>

            <div class="Hotel">
                <h2 class="text-Amaranth-Purplen">Hotel</h2>
                <ul>
                    <li><a class="text-Gunmetal" href="tel:+46727008222">072-700 82 22</a></li>
                    <li><a class="text-Gunmetal" href="mailto:josfor0501@skola.goteborg.se">josfor0501@skola.goteborg.se</a></li>
                </ul>
            </div>
        </footer>
        <script src="js/index.js"></script>
        <script src="js/fullcalendar.js"></script>
    </body>
</html>
