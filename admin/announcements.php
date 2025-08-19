<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>


<?php global $conn;
include 'header.php'; ?>
<?php include '../db.php'; ?>

<h3>Manage Announcements</h3>

<form method="post">
    <textarea name="message" placeholder="Enter announcement..." required></textarea>
    <button type="submit" name="add">Add</button>
</form>

<?php
if (isset($_POST['add'])) {
    $msg = $_POST['message'];
    $conn->query("INSERT INTO announcements (message) VALUES ('$msg')");
    echo "<p class='success'>Announcement added!</p>";
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM announcements WHERE id=$id");
    echo "<p class='error'>Announcement deleted!</p>";
}
?>

<table>
    <tr><th>ID</th><th>Message</th><th>Action</th></tr>
    <?php
    $result = $conn->query("SELECT * FROM announcements ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['message']}</td>
              <td><a href='announcements.php?delete={$row['id']}' onclick='return confirm(\"Delete?\")'>Delete</a></td>
            </tr>";
    }
    ?>
</table>

<?php include 'footer.php'; ?>
