<?php 
require_once('function/function.php');
check_session();
$pdo = getPDOObject();
$message = '';
if (isset($_REQUEST['del_id'])) {
    $delId = $_REQUEST['del_id'];
    $delQuery = "DELETE FROM candidate WHERE can_id=?";
    $stmt = $pdo->prepare($delQuery);
    $stmt->execute([$delId]);
    if ($stmt) {
        $message = '<div class="alert alert-danger">Record deleted successfully !</div>';
        header("location:list_employee.php");
    }
}
?>


?>
<!doctype html>
<html lang="en">

<?php require_once('includes/header_css.php');?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List EMployee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <?php require_once('includes/header.php');?>
        <div class="app-main">
            <?php require_once('includes/sidebar.php');?>

            <div class="app-main__outer">
                
                   <h4 align="center">List Employee</h4>
                
                 

                    <?php  echo $message; ?>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Creation Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT can_id,fname,lname,email,phone,created_on FROM `candidate` WHERE status='1' AND deleted='0'";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $cntRows = $stmt->rowCount();
                                $cnt = 1;
                                if ($cntRows) {
                                    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <tr>
                                            <td><?= $cnt++; ?></td>
                                            <td><?= $data['fname'] . " " . $data['lname']; ?></td>
                                            <td><?= $data['email']; ?></td>
                                            <td><?= $data['phone']; ?></td>
                                            <td><?= date('M d,Y h:m A', strtotime($data['created_on'] . '+ 90 days')); ?></td>
                                            
                                            <td>
                                                <i class="fa fa-eye"></i>&nbsp;/&nbsp;
                                                <a href="?del_id=<?= $data['can_id'] ?>"><i class="fa fa-trash"></i></a>&nbsp;/&nbsp;
                                                <a href="edit_employee.php?id=<?= $data['can_id'] ?>"><i class="fa fa-edit"></i></a>

                                            </td>
                                        </tr>

                                <?php
                                    }
                                } else {
                                    echo '<h4>NO record found</h4>';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                 <?php require_once('includes/footer.php');?>
            </div>
        </div>
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
    <script type="text/javascript" src="assets/scripts/main.cba69814a806ecc7945a.js"></script>
</body>

</html>