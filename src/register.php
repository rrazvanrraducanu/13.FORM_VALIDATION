<!DOCTYPE HTML>  
<html>
<head>
<link rel="stylesheet" href="css/style.css">
</head>
<body>  

<?php
 include "connection.php";
// define variables and set to empty values
function test_input($data) {
  $data = trim($data);//Remove whitespaces from both sides of a string
  $data = stripslashes($data);//Remove the backslash
  $data = htmlspecialchars($data);//Convert the predefined characters "<" (less than) and ">" (greater than) to HTML entities
  return $data;
}

$numeErr =$prenumeErr= $telefonErr=$emailErr = $genderErr = $websiteErr = "";
$nume =$prenume= $telefon =$email = $gender = $comment = $website = "";
$err=0;

if (isset($_POST["submit"])) {
  if (empty($_POST["nume"])) {
    $numeErr = "Name is required";
    $err=1;
  } else {
    $nume = test_input($_POST["nume"]);
      // check if name only contains letters and whitespace  
      if (!preg_match("/^[a-zA-Z ]*$/",$nume)) {  
      $numeErr = "Only alphabets and white space are allowed"; 
      $err=1;
    }
  }

  if (empty($_POST["prenume"])) {
    $prenumeErr = "Prenume is required";
    $err=1;
  } else {
    $prenume = test_input($_POST["prenume"]);
     // check if name only contains letters and whitespace  
     if (!preg_match("/^[a-zA-Z ]*$/",$prenume)) {  
      $prenumeErr = "Only alphabets and white space are allowed";  
      $err=1;
    }
  }

  if (empty($_POST["telefon"])) {
    $telefonErr = "Telefon is required";
    $err=1;
  } else {
    $telefon = test_input($_POST["telefon"]);
       // check if mobile no is well-formed  
       if (!preg_match ("/^[0-9]*$/", $telefon) ) {  
        $telefonErr = "Only numeric value is allowed.";  
        $err=1;
        }  
    //check mobile no length should not be less and greator than 10  
    if (strlen ($telefon) != 10) {  
        $telefonErr = "Mobile no must contain 10 digits.";  
        $err=1;
        }  
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $err=1;
  } else {
    $email = test_input($_POST["email"]);
       // check that the e-mail address is well-formed  
       $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
       if (!preg_match ($pattern, $email) ) {  
        $err=1;
        $emailErr = "Invalid email format";  
    }  
  }
    
  if (empty($_POST["gender"])) {
    $emailErr = "Gender is required";
    $err=1;
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
  }

  if (empty($_POST["commentariu"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["commentariu"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
    $err=1;
  } else {
    $gender = test_input($_POST["gender"]);
  }
  if($err==0){
  $sql="INSERT INTO users( nume, prenume, telefon, email, gen, website, comentarii) VALUES ('{$nume}', '{$prenume}', '{$telefon}', '{$email}', '{$gender}', '{$website}', '{$comment}')";
 $query=  mysqli_query($con, $sql)or die(mysqli_error($con));
 //header("location:index.php");
 echo "<script>location.href = 'index.php';</script>"; 
}
}


?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="nume">
  <span class="error">* <?php echo $numeErr;?></span>
  <br><br>
  Surname: <input type="text" name="prenume">
  <span class="error">* <?php echo $prenumeErr;?></span>
  <br><br>
  Phone: <input type="text" name="telefon">
  <span class="error">* <?php echo $telefonErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="commentariu" rows="5" cols="40"></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other">Other
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>



</body>
</html>