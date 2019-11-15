<h1>Running query on PHP</h1>

<form action="http://localhost:8888/lab7/sql.php" method="get">
    데이터베이스 이름: <br><input type="text" name="dbname"> <br><br>
    sql 쿼리문: <br><textarea name="sql" cols="30" rows="10"></textarea> <br>
    <input type="submit" value="제출">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $port = 8888;
    $dbname = $_GET["dbname"];
    try{
        $db = new PDO("mysql:host=$servername; dbname=$dbname; port=$port", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $_GET["sql"];
        $rows = $db->query($sql);
        foreach ($rows->fetchAll() as $row) {
        ?>
        <ul> 
            <li>
                <?php for($i=0;$i<$rows->columnCount();$i++) { ?>
                    <?= $row[$i] ?> | 
                <?php } ?>
            </li> 
        </ul>
        <?php 
            }
    } catch(Exception $e){
        echo "에러: " . $e->getMessage();
        exit;
    }
}
?>

