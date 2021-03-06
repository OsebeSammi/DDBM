<?php
/**
 * Created by IntelliJ IDEA.
 * User: sammi
 * Date: 3/29/15
 * Time: 11:54 AM
 */
//enabling CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type');

$servername = "localhost";
$username = "root";
$password = "sam";
$dbName = "malnutrition";

// Create connection postgre
$conn = pg_connect("host=localhost dbname=malnutrition user=postgres");



// Check connection
/*if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
    echo "FAILED";
    exit;
}*/

if(isset($_POST['sql']))
{
    //$sql = $_POST['sql'];

    $result = pg_query($conn, "SELECT * FROM child") or die("Cannot execute query: $sql\n");

    //if ($result->num_rows > 0)
    {
        // output data of each row
        $row = pg_fetch_assoc($result);

        echo "<table>";
        echo "<thead><tr>";
        foreach($row as $key => $r)
        {
            echo "<td><strong>".$key."</strong></td>";
        }
        echo "</tr></thead>";

        echo "<tr>";
        foreach($row as $key => $r)
        {
            echo "<td>".$r."</td>";
        }
        echo "</tr>";

        while($row = pg_fetch_assoc($result))
        {
            echo "<tr>";
                foreach($row as $key => $r)
                {
                    echo "<td>".$r."</td>";
                }
            echo "</tr>";
        }

        echo "</table>";
    }
}
else
{
    echo "NO QUERY!!";
}

pg_close($conn);