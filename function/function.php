<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('Asia/Kolkata');

session_start();


function getPDOObject()
{
	 $servername = "localhost";
    $username = "root";
    $password = "";

    try {
      $pdo = new PDO("mysql:host=$servername;dbname=techvilla", $username, $password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $pdo; 
     
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
}

   function check_session()
   {
    if(!isset($_SESSION['userId']) OR empty($_SESSION['userId']) )
    {
      header('location:login.php');
      die();
    }
   }

   function userlogin()
   {

   	   extract($_POST);
//        echo "<pre>";
//      print_r(($_POST['add_emp']));
// echo "</pre>";
//      die();
       $umessage = '';
       $pdo = getPDOObject();
       // echo $email;
       // echo '<br>';
       // echo $password;
       // die();
       if(empty($email) OR empty($password))
       {
         $umessage = '<div class="alert alert-danger">Login id or Password required</div>';
       }else{
        
          $sql = $pdo->prepare("SELECT id,name,email,password,status FROM admin WHERE email=? AND deleted='0' LIMIT 1");
          $sql->execute([$email]);
          $rowCnt = $sql->rowCount();
         
          if($rowCnt>0)
          {
            $rowData = $sql->fetch(PDO::FETCH_ASSOC);
            // verifypassword
            $hashPass = $rowData['password'];
            if(password_verify($password, $hashPass))
            {
                if($rowData['status'] == '1'){
                  
                  $_SESSION['userId'] = $rowData['id'];
                  $_SESSION['userName'] = $rowData['name'];
                  $_SESSION['userPhone'] = $rowData['phone'];
                  $_SESSION['emailid'] = $rowData['email'];

                  if(isset($_SESSION['userId']) && !empty($_SESSION['userId'])){
                    $update=$pdo->prepare("UPDATE admin SET login_time=? WHERE id=?");
                    $update->execute([date('Y-m-d H:m:s'),$_SESSION['userId']]);
                      header('location:index.php');
                        die();
                  }else{
                    $umessage = '<div class="alert alert-danger">Sorry ! Something went wrong !</div>';
                  }


                }else{
                   $umessage = '<div class="alert alert-danger">Sorry ! Your account is suspended !</div>';
                }
            }else{
               $umessage = '<div class="alert alert-danger">Invalid Userid Or Password</div>';
            }
          }else{
              $umessage = '<div class="alert alert-danger">Invalid Userid Or Password</div>';
          }

       }

       return $umessage;
   	   
   }
?>








