<?php
global $conn;
include '../config/db.php';

$ip = $_SERVER['REMOTE_ADDR'];
$today = date("Y-m-d");

$sql = "SELECT * FROM visitor_log WHERE ip_address='$ip' AND visit_date='$today'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    $conn->query("INSERT INTO visitor_log (ip_address, visit_date) VALUES ('$ip', '$today')");
    $conn->query("UPDATE visitor_counter SET visits = visits + 1 WHERE id = 1");
}

$res = $conn->query("SELECT visits FROM visitor_counter WHERE id = 1");
$row = $res->fetch_assoc();
$visits = str_pad($row['visits'], 4, "0", STR_PAD_LEFT); // pad with zeros

// split into spans
for ($i = 0; $i < strlen($visits); $i++) {
    echo "<span>" . $visits[$i] . "</span>";
}
?>
