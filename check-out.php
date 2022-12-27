<!DOCTYPE html>
<html>
    <head>
        <meta charset='UTF-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='css/main.css'>

        <title>Hotel</title>
    </head>
    <body>
        <?php
            require_once('include/header.include.php')
        ?>

        <main class="pageMargin check-out">
            <img src="img/luxury.jpg" alt="">

            <table>
                <tbody class="text-Amaranth-Purplen">
                    <tr>
                        <th>Rum</th>
                        <td>Lyxury</td>
                    </tr>
                    <tr>
                        <th>Pris</th>
                        <td>500kr / natt</td>
                    </tr>
                    <tr>
                        <th>Antal nätter</th>
                        <td>4st</td>
                    </tr>
                    <tr>
                        <th>Rabatt</th>
                        <td>0kr</td>
                    </tr>
                </tbody>
                <tfoot class="text-Amaranth-Purplen">
                        <th>Summa</th>
                        <td>2 000kr</td>
                </tfoot>
            </table>

            <form>
                <div class="input-grope">
                    <label for="name">Namn</label>
                    <input type="text" class="text-Gunmetal" id="name" placeholder="Kinetic Kudu">
                </div>
                <div class="input-grope">
                    <label for="perNr">Person nr (API key)</label>
                    <input type="text" class="text-Gunmetal" id="perNr" placeholder="XXXXXXXX-XXXX-XXXX-XXXXXXXXXXXX">
                </div>
                <div class="input-grope">
                    <label for="discount">Rabatt</label>
                    <input type="text" class="text-Gunmetal" id="discount" placeholder="">
                </div>
                <button type="submit" class="btn bg-Amaranth-Purplen text-Snow">BOKA</button>
            </form>
        </main>

        <?php
            require_once('include/footer.include.php')
        ?>
        <script src="js/index.js"></script>
    </body>
</html>
