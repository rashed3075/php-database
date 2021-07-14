<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registration Form</title>
</head>
<body>



	<!--Php Initializing area-->
	<?php
   
   include 'dbConnect.php';
	
	//value inititalizing
	$fname = $lname = $gender = $dob = $religion = $praddress = $peaddress = $phone = $email = $web = $user = $password = "";
	//error msg initializing 
		$fnameError = $lnameError = $genderError = $dobError = $religionError = $praddressError = $peaddressError = $phoneError = $emailError = $webError = $userError = $passwordError = "";

		$Successful = $Error = "";

		$flag = false;

		//checking post method
		if($_SERVER['REQUEST_METHOD']==="POST")
		{
			//validating
			if(empty($_POST['fname'])){
				$fnameError = "Field can' be empty";
				$flag = true;
			}

			if(empty($_POST['lname'])){
				$lnameError = "Field can' be empty";
					$flag = true;
			}

			if(empty($_POST['gender'])){
				$genderError = "Field can' be empty";
					$flag = true;
			}

			if(empty($_POST['dob'])){
				$dobError = "Field can' be empty";
					$flag = true;
			}

			if(empty($_POST['religion'])){
				$religionError = "Field can' be empty";
					$flag = true;
			}

			if(empty($_POST['praddress'])){
				$praddressError = "Field can' be empty";
					$flag = true;
			}

			if(empty($_POST['peaddress'])){
				$peaddressError = "Field can' be empty";
				$flag = true;
			}

			if(empty($_POST['phoneNumber'])){
				$phoneError = "Field can' be empty";
				$flag = true;
			}

			if(empty($_POST['mail'])){
				$emailError = "Field can' be empty";
				$flag = true;
			}

			if(empty($_POST['web'])){
				$webError = "Field can' be empty";
				$flag = true;
			}

			if(empty($_POST['userName'])){
				$userError = "Field can' be empty";
				$flag = true;
			}

			if(empty($_POST['password'])){
				$passwordError = "Field can' be empty";
				$flag = true;
			}


			//if all field validated
			if(!$flag)
			{
				$fname = input_data($_POST['fname']);
				$lname = input_data($_POST['lname']);
				$gender = input_data($_POST['gender']);
				$dob = input_data($_POST['dob']);
				$religion = input_data($_POST['religion']);
				$praddress = input_data($_POST['praddress']);
				$peaddress = input_data($_POST['peaddress']);
				$phone = input_data($_POST['phoneNumber']);
				$email = input_data($_POST['mail']);
				$web = input_data($_POST['web']);
				$user = input_data($_POST['userName']);
				$password = input_data($_POST['password']);

				$getResult = get($user);
				if($getResult){
					$Error = "User name already exist";
				}
				else{

					  $result = register($fname,$lname,$gender,$dob,$religion,$praddress,$peaddress,$phone,$email,$web,$user,$password);
              if($result){
              	$Successful = "Registration Successfully Done...!!!";
              	
              }
              else{
              	$Error="Registration failed";
              }

				}



            

       

			}
		}
		//Input Formate
function input_data($data) 
  {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
  }

  //Registration Function----


   function register($fname,$lname,$gender,$dob,$religion,$praddress,$peaddress,$phone,$email,$website,$userName,$password){

	$conn = connect();
	$stmt = $conn->prepare("INSERT INTO users(fname,lname,gender,dob,religion,praddress,peaddress,phone,email,website,userName,password) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param("ssssssssssss",$fname,$lname,$gender,$dob,$religion,$praddress,$peaddress,$phone,$email,$website,$userName,$password);
	$res = $stmt->execute();
	return $res;
}

function get($userName){
	$conn = connect();
	$query = $conn->prepare("SELECT * FROM users WHERE userName = ?");
	$query->bind_param("s",$userName);
	$query->execute();
	$result = $query->get_result();
	return $result->fetch_assoc();
}



	?>

	<h1>Registation Form</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
		<fieldset>

	<legend>Basic Information</legend>

	<span style="color: red">*</span>
	<label for="fname">First Name</label>
	<input type="text" name="fname" id="fname">
	<span style="color: red"> <?php echo $fnameError; ?></span><br><br>

	<span style="color: red">*</span>
	<label for="lname">Last Name</label>
	<input type="text" name="lname" id="lname">
	 <span style="color: red"> <?php echo $lnameError; ?></span><br><br>

	<span style="color: red">*</span>
	Gender <input type="radio" name="gender" id="male" value="male"> <label for="male">Male</label>
	<input type="radio" name="gender" id="female" value="female">  <label for="female">Female</label> 
	<span style="color: red"><?php echo $genderError; ?> </span><br><br>

	<span style="color: red">*</span>
	<label for="dob">Date of Birth </label>
	<input type="Date" name="dob" id="dob" > 
	<span style="color: red"><?php echo $dobError; ?> </span><br><br>

	<span style="color: red">*</span>
	<label for="religion">Religion </label>
	<select id="religion" name="religion">

		<option value="muslim">Muslim</option>
		<option value="hindu">Hindu</option>
		<option value="cristian">Cristian</option>
		<option value="buddha">Buddha</option>
		
	</select> <span style="color: red"> <?php echo $religionError; ?></span>
</fieldset> <br>

<fieldset>
	<legend>Contact Information</legend>

	<span style="color: red">*</span>
	<label for="praddress">Present Address </label>
	<textarea id="praddress" rows="2" cols="30" name="praddress"></textarea> 
	<span style="color: red"> <?php echo $praddressError; ?></span><br><br>

	<span style="color: red">*</span>
	<label for="peaddress">Permanent Address </label>
	<textarea id="peaddress" rows="2" cols="30" name="peaddress"></textarea>
	 <span style="color: red"> <?php echo $peaddressError; ?></span><br><br>

	<span style="color: red">*</span>
	<label for="phoneNumber">Phone </label>
	<input type="tel" name="phoneNumber" id="phoneNumber">
	  <span style="color: red"> <?php echo $phoneError; ?></span><br><br>

	<span style="color: red">*</span>
	<label for="mail">Email </label>
	<input type="Email" name="mail" id="mail">
	 <span style="color: red"> <?php echo $emailError; ?></span><br><br>

<span style="color: red">*</span>	
<label for="web">Personal Website Link </label>
	<input type="url" name="web" id="web">
 <span style="color: red"> <?php echo $webError; ?></span>

</fieldset><br>
<fieldset>
	<legend>Account Information</legend>


	<span style="color: red">*</span>
	<label for="userName">User Name </label>
	<input type="text" name="userName" id="userName"> 
 <span style="color: red"> <?php echo $userError; ?></span><br><br>

	<span style="color: red">*</span>
	<label for="password">Password </label>
	<input type="password" name="password" id="password">
	 <span style="color: red"> <?php echo $passwordError; ?></span><br><br>

</fieldset><br>

<input type="submit" name="submit" value="Submit">
	</form><br>
	<!-- Login page link -->
	<a href="login.php">Login Here</a><br>


	 <span style="color: green"> <?php echo $Successful; ?>  </span>
<span style="color: red"><?php echo $Error ;  ?></span>





</body>
</html>