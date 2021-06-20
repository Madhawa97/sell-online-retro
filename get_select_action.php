<?php
// session_start();
require_once('cont/connection.php');
require_once('cont/header.php');
// ------------------------------------------------------------------------

$_SESSION["brand"] = $_POST["brand"];
$_SESSION["model"] = $_POST["model"];

$user_brand = $_SESSION["brand"];
$user_model = $_SESSION["model"];

$sql = "SELECT * FROM car_info JOIN car_owners ON car_member_id = member_id WHERE brand='$user_brand' AND model='$user_model' ";
$result = $conn->query($sql);

echo "<div class='card-container' >";
if ($result -> num_rows > 0) {
    while ($row = $result -> fetch_assoc()) {
        echo "<div class='card' >";
        echo "  <div class='card-image'>";
        echo "    <img src='". $row['image'] ."' alt='car_image'>";
        echo "  </div>";
        echo "  <div class='card-text'>";
        echo "      <span>" . $row['car_condition']. "</span>" ;
        echo "      <h2>" . $row['brand']. " " . $row['model']. "</h2>" ;
        echo "      <p>" . $row['description']. "</p>" ;
        echo "      <p> Owned by : " . $row['f_name']. " ". $row['l_name']. "</p>" ;
        echo "      <p>" . $row['email']. "</p>" ;
        echo "  </div>";
        echo "  <div class='card-stats'>";
        echo "      <p>Rs : " . $row['price']. "</p>" ;
        echo "  </div>";
        echo "</div>";
    }
} else {
    // echo "<div class=\"form\"><div class=\"title\">No cars listed.</div>";
    // echo "
    //     <form action=\"login_test.php\" method=\"GET\">
    //         <input class=\"submit ic1\" type=\"submit\" value=\"Login\">
    //     </form>";
    // echo "</div>";
    echo "<div class=\"form\"><div class=\"title\">No cars listed.</div>";
    echo "
        <form action=\"index.php\" method=\"GET\">
            <input class=\"submit ic1\" type=\"submit\" value=\"Search Again\">
        </form>";
    echo "</div>";
    // echo "Error getting car_info";
}
echo "</div>";

require_once('cont/footer.php');
$conn->close();
?>