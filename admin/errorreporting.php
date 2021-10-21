<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$msg = test_input(isset($_GET['msg']) ? $_GET['msg'] : '');

if ($msg=="")
{
	
	
}

else{


if ($msg==1)

{
echo "<div class='alert alert-success alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Operațiune efectuată cu succes.</div>";
}
else if ($msg==2)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Eroare.</div>";
}
else if ($msg==3)
{
echo "<div class='alert alert-primary alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Date dublicate.</div>";
}

else if ($msg==4)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Eroare de conexiune</div>";
}
else if ($msg==5)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Serverul nu raspunde</div>";
}
else if ($msg==6)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>No user found matching our records</div>";
}
else if ($msg==7)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password not matching</div>";
}
else if ($msg==8)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Forced Logout-Illegal session found</div>";
}
else if ($msg==9)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Mail server timeout.Try again</div>";
}
else if ($msg==10)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Restricted file type</div>";
}
else if ($msg==11)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>File size beyond limits.</div>";
}
else if ($msg==12)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Error updating details.</div>";
}
else if ($msg==13)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Folder not found.</div>";
}
else if ($msg==14)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Super-admin prevented illegal request</div>";
}
else if ($msg==15)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>No data found </div>";
}
else if ($msg==16)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Wrong OTP </div>";
}
else if ($msg==17)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Wrong Credentials.</div>";
}
else if ($msg==18)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Patient already exists in database.Re-admit from patient database</div>";
}
else if ($msg==19)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Course/exam not selected.</div>";
}
else if ($msg==20)
{
echo "<div class='alert alert-info alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>You are logged Out.</div>";
}
else if ($msg==21)
{
echo "<div class='alert alert-warning alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>User already exist.</div>";
}
else if ($msg==22)
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Session time-out!!</div>";
}
else
{
echo "<div class='alert alert-danger alert-dismissible' role='alert'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>unknown error.Contact support!</div>";	
}
}
?>	