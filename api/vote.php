<?php
session_start();
include('connect.php');
    $votes = $_POST['gvotes'];
    $total_votes = $votes + 1;
    $gid=$_POST['gid'];
    $uid = $_SESSION['userdata']['id'];

    // Update votes for the user
    $update_votes = mysqli_query($connect, "UPDATE user SET votes = '$total_votes' WHERE id = '$gid'");

    // Update user status
    $update_user_status = mysqli_query($connect, "UPDATE user SET status = 1 WHERE id = '$uid'");

    if($update_votes and $update_user_status) {
        // Fetch groups data
        $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
        
        // Update session data
        $_SESSION['userdata']['status'] = 1;
        $_SESSION['groupsdata'] = $groupsdata;
        echo '
          <script>
          alert("Voting Successful");
          window.location="../routes/dashboard.php"
          </script>
        ';
} else {
    echo '
    <script>
    alert("Invalid request!");
    window.location = "../routes/dashboard.php";
    </script>';
    exit();
}
?>
