<?php
include("./php/conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $instagram = $_POST["instagram"];
    $firstword = $_POST["firstword"];
    $secondword = $_POST["secondword"];
    $thirdword = $_POST["thirdword"];
    $answer = $_POST["answer"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO answers (name, instagram, firstword, secondword, thirdword, answer, status)
            VALUES ('$name', '$instagram', '$firstword', '$secondword', '$thirdword', '$answer', '0')";

    if ($conn->query($sql) === TRUE) {
    echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />

        <link rel="stylesheet" href="./style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="mobile">

            <header>
                <img src="https://www.kriminalno-razsledvane.com/cdn/shop/files/4.png?v=1708963749&width=120" alt="">
            </header>
            <main>
            <div class="container">
                <h2 class="text-center">Случай: Арджиков</h2>
                <p class="text-center">
                   Състезанието приключи! <br>
                Благодарим за вашето участие. Очаквайте следващото след 2-3 месеца.
                </p>

                <p>
                    Код на случая (копирай): 19992001<br>

                    Провери своя отговор тук: <a href="https://imhustler.com/extras/answer/">линк</a><br>
                    Виж жокери тук: <a href="https://imhustler.com/extras/joker/">линк</a>
                </p>

                <div style="display:none;" class="phone-check"><br>
                    <h4 class="text-center">Верифицирай се</h4><br>
                    <div class="mb-3"><br>
                        <label for="" class="form-label">Телефон с който си направил поръчка</label><br>
                        <small>Можеш да дадеш отговор само веднъж! Помисли добре.</small>
                        <input
                            type="text"
                            name="phone"
                        
                            class="form-control phone_number"
                            placeholder="089"
                            aria-describedby="helpId"
                        />
                        <small class="text-muted">Имаш въпроси/проблем? Звънни тук: 0897858684</small>


                        <button class="check-button btn mt-3 btn-success w-100">Напред</button>
                </div>       
                
                
            </div>

                <table class="mt-3 table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Име</th>
                    <th scope="col">Час/Дата</th>
                    <th scope="col">Статус</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // SQL query to fetch data from the database
                            $sql = "SELECT id, name, inserttime, status FROM answers ORDER BY id DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    if($row['status'] === "0"){
                                        $status = "Обработва се";
                                        $style = "background:orange;";
                                    };
                                    if($row['status'] === "1"){
                                        $status = "Грешен";
                                        $style = "background:red;";
                                    };
                                    if($row['status'] === "2"){
                                        $status = "Правилен";
                                        $style = "background:green;";
                                    };
                                    $formattedInsertTime = date('H:i:s d/m/y', strtotime($row['inserttime'])); // Format timestamp

                                    echo '<tr>';
                                    echo '<th scope="row">' . $row['id'] . '</th>';
                                    echo '<td>' . $row['name'] . '</td>';
                                    echo '<td>' . $formattedInsertTime . '</td>';
                                    echo '<td style="'.$style.'">' . $status . '</td>';
                                    echo '</tr>';
                                }
                            } else {
                                echo 'Няма изпратени отговори все още. Успех!';
                            }

                            ?>
                </tbody>
                </table>

    
    
            </main>
        </div>

        <script src="./script.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
