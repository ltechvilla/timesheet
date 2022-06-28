<?php
require_once('function/function.php');
check_session();
$pdo = getPDOObject();
$valid_ext = array("jpg", "jpeg", "png", "gif");
$validSize = 2 * 1024 * 1024;
if (isset($_POST['add_emp'])) 
{
    extract($_POST);
    $fileName = '';

    $skill_str = implode(",", $_POST['skills']);

   // $qual_str = implode(",", $_POST['qualification']);

    // echo $skill_str;
    // echo $qual_str;
    // die();

    //$password = "";

    //$npassword = password_hash($password, PASSWORD_BCRYPT);
    //$newPass = "";

    if (isset($_FILES['images']['name'])) 
    {
        $fileName = $_FILES["images"]["name"];
        $fileSize = $_FILES['images']['size'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $target_path = "uploads/" . $fileName;
        if (!in_array($fileExt, $valid_ext))
        {
            die("Invalid file");
        }
        if ($fileSize > $validSize)
        {
            die("Now allowed file size greater than 2*1024*1024");
        } else 
        {
            if (!move_uploaded_file($_FILES['images']['tmp_name'], $target_path)) 
            {
                die("Error in file upload");
            }
        }

    }

 $sql = "INSERT INTO candidate(
        fname,
        lname,
        email,
        phone,
        password,
        country,
        state,
        city,
        zip,
        address,
        landmark,
        position,
        dob,
        doj,
        highest_qual,
        skills,
        image,
        gender
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $fname,
        $lname,
        $email,
        $phone,
        $password,
        $country,
        $state,
        $city,
        $pin,
        $address,
        $landmark,
        $position,
        $dob,
        $doj,
        $qualification,
        $skill_str,
        $fileName,
        $gender]);
    if ($stmt) 
    {
        //  $msg = "Record inserted successfull";
        header('location:list_employee.php');
    } else
    {
        $msg = "Something went wrong";
    }
    die;

}
?>
<!doctype html>
<html lang="en">

<?php require_once('includes/header_css.php'); ?>

<head>
    <title>Add-employee</title>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar">
        <?php require_once('includes/header.php'); ?>
        <div class="app-main">
            <?php require_once('includes/sidebar.php'); ?>

            <div class="app-main__outer">
                <div class="app-main__inner">
                    <div><h4 align = "center">Add Employee</h4></div>
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data">
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="fname" class="form-label">First Name:</label>
                                                        <input type="text" name="fname" class="form-control" placeholder="Enter the first name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="lname" class="form-label">Last Name:</label>
                                                        <input type="text" name="lname" class="form-control" placeholder="Enter the last name">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Enter the name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="phone" class="form-label">Phone:</label>
                                                        <input type="text" name="phone" class="form-control" placeholder="Enter the phone no.">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="password" class="form-label">Password:</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Enter the password">
                                                    </div>
                                                    <div class="col">
                                                        <label for="country" class="form-label">Country:</label>
                                                        <select name="country" id="country" class="form-control">
                                                            <option value="" >Select Country</option>
                                                            <?php 
                                                             $contSql = $pdo->prepare("SELECT * FROM `countries`");
                                                             $contSql->execute();
                                                             $counData = $contSql->fetchAll(PDO::FETCH_ASSOC);
                                                             foreach($counData as $val)
                                                             { 
                                                               echo '<option value="'.$val['id'].'">'.$val['name'].'</option>';
                                                               
                                                             }
                                                            
                                                            ?>
                                                        </select>
                                                    </div>
                                                   
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="state" class="form-label">State:</label>
                                                        <select name="state" id="states" class="form-control">
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="city" class="form-label">City:</label>
                                                        <select name="city" id="city" class="form-control">
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="pin" class="form-label">PIN:</label>
                                                        <input type="text" name="pin" class="form-control" placeholder="enter the name">
                                                    </div>
                                                    <div class="col">
                                                        <label for="address" class="form-label">Address:</label>
                                                        <input type="text" name="address" class="form-control" placeholder="Enter address">
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="landmark" class="form-label">Landmark:</label>
                                                        <input type="text" name="landmark" class="form-control" placeholder="enter landmark">
                                                    </div>
                                                    <div class="col">
                                                        <label for="position" class="form-label">Position:</label>&nbsp;&nbsp;
                                                        <select name="position" class="form-control">
                                                            <option value="">--Please Select--</option>
                                                            <option value="fresher">Fresher</option>
                                                            <option value="junior developer">Junior Developer</option>
                                                            <option value="senior developer">Senior Developer</option>
                                                            <option value="team leader">Team Leader</option>
                                                            <option value="manager">Manager</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="dob" class="form-label">DOB:</label>
                                                        <input type="date" name="dob" class="form-control" placeholder="Enter DOB" min="1990-05-11" max="2022-06-23">
                                                    </div>
                                                    <div class="col">
                                                        <label for="doj" class="form-label">DOJ:</label>
                                                        <input type="date" name="doj" class="form-control" placeholder="Enter DOj" min="1990-05-11" max="2022-06-23">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <br>
                                                        <label for="qualification" name="qualification" class="form-label">Highest Qualification: </label>&nbsp;&nbsp;<br>
                                                        <select name="qualification" class="form-control">
                                                            <option value="">--Please Select--</option>
                                                            <option value="BCA">BCA</option>
                                                            <option value="MCA">MCA</option>
                                                            <option value="B.TECH">B.TECH</option>
                                                            <option value="M.TECH">M.TECH</option>
                                                            <option value="PHD">PHD</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="skills" class="form-label mt-4" name="skills">Skills:</label>&nbsp;&nbsp;<br>
                                                        <input name="skills[]" type="checkbox" value="js">JS &nbsp;&nbsp;
                                                        <input name="skills[]" type="checkbox" value="html">HTML &nbsp;&nbsp;
                                                        <input name="skills[]" type="checkbox" value="c">C &nbsp;&nbsp;
                                                        <input name="skills[]" type="checkbox" value="reactjs">ReactJs &nbsp;&nbsp;
                                                        <input name="skills[]" type="checkbox" value="Php">Php
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="images" class="form-label">Select image:</label>
                                                        <input type="file" class="form-control" name="images" placeholder="choose the file">
                                                    </div>
                                                    <div class="col">
                                                        <label for="gender" class="form-label mt-3">Gender:</label><br>
                                                        <input type="radio" name="gender" value="M"> &nbsp; Male &nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="gender" value="F"> &nbsp; Female &nbsp;&nbsp;&nbsp;
                                                        <input type="radio" name="gender" value="T"> &nbsp; Other 
                                                    </div>
                                                </div><br>
                                                <div class="row mt-3 text-center">
                                                    <div class="col">
                                                       <button type="submit" name="add_emp" class="btn btn-primary rounded-pill btn-lg px-5 ">Submit</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/scripts/main.cba69814a806ecc7945a.js"></script>

</body>

</html>
<script src="assets/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        /** Get State on Country Change  */
        $("#country").change(function(){
            cid = $(this).val();
            if(cid)
            {
                $.ajax({
                    method : 'post',
                    url: 'http://localhost/tms/ajax/ajax.php',
                    data : { 'action':'getState','countID':cid },
                    success : function(resp){
                     // alert(resp);
                     $("#states").html(resp);
                    }
                });

            }else{
                alert("Please select country");
            }
        });

         /** Get City on State Change  */

         $("#states").change(function(){
            sid = $(this).val();
            if(sid)
            {
                $.ajax({
                    method : 'post',
                   // async:false,
                    url: 'http://localhost/tms/ajax/ajax.php',
                    data : { 'action':'getCity','stateID':sid },
                    success : function(resp){
                     // alert(resp);
                     $("#city").html(resp);
                    }
                });

            }else{
                alert("Please select state");
            }
        });
    });
</script>