<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Admin</title>
<style>
table tr th {
    border-bottom: 1px solid black;
    padding:1%;
    text-align:left;
}
table tr td {
  padding:1%;
}
.btn-primary {
  background-color:#1e90ff;
  padding:1%;
  color:white;
  text-decoration:none;
  font-weight:bold;
}
.btn-primary:hover{
  background-color:#3742fa;
}
.btn-secondary{
  background-color:#7bed9f;
  padding:1%;
  color:white;
  text-decoration:none;
  font-weight:bold;
}
.btn-secondary:hover{
  background-color:#2ed573;
}
.btn-danger{
  background-color:#ff6b81;
  padding:1%;
  color:white;
  text-decoration:none;
  font-weight:bold;
}
.btn-danger:hover{
background-color:#ff4757;
}
</style>

</head>
<body>

<?php include('partials/menu.php')?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
        <br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>
        <br>
        
        <table style="width: 100%;">
            <tr>
                <th>S.N</th>
                <th>Fullname</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td>1.</td>
                <td>Eros Mehmeti</td>
                <td>rosi</td>
                <td>
                <a href="#" class="btn-secondary">Update Admin</a>
                <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Eros Mehmeti</td>
                <td>rosi</td>
                <td>
                <a href="#" class="btn-secondary">Update Admin</a>
                <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Eros Mehmeti</td>
                <td>rosi</td>
                <td>
                <a href="#" class="btn-secondary">Update Admin</a>
                <a href="#" class="btn-danger">Delete Admin</a>
                </td>
            </tr>
        </table>
    </div>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php')?>

</body>
</html>
