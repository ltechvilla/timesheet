<?php
require_once('function/function.php');
check_session();
$pdo = getPDOObject();
$skill_str="";
$skill_arr = '';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // echo $id; die();
    if (!is_numeric($id)) {
        header("location:list_employee.php");
    }

    $sql = "SELECT * FROM candidate WHERE can_id=? LIMIT 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    // echo $stmt; die();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    echo"<pre>";
    foreach($data as $val)
    echo $data."=".$val;
    echo"</pre>";
    die("this is the");


    $rowCnt = $stmt->rowCount();

    if (!$rowCnt) {
        header("location:list_employee.php");
    }

    $skill = $data['skills'];
    if(!empty($skill)){
        $skill_arr = explode(',', $skill);
    }

}


//update query 

if (isset($_POST['update'])) {
    $date = date("Y-m-d h:i:sa");
    extract($_POST);

    $skill_str = implode(",", $_POST['skills']);

 $sql = "UPDATE candidate set
        fname=?,
        lname=?,
        email=?,
        phone=?,
        password=?,
        country=?,
        state=?,
        city=?,
        zip=?,
        address=?,
        landmark=?,
        position=?,
        dob=?,
        doj=?,
        highest_qual=?,
        skills=?,
        image=?,
        gender=? where can_id=?";
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
        $qulification,
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
                    <div><h4 align = "center">Edit Employee</h4></div>
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
                                                        <input type="text" name="fname" class="form-control" placeholder="Enter the first name" value="<?= $data['fname']; ?>" >
                                                    </div>
                                                    <div class="col">
                                                        <label for="lname" class="form-label">Last Name:</label>
                                                        <input type="text" name="lname" class="form-control" placeholder="Enter the last name" value="<?= $data['lname']; ?>" >
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="email" class="form-label">Email:</label>
                                                        <input type="email" name="email" class="form-control" placeholder="Enter the name" value="<?= $data['email']; ?>" >
                                                    </div>
                                                    <div class="col">
                                                        <label for="phone" class="form-label">Phone:</label>
                                                        <input type="text" name="phone" class="form-control" placeholder="Enter the phone no." value="<?= $data['phone']; ?>" >
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="password" class="form-label">Password:</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Enter the password" value="<?= $data['password']; ?>" >
                                                    </div>
                                                    <div class="col">
                                                        <label for="country" class="form-label">Country:</label>
                                                        <select name="country" id="country" class="form-control">
                                                            <option value="<?= $data['country']; ?>" >Select Country</option>
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
                                                        <select name="state" id="states" class="form-control" value="<?= $data['state']; ?>" >
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="city" class="form-label">City:</label>
                                                        <select name="city" id="city" class="form-control" value="<?= $data['city']; ?>" >
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="pin" class="form-label">PIN:</label>
                                                        <input type="text" name="pin" class="form-control" placeholder="enter the name" value="<?= $data['zip']; ?>" >
                                                    </div>
                                                    <div class="col">
                                                        <label for="address" class="form-label">Address:</label>
                                                        <input type="text" name="address" class="form-control" placeholder="Enter address" value="<?= $data['address']; ?>" >
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="landmark" class="form-label">Landmark:</label>
                                                        <input type="text" name="landmark" class="form-control" placeholder="enter landmark"value="<?= $data['landmark']; ?>" >
                                                    </div>
                                                    <div class="col">
                                                        <label for="position" class="form-label">Position:</label>&nbsp;&nbsp;
                                                        <select name="position" class="form-control">
                                                            <option value="">--Please Select--</option>
                                                            <option value="fresher" <?php if ($data["position"] == "fresher") 
                                                                                            {
                                                                                                echo "selected";
                                                                                            } ?> >Fresher</option>

                                                            <option value="junior developer" <?php if ($data["position"] == "junior developer")                    {
                                                                                                    echo "selected";
                                                                                                } ?> >Junior Developer</option>

                                                            <option value="senior developer" <?php if ($data["position"] == "senior developer")                    {
                                                                                                    echo "selected";
                                                                                                } ?> >Senior Developer</option>

                                                            <option value="team leader" <?php if ($data["position"] == "team leader")                        {
                                                                                            echo "selected";
                                                                                        } ?> >Team Leader</option>

                                                            <option value="manager" <?php if ($data["position"] == "manager") 
                                                                                   {
                                                                                        echo "selected";
                                                                                    } ?> >Manager</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="dob" class="form-label">DOB:</label>
                                                        <input type="date" name="dob" class="form-control" placeholder="Enter DOB" min="1990-05-11" max="2022-06-23" value="<?= $data['dob']; ?>" >
                                                    </div>
                                                    <div class="col">
                                                        <label for="doj" class="form-label">DOJ:</label>
                                                        <input type="date" name="doj" class="form-control" placeholder="Enter DOj" min="1990-05-11" max="2022-06-23" value="<?= $data['doj']; ?>" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <br>
                                                        <label for="qualification" name="qualification" class="form-label">Qualification: </label>&nbsp;&nbsp;<br>
                                                        <select name="qualification" class="form-control">
                                                            <option value="">--Please Select--</option>
                                                            <option value="BCA" <?php if ($data["highest_qual"] == "BCA") 
                                                                                            {
                                                                                                echo "selected";
                                                                                            } ?> >BCA</option>

                                                            <option value="MCA" <?php if ($data["highest_qual"] == "MCA")                    {
                                                                                                    echo "selected";
                                                                                                } ?> >MCA</option>

                                                            <option value="B.TECH" <?php if ($data["highest_qual"] == "B.TECH")                    {
                                                                                                    echo "selected";
                                                                                                } ?> >B.TECH</option>

                                                            <option value="M.TECH" <?php if ($data["highest_qual"] == "M.TECH")                        {
                                                                                            echo "selected";
                                                                                        } ?> >M.TECHr</option>

                                                            <option value="PHD" <?php if ($data["highest_qual"] == "PHDr") 
                                                                                   {
                                                                                        echo "selected";
                                                                                    } ?> >PHD</option>
                                                        </select>
                                                    </div>
                                                    <div class="col">
                                                        <label for="skills" class="form-label mt-4" name="skills">Skills:</label>&nbsp;&nbsp;<br>
                                                        <input name="skills[]" type="checkbox" value="js" <?php if (in_array('js', $skill_arr)) {echo "checked";} ?>>JS &nbsp;&nbsp;

                                                        <input name="skills[]" type="checkbox" value="html" <?php if (in_array('html', $skill_arr)) {echo "checked";} ?>>HTML &nbsp;&nbsp;

                                                        <input name="skills[]" type="checkbox" value="c" <?php if (in_array('c', $skill_arr)) {echo "checked";} ?>>C &nbsp;&nbsp;

                                                        <input name="skills[]" type="checkbox" value="reactjs" <?php if (in_array('reactjs',$skill_arr)) {echo "checked";} ?>>ReactJs &nbsp;&nbsp;

                                                        <input name="skills[]" type="checkbox" value="Php" <?php if (in_array('Php',$skill_arr)) {echo "checked";} ?>>Php
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col">
                                                        <label for="images" class="form-label">Select other images:</label>
                                                        <input type="file" class="form-control" name="images" placeholder="choose the file" value="<?= $data['image']; ?>" >
                                                       <img src="uploads\<?= $data['image']; ?>" alt="No image selected" width="80" height="60">
                                                    </div>
                                                    <div class="col">
                                                        <label for="gender" class="form-label mt-3">Gender:</label><br>
                                                        <input type="radio" name="gender" value="M" <?php if ($data['gender'] == "M") {
                                                                        echo 'checked';
                                                                    } ?>>Male <br>

                                                        <input type="radio" name="gender" value="F" <?php if ($data['gender'] == "F") {
                                                                                                        echo 'checked';
                                                                                                    } ?>>Female <br>

                                                        <input type="radio" name="gender" value="T" <?php if ($data['gender'] == "T") {
                                                                                                        echo 'checked';
                                                                                                    } ?>>Other <br>
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