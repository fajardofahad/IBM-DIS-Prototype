<?php
session_start();
include("db/connect.php");
include("db/connect2.php");
$txtUsername = $_POST["Email"];
//ENCRYPTING PASSWORD FOR COMPARISON
$txtPassword = md5(sha1($_POST["Password"]));

//SELECT QUERY IN ibsprocurement schema
$selectAccount = "Select * from ibsprocurement.user_account where
screenName = '$txtUsername' and screenPassword = '$txtPassword'";

//EXECUTION OF SQL QUERY
$resultQuery = mysql_query($selectAccount) or die(mysql_error());
$numRows = mysql_num_rows($resultQuery);
	if ($numRows != 0)
		{
			//FETCH ROWS
			while($row = mysql_fetch_array($resultQuery))
			{
			
				//user_account . screenName, userType, screenPassword, employeeNumber, update, delete, add, cancel
				$userType = $row['userType'];
				$screenName = $row['screenName'];
				$employeeNumber = $row['employeeNumber'];
				$update = $row['update'];
				$delete = $row['delete'];
				$add = $row['add'];
				$cancel = $row['cancel'];
				
				
				//SELECT QUERY IN ibsprocurement schema
				$selectemployee_details = "Select * from ibsemployee.employee_details where employeeNumber = '$employeeNumber'";
				
				//EXECUTION OF SQL QUERY
				$resultQuery = mysql_query($selectemployee_details) or die(mysql_error());
				$numRows = mysql_num_rows($resultQuery);
				
				if ($numRows != 0){
					while($row = mysql_fetch_array($resultQuery)){
					//employee_details . employeeNumber, employeeType, employeePosition, employeeDepartment, employeeDepartmentCode, mngrNo
						$employeeType = $row['employeeType'];
						$employeePosition = $row['employeePosition'];
						$employeeDepartment = $row['employeeDepartment'];
						$employeeDepartmentCode = $row['employeeDepartmentCode'];
						$mngrNo = $row['mngrNo'];
					
					}
				}
				
				//SELECT QUERY IN ibsprocurement schema
				$selectemployee = "Select * from ibsemployee.employee where employeeNumber = '$employeeNumber'";
				
				//EXECUTION OF SQL QUERY
				$resultQuery = mysql_query($selectemployee) or die(mysql_error());
				$numRows = mysql_num_rows($resultQuery);
				
				if ($numRows != 0){
					while($row = mysql_fetch_array($resultQuery)){
					
					//employee . employeeNumber, employeeEmail, employeeContactNumber, employeeFname, employeeLname, employeeMInitial
						$employeeContactNumber = $row['employeeContactNumber'];
						$employeeFname = $row['employeeFname'];
						$employeeLname = $row['employeeLname'];
						$employeeMInitial = $row['employeeMInitial'];
						$employeeEmail = $row['employeeEmail'];
					}
				}
			
				//SESSION CREATION FOR GLOBAL CONFIGURATION				
				$_SESSION['MANAGERNO'] = $mngrNo;
				$_SESSION['DEPARTMENTCODE'] = $employeeDepartmentCode;
				$_SESSION['DEPARTMENT'] = $employeeDepartment;
				$_SESSION['POSITION'] = $employeePosition;
				$_SESSION['EMAIL'] = $employeeEmail;
				$_SESSION['EMPLOYEECONTACTNO'] = $employeeContactNumber;
				$_SESSION['EMPLOYEENO'] = $employeeNumber;
				$_SESSION['NAME'] = $employeeFname .' '. $employeeMInitial .' '. $employeeLname;
				$_SESSION['USERTYPE'] = $userType;
				
				//SESSION FOR USER ACCESS
				$_SESSION['DELETE'] = $delete;
				$_SESSION['UPDATE'] = $update;
				$_SESSION['ADD'] = $add;
				$_SESSION['CANCEL'] = $cancel;
				$_SESSION['LOGGED'] = 1;
			
				//REDIRECTION WITH DEPENDENCY TO USERTYPE
				if ($_SESSION['USERTYPE'] == "Requestor"){
					header('Location: requestor/main.php');
				}elseif ($_SESSION['USERTYPE'] == "Procurement"){
					header('Location: procurement/main.php');
				}elseif ($_SESSION['USERTYPE'] == "Administrator"){
					header('Location: administrator/main.php');
				}
			}
		}
		else
		header('location: index.php?msg=1');
		
?>