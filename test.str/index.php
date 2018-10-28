<?php
$servername = "localhost";
$username = "ztet";
$password = "@ztet990531@";
$dbname = "Univer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$kafedra = $_POST['kaf'];
$names = $_POST['nam'];
$levels = $_POST['lev'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php
/* echo filt_form(); */
    function filt_form(){
    echo '
    <form method="post" id="filt_form">
    Kafedra filt : <br>
    <select name="filt_kaf" id="filt_kaf">
        <option value=""></option>
        <option value="Жаратылыстану ғылымдары">Жаратылыстану ғылымдары</option>
        <option value="Жоғары математика және физика">Жоғары математика және физика	</option>
    </select><br><br>
    Filter : <br>
    <input type="text" name="filt" id=""><br><br>
    <input class="submit" id="actF" type="submit" value="Filtratsia" name = "actF"><br>
    <input class="submit" id="sbr" type="submit" value="Sbros" name = "sbr" >
    </form>';
    }
    function ad_form(){
    echo '
    <form method="post" id = "forr">
    Kafedra :<input type="text" name="kaf" class = "baz" id="kaf"><br>
    Name :<input type="text" name="nam" class = "baz" id="nam"><br>
    Level :<input type="text" name="lev" class = "baz" id="lev"><br>
    <input type="submit" id = "ButAct" value="Active" name = "dassh">
    </form>
    ';
    }
?>
    <div id="str">
        <div id="str0_0">
            <div id="str0_1">
                <h1>SAUALNAMA</h1>
                <p>Univer Test</p>
            </div>
            <div id ="str0_2">
                <ul id="nav">
                    <li id="nav_filt" onclick="filt_form()">fILTR</li>
                    <li id="nav_iz" onclick="">izmenit</li>
                    <li id="nav_da" onclick="ad_form()">Insert</li>
                    <li><button onclick = "filt_form()" style="height : 100%; width : 100%;">filtr</button></li>
                </ul>
                <button onclick = "filt_form()" style=" display : inline-block">filtr</button>
                <div id="filt">

                </div>
            </div>
        </div>
        <div id="str1_0">
            <?php
                $sql = "SELECT * FROM MatOrEkoM";
                if (isset($_POST['filt_kaf'])) {
                    $sql = "SELECT * FROM MatOrEkoM WHERE Kafedra='".$_POST[filt_kaf]."'";    
                }
                if (isset($_POST['filt'])) {
                    $sql = "SELECT * FROM MatOrEkoM WHERE Names='".$_POST[filt]."' OR Kafedra='".$_POST[filt_kaf]."'";    
                }
                if (isset($_POST['sbr'])) {
                    $sql = "SELECT * FROM MatOrEkoM";    
                }
                if (isset($_POST['dassh'])) {
                    $sql = "INSERT INTO MatOrEkoM(Kafedra,Names,Levels) VALUES ('".$kafedra."','".$names."','".$levels."')";
                }
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    echo "<table id='qw'><tr><th>ID</th><th>Кафедра</th><th>ФИО</th><th>Уривень</th><th>Отценко</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["id"]."</td>";
                        echo "<td>".$row["Kafedra"]."</td><td>".$row["Names"]."</td><td>".$row["Levels"]."</td><td>".$row["Bal"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }     
            ?>
        </div>
    </div>
</body>
</html>
<?php
$conn->close();  
?>