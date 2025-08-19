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

<h3>Manage Downloads</h3>

<!-- Add new -->
<form method="post">
    <input type="text" name="title" placeholder="Download Title" required>
    <input type="text" name="url" placeholder="File URL" required>
    <button type="submit" name="add">Add</button>
</form>



<?php
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $url = $_POST['url'];
    $conn->query("INSERT INTO downloads (title, url) VALUES ('$title', '$url')");
    echo "<p class='success'>Download added!</p>";
}
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM downloads WHERE id=$id");
    echo "<p class='error'>Download deleted!</p>";
}
?>

<!-- List -->
<table>
    <tr><th>ID</th><th>Title</th><th>URL</th><th>Action</th></tr>
    <?php
    $result = $conn->query("SELECT * FROM downloads ORDER BY id DESC");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['title']}</td>
              <td><a href='{$row['url']}' target='_blank'>View</a></td>
              <td><a href='downloads.php?delete={$row['id']}' onclick='return confirm(\"Delete?\")'>Delete</a></td>
            </tr>";
    }
    ?>
</table>

<?php include 'footer.php'; ?>
