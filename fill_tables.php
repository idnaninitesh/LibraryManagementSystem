<?php
/*SELECT User_ID,SUM(Fine) FROM (SELECT Transaction.User_ID,Fine.Fine FROM Transaction,Fine WHERE Transaction.Issue_Date=Fine.Issue_Date AND Transaction.Return_Date=Fine.Return_Date) AS test GROUP BY User_ID HAVING User_ID='131080013'
Query for fine where userId can be changed. If list of all students is reqd remove having clause

SELECT Book_ID FROM Book WHERE MATCH(Title) AGAINST('Waste') AND Book_ID NOT IN (SELECT Book_ID FROM Transaction WHERE Book_ID IN (SELECT Book_ID FROM Book WHERE MATCH(Title) AGAINST('Waste')) AND Return_Date IS NULL UNION SELECT Book_ID FROM Reserve WHERE Book_ID IN (SELECT Book_ID FROM Book WHERE MATCH(Title) AGAINST('Waste')) AND DATEDIFF(CURDATE(),Date)<=2)
list of books available by title

SELECT COUNT(ISBN) FROM Transaction WHERE ISBN=(SELECT DISTINCT ISBN FROM Book WHERE MATCH(Title) AGAINST('Waste'))
number of times a book is issued

SELECT ISBN,COUNT(ISBN) FROM Transaction WHERE ISBN IN (SELECT DISTINCT ISBN FROM Book) GROUP BY ISBN
number of times all books issued on ISBN

SELECT test.User_ID,test.Book_ID,test.Date FROM (SELECT User_RID.User_ID,Reserve.RID,Reserve.Book_ID,Reserve.Date FROM User_RID JOIN Reserve WHERE User_RID.RID=Reserve.RID) AS test WHERE test.User_ID = '111070011'
Books reserved by a student
*/
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'library_management';

$conn = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
mysql_select_db($mysql_db);

function fill_book($id,$title,$author,$category,$isbn,$call_no,$publisher,$year,$place,$edition,$rating,$cost,$abstract)
{

$query = "INSERT INTO Book (Book_ID, Title, Author,Category, ISBN, Call_No, Publisher, Year, Place, Edition, Rating, Cost, Abstract) VALUES ('$id','$title','$author','$category','$isbn','$call_no','$publisher','$year','$place','$edition',$rating,$cost,'$abstract');";

//mysql_select_db($mysql_db);
$retval = mysql_query($query);
echo 'Book ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';
}

function fill_vendor($id,$name,$email)
{

$query = "INSERT INTO Vendor (Vendor_ID, Name, Email_id) VALUES ('$id', '$name', '$email');";

//mysql_select_db($mysql_db);
$retval = mysql_query($query);
echo 'Vendor ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}

function fill_vendor_contact($id,$phone)
{

$query = "INSERT INTO Vendor_Contact (Vendor_ID, Contact_no) VALUES ('$id', '$phone');";

//mysql_select_db($mysql_db);
$retval = mysql_query($query);
echo 'Vendor Contact ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}


function fill_user()
{

$query = "INSERT IGNORE INTO User (`User_ID`, `Name`, `Address`, `DOB`, `Category`, `Designation`, `Branch`, `Year`, `Degree`) VALUES ('141030001', 'Mahesh Walde', 'Andheri', '1996-01-11', '1', NULL, 'Electronics', 'First', 'Btech'), ('131030002', 'Akshay Khairkar', 'Borivali', '1995-02-13', '1', NULL, 'Electronics', 'Second', 'Btech'), ('121030003', 'Dhananjay Nagargoje', 'Malad', '1994-03-15', '1', NULL, 'Electronics', 'Third', 'Btech'), ('141070005', 'Ajay Wayal', 'Kandivali', '1995-05-21', '1', NULL, 'Computers', 'First', 'Btech'), ('131070006', 'Sanket Kasar', 'Virar', '1995-06-23', '1', NULL, 'Computers', 'Second', 'Btech'), ('121070010', 'Prashil Bhimani', 'Borivali', '1994-07-25', '1', NULL, 'Computers', 'Third', 'Btech'), ('111070011', 'Rudra Mishra', 'Andheri', '1993-08-27', '1', NULL, 'Computers', 'Final', 'Btech'), ('141080012', 'Chitrang Shah', 'Nashik', '1996-09-27', '1', NULL, 'IT', 'First', 'Btech'), ('131080013', 'Mohammed Gadiwala', 'Thane', '1995-10-02', '1', NULL, 'IT', 'Second', 'Btech'), ('121080014', 'Nitesh Idnani', 'Titwala', '1994-11-23', '1', NULL, 'IT', 'Third', 'Btech'), ('111080015', 'Neel Kapadia', 'Andheri', '1993-12-04', '1', NULL, 'IT', 'Final', 'Btech'); ";

$retval = mysql_query($query);


$query = "INSERT IGNORE INTO User (`User_ID`, `Name`, `Address`, `DOB`, `Category`, `Designation`, `Branch`, `Year`, `Degree`) VALUES ('141010016', 'Mikin Shah', 'Borivali', '1992-03-06', '1', NULL, 'Civil', 'First', 'Mtech'), ('131010017', 'Meet Parekh', 'Malad', '1991-04-08', '1', NULL, 'Civil', 'Final', 'Mtech'), ('141040018', 'Keertan Pius', 'Kandivali', '1992-05-10', '1', NULL, 'Textile', 'First', 'Mtech'), ('131040019', 'Vaibhav Savla', 'Virar', '1991-06-12', '1', NULL, 'Textile', 'Final', 'Mtech'), ('141060020', 'Vidhit Patni', 'Borivali', '1992-07-14', '1', NULL, 'Textile', 'First', 'Production'), ('131060021', 'Utsav Shah', 'Kalyan', '1991-09-18', '1', NULL, 'Production', 'Final', 'Mtech'), ('141020022', 'Jeet Wagle', 'Nashik', '1998-10-20', '1', NULL, 'Mechanical', 'First', 'Diploma'), ('131020023', 'Ketan Vijaykar', 'Thane', '1997-11-22', '1', NULL, 'Mechanical', 'Second', 'Diploma'), ('121020024', 'Kiran Dange', 'Dadar', '1996-12-24', '1', NULL, 'Mechanical', 'Final', 'Diploma'), ('141050025', 'Krunal Gaikwad', 'Andheri', '1998-01-26', '1', NULL, 'Electrical', 'First', 'Diploma'), ('131050026', 'Omkar Mate', 'Borivali', '1997-02-28', '1', NULL, 'Electrical', 'Second', 'Diploma'), ('121050028', 'Deepak Chaudhari', 'Malad', '1996-03-21', '1', NULL, 'Electrical', 'Final', 'Diploma'), ('141090029', 'Swapnil Jadhav', 'Kandivali', '1998-04-23', '1', NULL, 'Chemistry', 'First', 'Diploma'), ('131090045', 'Sagar Sable', 'Virar', '1996-05-25', '1', NULL, 'Chemistry', 'Second', 'Diploma'), ('121090046', 'Bhavesh Deore', 'Borivali', '1996-06-27', '1', NULL, 'Chemistry', 'Final', 'Diploma'), ('rahuljain123', 'Rahul Jain', 'Matunga', '1976-11-05', '0', 'Librarian', NULL, NULL, NULL), ('priyashinde456', 'Priya Shinde', 'Thane', '1985-09-17', '0', 'Assistant Librarian', NULL, NULL, NULL), ('mishrapranav108', 'Pranav Mishra', 'Malad', '1983-03-29', '0', 'Clerk', NULL, NULL, NULL), ('131081030', 'Namrata Panchal', 'Kalyan', '1995-10-16', '1', NULL, 'IT', 'Second', 'Btech'), ('131081031', 'Darshana Nachan', 'Nashik', '1995-03-28', '1', NULL, 'IT', 'Second', 'Btech'), ('131081032', 'Vishakha Mundhe', 'Thane', '1995-07-04', '1', NULL, 'IT', 'Second', 'Btech'), ('131081033', 'Tejasvi Bhaviskar', 'Dadar', '1995-12-10', '1', NULL, 'IT', 'Second', 'Btech'), ('patilmahesh357', 'Mahesh Patil', 'Vashi', '1981-05-24', '0', 'Assistant Librarian', NULL, NULL, NULL), ('dipalimahajan789', 'Dipali Mahajan', 'Dombivali', '1984-01-12', '0', 'Clerk', NULL, NULL, NULL); ";

$retval = mysql_query($query);
echo 'Users ';
if($retval)
	echo 'added<br>';
else
	echo 'not added<br>'.mysql_error();
}

function fill_age()
{

$query = "INSERT INTO Age (`DOB`, `Age`) VALUES ('1993-08-27', '21'), ('1993-12-04', '21'), ('1996-12-24', '18'), ('1993-03-15', '21'), ('1996-03-21', '18'), ('1994-07-25', '20'), ('1994-11-23', '20'), ('1991-04-08', '23'), ('1996-06-27', '18'), ('1997-11-22', '17'), ('1995-02-13', '20'), ('1991-06-12', '23'), ('1997-02-28', '18'), ('1991-09-18', '23'), ('1995-06-23', '19'), ('1995-10-02', '19'), ('1996-05-25', '18'), ('1992-03-06', '23'), ('1998-10-20', '16'), ('1996-01-11', '19'), ('1992-05-10', '22'), ('1998-01-26', '17'), ('1992-07-14', '22'), ('1995-05-21', '18'), ('1996-09-27', '18'), ('1998-04-23', '16'), ('1983-03-29', '31'), ('1985-09-17', '29'), ('1976-11-05', '38'), ('1995-10-16', '19'), ('1995-03-28', '19'), ('1995-07-04', '19'), ('1995-12-10', '19'), ('1984-01-12', '31'), ('1981-05-24', '33');  ";

$retval = mysql_query( $query);
echo 'Age ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}

function fill_qualification()
{

$query = "INSERT INTO Qualification (`User_ID`, `Qualification`) VALUES ('mishrapranav108', '10th Pass'), ('mishrapranav108', 'Undergraduate'), ('priyashinde456', '10th Pass'), ('priyashinde456', 'Undergraduate'), ('priyashinde456', 'Graduate'), ('rahuljain123', '10th Pass'), ('rahuljain123', 'Undergraduate'), ('rahuljain123', 'Graduate'), ('rahuljain123', 'Postgraduate'), ('dipalimahajan789', '10th Pass'), ('patilmahesh357', '10th Pass'), ('patilmahesh357', 'Undergraduate'), ('patilmahesh357', 'Graduate'); ";

$retval = mysql_query( $query);
echo 'Qualification ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}

function fill_authentication()
{

$query = "INSERT IGNORE INTO Authentication (`User_ID`, `Password`) VALUES ('111070011', '098f6bcd4621d373cade4e832627b4f6'), ('111080015', '098f6bcd4621d373cade4e832627b4f6'), ('121020024', '098f6bcd4621d373cade4e832627b4f6'), ('121030003', '098f6bcd4621d373cade4e832627b4f6'), ('121050028', '098f6bcd4621d373cade4e832627b4f6'), ('121070010', '098f6bcd4621d373cade4e832627b4f6'), ('121080014', '098f6bcd4621d373cade4e832627b4f6'), ('121090046', '098f6bcd4621d373cade4e832627b4f6'), ('131010017', '098f6bcd4621d373cade4e832627b4f6'), ('131020023', '098f6bcd4621d373cade4e832627b4f6'), ('131030002', '098f6bcd4621d373cade4e832627b4f6'), ('131040019', '098f6bcd4621d373cade4e832627b4f6'), ('131050026', '098f6bcd4621d373cade4e832627b4f6'), ('131060021', '098f6bcd4621d373cade4e832627b4f6'), ('131070006', '098f6bcd4621d373cade4e832627b4f6'), ('131080013', '098f6bcd4621d373cade4e832627b4f6'), ('131090045', '098f6bcd4621d373cade4e832627b4f6'), ('141010016', '098f6bcd4621d373cade4e832627b4f6'), ('141020022', '098f6bcd4621d373cade4e832627b4f6'), ('141030001', '098f6bcd4621d373cade4e832627b4f6'), ('141040018', '098f6bcd4621d373cade4e832627b4f6'), ('141050025', '098f6bcd4621d373cade4e832627b4f6'), ('141060020', '098f6bcd4621d373cade4e832627b4f6'), ('141070005', '098f6bcd4621d373cade4e832627b4f6'), ('141080012', '098f6bcd4621d373cade4e832627b4f6'), ('141090029', '098f6bcd4621d373cade4e832627b4f6'), ('mishrapranav108', '098f6bcd4621d373cade4e832627b4f6'), ('priyashinde456', '098f6bcd4621d373cade4e832627b4f6'), ('rahuljain123', '098f6bcd4621d373cade4e832627b4f6'), ('131081030', '098f6bcd4621d373cade4e832627b4f6'), ('131081031', '098f6bcd4621d373cade4e832627b4f6'), ('131081032', '098f6bcd4621d373cade4e832627b4f6'), ('131081033', '098f6bcd4621d373cade4e832627b4f6'), ('dipalimahajan789', '098f6bcd4621d373cade4e832627b4f6'), ('patilmahesh357', '098f6bcd4621d373cade4e832627b4f6');";

$retval = mysql_query( $query);
echo 'Authentication ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}

function fill_reserve()
{

$query= "INSERT INTO Reserve (`RID`, `Book_ID`, `Time`, `Date`) VALUES (NULL, '11653', '07:30:00', '2015-03-04'), (NULL, '11661', '15:20:00', '2015-03-04'), (NULL, '11671', '08:40:00', '2015-02-09'), (NULL, '11660', '10:30:00', '2015-03-04'), (NULL, '11654', '15:10:00', '2015-02-19'), (NULL, '11667', '18:30:00', '2015-03-03'), (NULL, '11669', '15:24:00', '2015-03-03'), (NULL, '11656', '20:50:00', '2015-02-14'), (NULL, '11663', '16:40:00', '2015-02-12'), (NULL, '11666', '22:35:00', '2015-01-31'), (NULL, '11658', '08:25:00', '2015-06-13'), (NULL, '11662', '13:15:00', '2015-01-24'), (NULL, '11665', '11:38:00', '2015-04-19'), (NULL, '11672', '10:55:00', '2015-01-05'), (NULL, '11674', '09:30:00', '2015-01-14'), (NULL, '11677', '14:20:00', '2015-03-02'), (NULL, '11681', '07:45:00', '2015-02-08'), (NULL, '11684', '18:45:00', '2015-01-25'), (NULL, '11688', '11:00:00', '2015-02-28'), (NULL, '11718', '15:45:00', '2015-02-03'), (NULL, '11720', '17:36:00', '2015-01-08'), (NULL, '11739', '08:23:00', '2015-02-14'), (NULL, '11741', '13:39:00', '2015-03-02'), (NULL, '11745', '16:32:00', '2015-01-23'), (NULL, '11751', '10:54:00', '2015-01-05'), (NULL, '11752', '12:13:00', '2015-03-03'), (NULL, '11759', '07:21:00', '2015-01-24'), (NULL, '11759', '12:49:00', '2015-02-16'), (NULL, '11760', '14:10:00', '2015-02-18'), (NULL, '11789', '14:16:00', '2015-03-03');";

$retval = mysql_query( $query);
echo 'Reserve ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}

function fill_user_rid()
{

$query= "INSERT INTO User_RID (`RID`, `User_ID`) VALUES ('1', '111070011'), ('2', '131010017'), ('3', '121080014'), ('4', '141010016'), ('5', '141090029'), ('6', '131070006'), ('7', '111070011'), ('8', '131080013'), ('9', '121070010'), ('10', '121020024'), ('11', '141010016'), ('12', '121070010'), ('13', '131080013'), ('14', '141040018'), ('15', '121050058'), ('16', '111070011'), ('17', '131060021'), ('18', '131050026'), ('19', '141010016'), ('20', '141090029'), ('21', '121050028'), ('22', '131030002'), ('23', '1410600020'), ('24', '121080014'), ('25', '141080012'), ('26', '131090045'), ('27', '131080013'), ('28', '131020023'), ('29', '131010017'), ('30', '141040018'); ";

$retval = mysql_query( $query);
echo 'User RID ';
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}


function fill_transaction()
{

$query="INSERT INTO Transaction (`TID`, `User_ID`, `Book_ID`, `ISBN`, `Issue_Date`, `Return_Date`) VALUES (NULL, '111070011', '11653', '0-07-100823-3', '2015-02-11', '2015-02-16'), (NULL, '131010017', '11661', '0-07-112865-4', '2015-03-05', NULL), (NULL, '121080014', '11671', '0-07-112647-3', '2015-02-10', '2015-02-21'), (NULL, '141010016', '11660', '0-07-112865-4', '2015-03-05', NULL), (NULL, '141090029', '11654', '0-07-100823-3', '2015-02-20', '2015-02-24'), (NULL, '131070006', '11667', '0-07-112647-3', '2015-03-04', NULL), (NULL, '111070011', '11669', '0-07-112647-3', '2015-03-04', NULL), (NULL, '131080013', '11656', '0-07-100823-3', '2015-02-15', '2015-02-28'), (NULL, '121070010', '11663', '0-07-112865-4', '2015-02-13', '2015-02-18'), (NULL, '121020024', '11666', '0-07-112865-4', '2015-02-01', '2015-02-05');";
mysql_query($query);
$query="INSERT INTO Transaction (`TID`, `User_ID`, `Book_ID`, `ISBN`, `Issue_Date`, `Return_Date`) VALUES (NULL, '141040018', '11672', '9814-12-618-7', '2015-01-06', '2015-01-27'), (NULL, '121050028', '11674', '81-7319-069-2', '2015-01-15', '2015-01-20'), (NULL, '111070011', '11675', '81-7319-069-2', '2015-01-17', '2015-01-23'), (NULL, '121080011', '11677', '81-7319-069-2', '2015-03-02', NULL), (NULL, '131060021', '11681', '0-19-568575-x', '2015-02-10', '2015-02-15'), (NULL, '131050026', '11684', '0-19-568575-x', '2015-01-26', '2015-02-5'), (NULL, '111070011', '11688', '0-201-02117-X', '2015-03-01', NULL), (NULL, '141010016', '11718', '81-7758-111-2', '2015-02-04', '2015-02-20'), (NULL, '141090029', '11720', '81-7758-111-2', '2015-01-10', '2015-01-14'), (NULL, '121050028', '11737', '0-07-026753-7', '2015-02-12', '2015-02-16'), (NULL, '131030002', '11739', '0-07-026753-7', '2015-02-14', '2015-02-19'), (NULL, '141060020', '11741', '0-07-026753-7', '2015-03-03', NULL), (NULL, '121080014', '11745', '81-317-1727-5', '2015-01-24', '2015-01-28'), (NULL, '141080012', '11751', '1403-93099-6', '2015-01-06', '2015-01-16'), (NULL, '141070005', '11752', '1403-93099-6', '2015-03-04', NULL), (NULL, '131090045', '11753', '1403-93099-6', '2015-02-27', '2015-03-02'), (NULL, '131080013', '11759', '978-81-317-1625-0', '2015-01-25', '2015-01-31'), (NULL, '141050025', '11759', '978-81-317-1625-0', '2015-02-17', '2015-02-25'), (NULL, '131020023', '11760', '978-81-317-1625-0', '2015-02-19', '2015-02-24'), (NULL, '131010017', '11789', '978-81-203-0140-5', '2015-03-04', NULL);";
mysql_query($query);
echo 'Transaction filled';
}

function fill_fine()
{

$query ="INSERT INTO Fine (`Issue_Date`, `Return_Date`, `Fine`) VALUES ('2015-02-11', '2015-02-16', '0'), ('2015-02-10', '2015-02-21', '4'), ('2015-02-20', '2015-02-24', '0'), ('2015-02-15', '2015-02-28', '6'), ('2015-02-13', '2015-02-18', '0'), ('2015-02-01', '2015-02-05', '0');"; 

$retval = mysql_query( $query);
$query="INSERT INTO Fine (`Issue_Date`, `Return_Date`, `Fine`) VALUES ('2015-01-06', '2015-01-27', '21'), ('2015-01-15', '2015-01-20', '0'), ('2015-01-17', '2015-01-23', '0'), ('2015-02-10', '2015-02-15', '0'), ('2015-01-26', '2015-02-05', '3'), ('2015-02-04', '2015-02-20', '11'), ('2015-01-10', '2015-01-14', '0'), ('2015-02-12', '2015-02-16', '0'), ('2015-02-14', '2015-02-19', '0'), ('2015-01-24', '2015-01-28', '0'), ('2015-01-06', '2015-01-16', '3'), ('2015-02-27', '2015-03-02', '0'), ('2015-01-25', '2015-01-31', '0'), ('2015-02-17', '2015-02-25', '1'), ('2015-02-19', '2015-02-24', '0');";
echo 'Fine ';
$retval = mysql_query( $query);
if($retval)
	echo 'Filled';
else
	echo 'Not filled '.mysql_error();
echo '<br />';

}

fill_book('11653', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11654', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11655', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11656', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11657', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11658', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11659', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', '1991', 'New York', '6', 2, 1037.34, 'Book dealing with water supply and sewerage design and planning.');
fill_book('11660', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11661', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11662', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11663', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11664', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11665', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11666', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', '1993', 'New York', 'International', 3, 1218.14, 'Deals with the urban problem of solid waste management');
fill_book('11667', mysql_real_escape_string('Kaizen:The Key to Japan\'s Competitive Success'), 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', '1991', 'New York', '1', 2, 519.80, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work');
fill_book('11668', mysql_real_escape_string('Kaizen:The Key to Japan\'s Competitive Success'), 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', '1991', 'New York', '1', 2, 519.80, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work');
fill_book('11669', mysql_real_escape_string('Kaizen:The Key to Japan\'s Competitive Success'), 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', '1991', 'New York', '1', 2, 519.80, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work');
fill_book('11670', mysql_real_escape_string('Kaizen:The Key to Japan\'s Competitive Success'), 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', '1991', 'New York', '1', 2, 519.80, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work');
fill_book('11671', mysql_real_escape_string('Kaizen:The Key to Japan\'s Competitive Success'), 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', '1991', 'New York', '1', 2, 519.80, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work');
fill_book('11672', 'Motion and Time Study Design and Measurement of work', 'Barnes, R.M.', 'Mechanical', '9814-12-618-7', '65.015.14/BAR', 'John Wiley & Sons', '2003', 'New York', '7', 3, 339.00, 'Book dealing with motion and work');
fill_book('11673', 'Motion and Time Study Design and Measurement of work', 'Barnes, R.M.', 'Mechanical', '9814-12-618-7', '65.015.14/BAR', 'John Wiley & Sons', '2003', 'New York', '7', 3, 339.00, 'Book dealing with motion and work');
fill_book('11674', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11675', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11676', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11677', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11678', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11679', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11680', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', '2001', 'New Delhi', '2', 3, 250.00, 'Deals with the basics Fuzzy Control');
fill_book('11681', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11682', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11683', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11684', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11685', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11686', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11687', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', '2008', 'New York', NULL, 4, 375.00, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach');
fill_book('11688', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11689', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11690', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11691', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11692', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11693', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11694', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', '1977', 'Boston', '1', 5, 1988.80, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as Einstein’s general relativity, superconductivity, and quantum mechanics');
fill_book('11717', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', '2006', 'India', '7', 2, 395.00, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is "enterprise decision support, the web, and the role of knowledge management.');
fill_book('11718', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', '2006', 'India', '7', 2, 395.00, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is "enterprise decision support, the web, and the role of knowledge management.');
fill_book('11719', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', '2006', 'India', '7', 2, 395.00, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is "enterprise decision support, the web, and the role of knowledge management.');
fill_book('11720', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', '2006', 'India', '7', 2, 395.00, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is "enterprise decision support, the web, and the role of knowledge management.');
fill_book('11721', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', '2006', 'India', '7', 2, 395.00, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is "enterprise decision support, the web, and the role of knowledge management.');
fill_book('11722', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', '2006', 'India', '7', 2, 395.00, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is "enterprise decision support, the web, and the role of knowledge management.');
fill_book('11732', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', '2008', 'New Delhi', '3', 2, 250.00, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.');
fill_book('11733', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', '2008', 'New Delhi', '3', 2, 250.00, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.');
fill_book('11734', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', '2008', 'New Delhi', '3', 2, 250.00, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.');
fill_book('11735', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', '2008', 'New Delhi', '3', 2, 250.00, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.');
fill_book('11736', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', '2008', 'New Delhi', '3', 2, 250.00, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.');
fill_book('11737', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11738', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11739', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11740', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11741', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11742', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11743', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', '1987', 'Singapore', '2', 4, 356.00, 'Deals with computer graphics using the programming approach');
fill_book('11744', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('11745', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('11746', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('11747', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('11748', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('11749', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('117450', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', '2008', 'India', '2', 3, 399.00, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.');
fill_book('11751', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11752', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11753', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11754', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11755', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11756', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11757', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', '2006', 'India', '2', 4, 265.00, 'This book provides a comprehensive guide to the managerial perspectives of information systems');
fill_book('11758', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11759', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11760', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11761', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11762', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11763', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11764', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', '2007', 'India', '5', 5, 399.00, 'Deals with the details of basic Database Systems');
fill_book('11765', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11766', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11767', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11768', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11769', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11770', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11771', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', '2007', 'India', '7', 4, 429.00, 'Deals with the details of Database Systems');
fill_book('11772', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11773', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11774', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11775', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11776', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11777', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11778', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', '2006', 'India', '1', 3, 250.00, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.');
fill_book('11789', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11790', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11791', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11792', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11793', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11794', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11795', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11796', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11797', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_book('11798', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', '2008', 'New Delhi', '2', 4, 195.00, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.');
fill_vendor('163','Scientific Books','scientificbooks@gmail.com');
fill_vendor('25891','Narosa Books','narosabooks@gmail.com');
fill_vendor('6106','Sita Books','sitabooks@gmail.com');
fill_vendor('6018','Academic Book House','academicbookhouse@gmail.com');
fill_vendor('24938','Books Unlimited','booksunlimited@gmail.com');
fill_vendor_contact('163','022-26354164');
fill_vendor_contact('25891','022-26451606');
fill_vendor_contact('25891','022-26451607');
fill_vendor_contact('6106','022-27813704');
fill_vendor_contact('6018','022-22877060');
fill_vendor_contact('24938','022-24913450');
fill_vendor_contact('24938','022-24913451');
fill_vendor_contact('24938','022-24913452');
fill_user();
fill_transaction();
fill_age();
fill_qualification();
fill_reserve();
fill_user_rid();
fill_authentication();
fill_fine();
?>