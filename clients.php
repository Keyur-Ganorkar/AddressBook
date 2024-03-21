<?php
session_start();

// Initialize $alertMessage to an empty string
$alertMessage = '';

if(!isset($_SESSION['loggedInUser'])) {
    // Redirect to the login page if the user is not logged in
    header('Location: index2.php');
    exit(); // Terminate script execution after redirection
}

// Connect to the database
include('includes/connection_ab.php');

$query = "SELECT * FROM clients";
$result = mysqli_query($conn, $query);

// Check for query string
if(isset($_GET['alert'])) {
    // Check the value of 'alert' parameter in the query string
    switch($_GET['alert']) {
        case 'success':
            $alertMessage = "<div class='alert alert-success'>New client added! <a class='close' data-dismiss='alert'>&times;</a></div>";
            break;
        case 'updatesuccess':
            $alertMessage = "<div class='alert alert-success'>Client updated! <a class='close' data-dismiss='alert'>&times;</a></div>";
            break;
        case 'deleted':
            $alertMessage = "<div class='alert alert-success'>Client deleted! <a class='close' data-dismiss='alert'>&times;</a></div>";
            break;
        default:
            // Handle unknown 'alert' values if needed
            break;
    }
}
// close the mysql connection
mysqli_close($conn);

include('includes/header.php');
?>

<h1>Client Address Book</h1>

<?php echo $alertMessage; ?>

<table class="table table-striped table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Company</th>
        <th>Notes</th>
        <th>Edit</th>
    </tr>

    <?php
    if(mysqli_num_rows($result) > 0) {
        // Output client data
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td><td>".$row['address']."</td><td>".$row['notes']."</td>";
            echo '<td><a href="edit2.php?id='.$row['id'].'" type="button" class="btn btn-primary btn-sm">
            <span class="glyphicon glyphicon-edit"></span>
            </a></td>';
            echo "</tr>";
        }
    } else {
        // Display a message if no clients are found
        echo "<div class='alert alert-warning'>You have no clients</div>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <tr>
        <td colspan="7"><div class="text-center"><a href="add.php" type="button" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span> Add Client</a></div></td>
    </tr>
</table>

<?php include('includes/footer.php'); ?>
