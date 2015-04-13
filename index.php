<?php
	if (isset($_POST["submit"]))
	 {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$phone=$_POST['phone'];
		$topic=$_POST['topic'];
		$sex=$_POST['sex'];
		$human = intval($_POST['human']);
		$from = ' www.sanjeevk.com Contact US'; 
		$to = 'tunsanju@gmail.com'; 
		$subject = 'Query from '.$name.' on : '.$topic;
		
		$status= $_POST['selected'];
		
		// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

		$user_ip=get_client_ip(); // storing user external IP Address
	  $body =" From:  $name (SEX -  $sex)\n E-Mail:  $email\n Mobile Number:  $phone \n Topic:  $topic\n Message:\n  $message \n\n\n User IP Address: $user_ip ";
	  $reply_mail=" From:  sanjeev (sanjeev@sanjeevk.com)\n Your E-Mail:  $email\n Your Mobile Number:  $phone \n You Selected Topic:  $topic\n Message:\n  $message \n\n\n Your IP Address Was: $user_ip ";;

		// Check if name has been entered
		if (!$_POST['name']) {
			$errName = 'Please enter your name';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'Please enter a valid email address';
		}
		 
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'Please enter your message';
			
		}
		
		if (!$_POST['phone']) {
			$errphone = 'Please enter your Mobile Number without spaces and do not include +91';
			
		}
		
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}

// If there are no errors, send the email
if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
	if (mail ($to, $subject, $body, $from)) {
		if($status=="selected")
		{
			mail ($email, $subject, $reply_mail, $from);
			
		}
		$result='<div class="alert alert-success">Thank You! We will be in touch</div>';
	} else {
		$result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
	}
}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bootstrap contact form with PHP">
    <meta name="sanjeev kumar" content="sanjeev@sanjeevk.com">
    <title>Contact Form With PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
   
  </head>
  <body>
  	<div class="container">
  		<div class="row">
  			<div class="col-md-6 col-md-offset-3" style="background-color:#F4F5FB " >
  				<h1 class="page-header text-center">Contact US</h1>
                
                <!-- start of Form code Area-->
				<form class="form-horizontal "  role="form" method="post" action="?">
                <!-- start of Name text box code Area-->
					<div class="form-group">
						
						<div class="col-sm-10">
							<input type="text" class="form-control" id="name" name="name" placeholder="First & Last Name" value="<?php echo htmlspecialchars($_POST['name']); ?>">
							<?php echo "<p class='text-danger'>$errName</p>";?>
						</div>
					</div>
                     <!-- End of Name text box code Area-->
                     <!-- start of Email text box code Area-->
					<div class="form-group">
						
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
							<?php echo "<p class='text-danger'>$errEmail</p>";?>
						</div>
					</div>
                    
                     <!-- End of Email text box code Area-->
                     
                     <!-- start of Mobile text box code Area-->
                    <div class="form-group">
						<div class="col-sm-10">
							<input type="number" class="form-control" id="phone" name="phone" placeholder="999 888 1234" value="<?php echo htmlspecialchars($_POST['phone']); ?>">
							<?php echo "<p class='text-danger'>$errphone</p>";?>
						</div>
					</div>
                    <!-- End of Mobile text box code Area-->

                    
                    <!-- start of Topic dropdown list code Area-->

                    <div class="form-group">
                    <div class="col-sm-10">
  <label for="topicl">Select Subject:</label>
  <select class="form-control" id="topic" name="topic">
    <option value="Sales" selected="selected">Sales</option>
    <option value="Marketing">Marketing</option>
    <option value="Customer Support">Customer Support</option>
    <option value="Others">Others</option>
  </select>
</div>
</div> <!-- End of Topic dropdown list code Area-->


<!-- start of Gender Radipo Button code Area-->
                    <div class="form-group">
                     <label for="sexl" class="col-sm-2 control-label">Your sex</label>
                    <div class="radio-inline">
                
  <label class="col-sm-2 control-label"> <input type="radio" name="sex" checked="checked" value="Male">Male</label>
</div>
<div class="radio-inline">
  <label class="col-sm-2  control-label"><input type="radio" name="sex" value="Female">Female </label>
</div>
</div>
<!-- End of Gender Radipo Button code Area-->
<!-- start of Message box code Area-->
					<div class="form-group">
						<!--<label for="message" class="col-sm-2 control-label">Message</label>-->
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" name="message" placeholder="Start your mesage from here"><?php echo htmlspecialchars($_POST['message']);?></textarea>
							<?php echo "<p class='text-danger'>$errMessage</p>";?>
						</div>
					</div>
                    
                    <!-- End of Message box code Area-->
                    <!-- start of Human Verification code Area-->
					<div class="form-group">
						<!--<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>-->
						<div class="col-sm-10">
							<input type="text" class="form-control" id="human" name="human" placeholder="2 + 3 = ?">
							<?php echo "<p class='text-danger'>$errHuman</p>";?>
						</div>
					</div>
                    
                    <!-- End  of Human Verification code Area-->
                    <!-- Start of check Box code Area-->
                    <div class="checkbox">
                  <div class="col-sm-10">
 			 <label><input type="checkbox" value="selected" name= "selected" id="selected">I agree to the <a href="index.php" target="_self"><strong><strong>Terms & Conditions</strong></strong></a>. (if you accept this you will receive a copy of e-mail with filled data)</label>
							</div>
                    </div>
                    
                    <!-- End of check Box code Area-->
                   <!-- Start of Button  code Area-->
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo $result; ?>	
						</div>
					</div>
                    
                    <!-- End of Button  code Area-->
				</form> 
                  <!-- End of Form code Area-->
			</div>
		</div>
	</div>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
