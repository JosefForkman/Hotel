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
            <div>
                <img src="img/luxury.jpg" alt="">
                <table>
                    <tbody class="text-Amaranth-Purplen">
                        <tr>
                            <th>Rum</th>
                            <td>Lyxury</td>
                        </tr>
                        <tr>
                            <th>Pris</th>
                            <td>0kr / natt</td>
                        </tr>
                        <tr>
                            <th>Antal nätter</th>
                            <td>0st</td>
                        </tr>
                        <tr>
                            <th>Rabatt</th>
                            <td>0kr</td>
                        </tr>
                    </tbody>
                    <tfoot class="text-Amaranth-Purplen">
                            <th>Summa</th>
                            <td>0kr</td>
                    </tfoot>
                </table>
            </div>

            <form>
                <div class="input-grope">
                    <label for="name">Namn</label>
                    <input
                        type="text"
                        name="user_name"
                        class="text-Gunmetal"
                        id="name"
                        required
                        placeholder="Kinetic Kudu">
                </div>
                <div class="input-grope">
                    <label for="perNr">Person nr (API key)</label>
                    <input
                        type="text"
                        name="person_nr"
                        class="text-Gunmetal"
                        id="perNr"
                        required
                        pattern="^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$"
                        placeholder="XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX">
                </div>
                <div class="input-grope">
                    <label for="discount">Rabatt</label>
                    <input
                    type="text"
                    name="discount"
                    class="text-Gunmetal"
                    id="discount">
                </div>
                <button type="submit" class="btn bg-Amaranth-Purplen text-Snow">Boka</button>
            </form>

            <session class="Bekraftelse">
                <h2 class="text-Amaranth-Purplen">Bekräftelse info</h2>
<pre class="text-Gunmetal">
{
    "<span class="text-Amaranth-Purplen">island</span>": "<span id="island"></span>",
    "<span class="text-Amaranth-Purplen">hotel</span>": "<span id="hotel"></span>",
    "<span class="text-Amaranth-Purplen">arrival-date</span>": "<span id="arrival_date"></span>",
    "<span class="text-Amaranth-Purplen">departure-date</span>": "<span id="departure_date"></span>",
    "<span class="text-Amaranth-Purplen">total_cost</span>": "<span id="total_cost"></span>",
    "<span class="text-Amaranth-Purplen">stars</span>": "<span id="stars"></span>",
    "<span class="text-Amaranth-Purplen">features</span>": <span id="features">[]</span>,
    "<span class="text-Amaranth-Purplen">addtional_info</span>": <span id="info">[]</span>
}
</pre>
            </session>
        </main>

        <?php
            require_once('include/footer.include.php')
        ?>
        <script src="js/index.js"></script>
        <script src="js/check-out.js"></script>
    </body>
</html>
