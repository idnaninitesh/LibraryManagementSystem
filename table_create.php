<?php

function create_user()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS User
		(
		User_ID VARCHAR(20) NOT NULL,
	    Name VARCHAR(40) NOT NULL,
	    Address VARCHAR(200) NOT NULL,
	    DOB DATE NOT NULL,
	    Category TINYINT(1) NOT NULL,
	    Designation VARCHAR(40) NULL,
	    Branch VARCHAR(40) NULL,
	    Year VARCHAR(10) NULL,
	    Degree VARCHAR(10) NULL,		
		PRIMARY KEY (User_ID)
		); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'User ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    $query="INSERT INTO `User` (`User_ID`, `Name`, `Address`, `DOB`, `Category`, `Designation`, `Branch`, `Year`, `Degree`) VALUES
('111070011', 'Rudra Mishra', 'Andheri', '1993-08-27', 1, NULL, 'Computers', 'Final', 'Btech'),
('111080015', 'Neel Kapadia', 'Andheri', '1993-12-04', 1, NULL, 'IT', 'Final', 'Btech'),
('121020024', 'Kiran Dange', 'Dadar', '1996-12-24', 1, NULL, 'Mechanical', 'Final', 'Diploma'),
('121030003', 'Dhananjay Nagargoje', 'Malad', '1994-03-15', 1, NULL, 'Electronics', 'Third', 'Btech'),
('121050028', 'Deepak Chaudhari', 'Malad', '1996-03-21', 1, NULL, 'Electrical', 'Final', 'Diploma'),
('121070010', 'Prashil Bhimani', 'Borivali', '1994-07-25', 1, NULL, 'Computers', 'Third', 'Btech'),
('121080014', 'Nitesh Idnani', 'Asangao', '1994-11-23', 1, NULL, 'IT', 'Third', 'Btech'),
('121090046', 'Bhavesh Deore', 'Borivali', '1996-06-27', 1, NULL, 'Chemistry', 'Final', 'Diploma'),
('131010017', 'Meet Parekh', 'Malad', '1991-04-08', 1, NULL, 'Civil', 'Final', 'Mtech'),
('131020023', 'Ketan Vijaykar', 'Thane', '1997-11-22', 1, NULL, 'Mechanical', 'Second', 'Diploma'),
('131030002', 'Akshay Khairkar', 'Borivali', '1995-02-13', 1, NULL, 'Electronics', 'Second', 'Btech'),
('131040019', 'Vaibhav Savla', 'Virar', '1991-06-12', 1, NULL, 'Textile', 'Final', 'Mtech'),
('131050026', 'Omkar Mate', 'Borivali', '1997-02-28', 1, NULL, 'Electrical', 'Second', 'Diploma'),
('131060021', 'Utsav Shah', 'Kalyan', '1991-09-18', 1, NULL, 'Production', 'Final', 'Mtech'),
('131070006', 'Sanket Kasar', 'Virar', '1995-06-23', 1, NULL, 'Computers', 'Second', 'Btech'),
('131080013', 'Mohammed Gadiwala', 'Dockyard', '1995-10-02', 1, NULL, 'IT', 'Second', 'Btech'),
('131081030', 'Namrata Panchal', 'Kalyan', '1995-10-16', 1, NULL, 'IT', 'Second', 'Btech'),
('131081031', 'Darshana Nachan', 'Nashik', '1995-03-28', 1, NULL, 'IT', 'Second', 'Btech'),
('131081032', 'Vishakha Mundhe', 'Thane', '1995-07-04', 1, NULL, 'IT', 'Second', 'Btech'),
('131081033', 'Tejasvi Bhaviskar', 'Dadar', '1995-12-10', 1, NULL, 'IT', 'Second', 'Btech'),
('131090045', 'Sagar Sable', 'Virar', '1996-05-25', 1, NULL, 'Chemistry', 'Second', 'Diploma'),
('141010016', 'Mikin Shah', 'Borivali', '1992-03-06', 1, NULL, 'Civil', 'First', 'Mtech'),
('141020022', 'Jeet Wagle', 'Nashik', '1998-10-20', 1, NULL, 'Mechanical', 'First', 'Diploma'),
('141030001', 'Mahesh Walde', 'Andheri', '1996-01-11', 1, NULL, 'Electronics', 'First', 'Btech'),
('141040018', 'Keertan Pius', 'Kandivali', '1992-05-10', 1, NULL, 'Textile', 'First', 'Mtech'),
('141050025', 'Krunal Gaikwad', 'Andheri', '1998-01-26', 1, NULL, 'Electrical', 'First', 'Diploma'),
('141060020', 'Vidhit Patni', 'Borivali', '1992-07-14', 1, NULL, 'Textile', 'First', 'Production'),
('141070005', 'Ajay Wayal', 'Kandivli', '1995-05-21', 1, NULL, 'Computers', 'First', 'Btech'),
('141080012', 'Chitrang Shah', 'Nashik', '1996-09-27', 1, NULL, 'IT', 'First', 'Btech'),
('141090029', 'Swapnil Jadhav', 'Kandivali', '1998-04-23', 1, NULL, 'Chemistry', 'First', 'Diploma'),
('dipalimahajan789', 'Dipali Mahajan', 'Dombivali', '1984-01-12', 0, 'Clerk', NULL, NULL, NULL),
('mishrapranav108', 'Pranav Mishra', 'Malad', '1983-03-29', 0, 'Clerk', NULL, NULL, NULL),
('patilmahesh357', 'Mahesh Patil', 'Vashi', '1981-05-24', 0, 'Assistant Librarian', NULL, NULL, NULL),
('priyashinde456', 'Priya Shinde', 'Thane', '1985-09-17', 0, 'Assistant Librarian', NULL, NULL, NULL),
('rahuljain123', 'Rahul Jain', 'Matunga', '1976-11-05', 0, 'Librarian', NULL, NULL, NULL);
";
    $retval=mysql_query($query);
    if($retval)
        echo 'filled';
    else
        echo ' not filled';
    
echo '<br />';
}

function create_book()
{
	
global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS `Book` (
  `Book_ID` varchar(6) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Category` varchar(40) DEFAULT NULL,
  `ISBN` varchar(40) NOT NULL,
  `Call_No` varchar(20) NOT NULL,
  `Publisher` varchar(40) DEFAULT NULL,
  `Year` year(4) DEFAULT NULL,
  `Place` varchar(200) DEFAULT NULL,
  `Edition` varchar(20) DEFAULT NULL,
  `Cost` float DEFAULT NULL,
  `Abstract` varchar(1000) DEFAULT NULL,
  `Remark` varchar(50) DEFAULT NULL,
  `Bought_Year` year(4) NOT NULL,
  `Vendor` varchar(40) NOT NULL,
  PRIMARY KEY(Book_ID)
) ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
    echo mysql_error();
$sql="ALTER TABLE `Book` ADD FULLTEXT(`Title`);";
$retval = mysql_query( $sql, $conn );
$sql="ALTER TABLE `Book` ADD FULLTEXT(`Author`);";
$retval = mysql_query( $sql, $conn );
$sql="ALTER TABLE `Book` ADD FULLTEXT(`Category`);";
$retval = mysql_query( $sql, $conn );
$sql="ALTER TABLE `Book` ADD FULLTEXT   (`ISBN`);";
$retval = mysql_query( $sql, $conn );
echo 'Book ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
$query="INSERT INTO `Book` (`Book_ID`, `Title`, `Author`, `Category`, `ISBN`, `Call_No`, `Publisher`, `Year`, `Place`, `Edition`, `Cost`, `Abstract`, `Remark`, `Bought_Year`, `Vendor`) VALUES
('11653', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', 'For reference', 2015, 'Scientific Books'),
('11654', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', NULL, 2015, 'Scientific Books'),
('11655', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', NULL, 2015, 'Scientific Books'),
('11656', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', NULL, 2015, 'Scientific Books'),
('11657', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', NULL, 2015, 'Scientific Books'),
('11658', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', NULL, 2015, 'Scientific Books'),
('11659', 'Water Supply and Sewerage', 'McGhee, T.J.', 'Civil', '0-07-100823-3', '628.1/.2/MCG', 'McGraw-Hill', 1991, 'New York', '6', 1037.34, 'Book dealing with water supply and sewerage design and planning.', NULL, 2015, 'Scientific Books'),
('11660', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', 'For reference', 2015, 'Scientific Books'),
('11661', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', NULL, 2015, 'Scientific Books'),
('11662', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', NULL, 2015, 'Scientific Books'),
('11663', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', NULL, 2015, 'Scientific Books'),
('11664', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', NULL, 2015, 'Scientific Books'),
('11665', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', NULL, 2015, 'Scientific Books'),
('11666', 'Integrated Solid Waste Management', 'G. Tchobanoglous, Theisen', 'Civil', '0-07-112865-4', '628.44/TCH', 'McGraw-Hill', 1993, 'New York', 'International', 1218.14, 'Deals with the urban problem of solid waste management', NULL, 2015, 'Scientific Books'),
('11667', 'Kaizen:The Key to Japan''s Competitive Success', 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', 1991, 'New York', '1', 519.8, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work', 'For reference', 2015, 'Narosa Books'),
('11668', 'Kaizen:The Key to Japan''s Competitive Success', 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', 1991, 'New York', '1', 519.8, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work', NULL, 2015, 'Narosa Books'),
('11669', 'Kaizen:The Key to Japan''s Competitive Success', 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', 1991, 'New York', '1', 519.8, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work', NULL, 2015, 'Narosa Books'),
('11670', 'Kaizen:The Key to Japan''s Competitive Success', 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', 1991, 'New York', '1', 519.8, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work', NULL, 2015, 'Narosa Books'),
('11671', 'Kaizen:The Key to Japan''s Competitive Success', 'Imai Masaaki', 'Management', '0-07-112647-3', '658.5/IMA', 'McGraw-Hill', 1991, 'New York', '1', 519.8, 'For the professional manager or student of management, a comprehensive handbook of 16 Kaizen management practices that can be put to work', NULL, 2015, 'Narosa Books'),
('11672', 'Motion and Time Study Design and Measurement of work', 'Barnes, R.M.', 'Mechanical', '9814-12-618-7', '65.015.14/BAR', 'John Wiley & Sons', 2003, 'New York', '7', 339, 'Book dealing with motion and work', 'For reference', 2015, 'Narosa Books'),
('11673', 'Motion and Time Study Design and Measurement of work', 'Barnes, R.M.', 'Mechanical', '9814-12-618-7', '65.015.14/BAR', 'John Wiley & Sons', 2003, 'New York', '7', 339, 'Book dealing with motion and work', NULL, 2015, 'Narosa Books'),
('11674', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', 'For reference', 2015, 'Academic Books'),
('11675', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', NULL, 2015, 'Academic Books'),
('11676', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', NULL, 2015, 'Academic Books'),
('11677', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', NULL, 2015, 'Academic Books'),
('11678', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', NULL, 2015, 'Academic Books'),
('11679', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', NULL, 2015, 'Academic Books'),
('11680', 'An Introduction To Fuzzy Control', 'Driankov,Hellendoorn', 'Computers', '81-7319-069-2', '621-52:681.32/DRI', 'Narosa Publication House', 2001, 'New Delhi', '2', 250, 'Deals with the basics Fuzzy Control', NULL, 2015, 'Academic Books'),
('11681', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', 'For reference', 2015, 'Academic Books'),
('11682', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', NULL, 2015, 'Academic Books'),
('11683', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', NULL, 2015, 'Academic Books'),
('11684', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', NULL, 2015, 'Academic Books'),
('11685', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', NULL, 2015, 'Academic Books'),
('11686', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', NULL, 2015, 'Academic Books'),
('11687', 'Networks for Computer Scientists and Engineers', 'Zheng,Akhtar', 'Computers', '0-19-568575-x', '681.324/ZHE', 'Oxford University Press', 2008, 'New York', '', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach', NULL, 2015, 'Academic Books'),
('11688', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', 'For reference', 2015, 'Sita Books'),
('11689', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', NULL, 2015, 'Sita Books'),
('11690', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', NULL, 2015, 'Sita Books'),
('11691', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', NULL, 2015, 'Sita Books'),
('11692', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', NULL, 2015, 'Sita Books'),
('11693', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', NULL, 2015, 'Sita Books'),
('11694', 'The Feynman Lectures on Physics Volume 2', 'Feynman,Leighton,Sands', 'Physics', '0-201-02117-X', '530.145/FEY', 'Addison-Wesley Publication Co.', 1977, 'Boston', '1', 1988.8, 'Ranging from the most basic principles of Newtonian physics through such formidable theories as EinsteinÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢s general relativity, superconductivity, and quantum mechanics', NULL, 2015, 'Sita Books'),
('11717', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', 2006, 'India', '7', 395, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is enterprise decision support, the web, and the role of knowledge management.', 'For reference', 2015, 'Academic Books'),
('11718', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', 2006, 'India', '7', 395, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is enterprise decision support, the web, and the role of knowledge management.', NULL, 2015, 'Academic Books'),
('11719', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', 2006, 'India', '7', 395, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is enterprise decision support, the web, and the role of knowledge management.', NULL, 2015, 'Academic Books'),
('11720', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', 2006, 'India', '7', 395, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is enterprise decision support, the web, and the role of knowledge management.', NULL, 2015, 'Academic Books'),
('11721', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', 2006, 'India', '7', 395, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is enterprise decision support, the web, and the role of knowledge management.', NULL, 2015, 'Academic Books'),
('11722', 'Decision Support Systems and Intelligent Systems', 'Turban,Aronson', 'Computers', '81-7758-111-2', '650.124.4:681.3/TUR', 'Pearson Education', 2006, 'India', '7', 395, 'For courses in Decision Support Systems, Computerized Decision Making, and Management Support Systems.The theme throughout is enterprise decision support, the web, and the role of knowledge management.', NULL, 2015, 'Academic Books'),
('11732', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', 2008, 'New Delhi', '3', 250, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.', 'For reference', 2015, 'Books Unlimited'),
('11733', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', 2008, 'New Delhi', '3', 250, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.', NULL, 2015, 'Books Unlimited'),
('11734', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', 2008, 'New Delhi', '3', 250, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.', NULL, 2015, 'Books Unlimited'),
('11735', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', 2008, 'New Delhi', '3', 250, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.', NULL, 2015, 'Books Unlimited'),
('11736', 'Engineering Hydrology', 'Subramanya', 'Civil', '0-07-064855-7', '551.48/49:551.5/SUB', 'Tata McGraw Hill', 2008, 'New Delhi', '3', 250, 'This book is an elementary treatment of engineering hydrology with descriptions that aid in a qualitative appreciation and techniques which enable a quantitative evaluation of the hydrologic processes that are of importance to a civil engineer.', NULL, 2015, 'Books Unlimited'),
('11737', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', 'For reference', 2015, 'Books Unlimited'),
('11738', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', NULL, 2015, 'Books Unlimited'),
('11739', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', NULL, 2015, 'Books Unlimited'),
('11740', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', NULL, 2015, 'Books Unlimited'),
('11741', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', NULL, 2015, 'Books Unlimited'),
('11742', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', NULL, 2015, 'Books Unlimited'),
('11743', 'Computer Graphics: A Programming Approach', 'Harrington,Steren', 'Computers', '0-07-026753-7', '681.31:744/HAR', 'Tata McGraw Hill', 1987, 'Singapore', '2', 356, 'Deals with computer graphics using the programming approach', NULL, 2015, 'Books Unlimited'),
('11744', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', 'For reference', 2015, 'Books Unlimited'),
('11745', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', NULL, 2015, 'Books Unlimited'),
('117450', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', NULL, 2015, ''),
('11746', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', NULL, 2015, 'Books Unlimited'),
('11747', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', NULL, 2015, 'Books Unlimited'),
('11748', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', NULL, 2015, 'Books Unlimited'),
('11749', 'Mobile Satellite Communications:Principles and Trends', 'Richharia', 'Communications', '81-317-1727-5', '621.396/RIC', 'Pearson Education', 2008, 'India', '2', 399, 'This book provides a comprehensive guide to the current technologies and emerging trends of the future facing telecommunications professionals. It takes a system level approach, giving in-depth treatment of technical and business-related issues.', NULL, 2015, 'Books Unlimited'),
('11751', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', 'For reference', 2015, 'Books Unlimited'),
('11752', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', NULL, 2015, 'Books Unlimited'),
('11753', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', NULL, 2015, 'Books Unlimited'),
('11754', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', NULL, 2015, 'Books Unlimited'),
('11755', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', NULL, 2015, 'Books Unlimited'),
('11756', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', NULL, 2015, 'Books Unlimited'),
('11757', 'Management Information Systems:Managerial Perspectives', 'Goyal', 'Computers', '1403-93099-6', '65+658:681.3/GOY', 'McMillan India Ltd.', 2006, 'India', '2', 265, 'This book provides a comprehensive guide to the managerial perspectives of information systems', NULL, 2015, 'Books Unlimited'),
('11758', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', 'For reference', 2015, 'Books Unlimited'),
('11759', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', NULL, 2015, 'Books Unlimited'),
('11760', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', NULL, 2015, 'Books Unlimited'),
('11761', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', NULL, 2015, 'Books Unlimited'),
('11762', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', NULL, 2015, 'Books Unlimited'),
('11763', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', NULL, 2015, 'Books Unlimited'),
('11764', 'Fundamentals of Database Systems', 'Navathe,Elmasri', 'Computers', '978-81-317-1625-0', '681.31.01/ELM', 'Pearson Education', 2007, 'India', '5', 399, 'Deals with the details of basic Database Systems', NULL, 2015, 'Books Unlimited'),
('11765', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', 'For reference', 2015, 'Books Unlimited'),
('11766', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', NULL, 2015, 'Books Unlimited'),
('11767', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', NULL, 2015, 'Books Unlimited'),
('11768', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', NULL, 2015, 'Books Unlimited'),
('11769', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', NULL, 2015, 'Books Unlimited'),
('11770', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', NULL, 2015, 'Books Unlimited'),
('11771', 'Database Systems:Design, Implementation, Management', 'Rob,Coronel', 'Computers', '81-315-0319-4', '681.3.01/ROB', 'Thomson/Course Technology', 2007, 'India', '7', 429, 'Deals with the details of Database Systems', NULL, 2015, 'Books Unlimited'),
('11772', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', 'For reference', 2015, 'Books Unlimited'),
('11773', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', NULL, 2015, 'Books Unlimited'),
('11774', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', NULL, 2015, 'Books Unlimited'),
('11775', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', NULL, 2015, 'Books Unlimited'),
('11776', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', NULL, 2015, 'Books Unlimited'),
('11777', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', NULL, 2015, 'Books Unlimited'),
('11778', 'Software Project Management Practice', 'Jalote', 'Computers', '81-7758-857-5', '681.3.06:658.568/JAL', 'Pearson Education', 2006, 'India', '1', 250, 'Introduces a set of practices and principles that have been used to successfully execute hundreds of projects of all types and sizes.', NULL, 2015, 'Books Unlimited'),
('11789', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', 'For reference', 2015, 'Books Unlimited'),
('11790', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11791', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11792', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11793', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11794', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11795', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11796', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11797', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11798', 'System Simulation', 'Gordon', 'Computers', '978-81-203-0140-5', '681.32/GOR', 'Prentice Hall of India', 2008, 'New Delhi', '2', 195, 'Besides providing an excellent coverage of fundamental concepts and applications, the author uses simulation programming languages and covers also socio-economic problems.', NULL, 2015, 'Books Unlimited'),
('11799', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', 'For reference', 2015, 'Books Unlimited'),
('11800', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11801', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11802', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11803', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11804', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11805', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11806', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11807', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11808', 'Simulation with Arena', 'David Kelton', 'Computers', '978-0-07-110685', '681.32/KEL', 'McGraw Hill', 2007, 'New York', '4', 1199.27, 'Simulation with Arena provides a comprehensive treatment of simulation using industry-standard Arena software.', NULL, 2015, 'Books Unlimited'),
('11809', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', 'For reference', 2015, 'Books Unlimited'),
('11810', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11811', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11812', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11813', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11814', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11815', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11816', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11817', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11818', 'Mobile Communications', 'Schiller', 'Communications', '978-81-7758-263-5', '621.396/SCH', 'Pearson Education', 2008, 'New Delhi', '2', 375, 'The rapid progress and convergence of the field has created a need for new techniques and solutions, knowledgeable professionals to create and implement them.', NULL, 2015, 'Books Unlimited'),
('11829', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, ' introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', 'For reference', 2015, 'Books Unlimited'),
('11830', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11831', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11832', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11833', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11834', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11835', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11836', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11837', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11838', 'Digital Image Processing', 'Rafael Gonzalez', 'Computers', '978-81-317-1934-8', '681.32/GON', 'Pearson Education', 2008, 'New Delhi', '3', 450, 'Introduction to basic concepts and methodologies for digital image processing continues its cutting-edge focus on contemporary developments in all mainstream areas of image processing.', NULL, 2015, 'Books Unlimited'),
('11849', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', 'For reference', 2015, 'Books Unlimited'),
('11850', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11851', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11852', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11853', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11854', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11855', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11856', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11857', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11858', 'Management Information Systems: Texts And Cases', 'Jawadekar', 'Computers', '978-0-07-061634-9', '650+658:681.3/JAW', 'Tata McGraw Hill', 2007, 'New Delhi', '3', 325, 'This book aims at presenting a systematic knowledge of the management information technology, so that it can be appreciated and understood for application in business and industry.', NULL, 2015, 'Books Unlimited'),
('11859', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', 'For reference', 2015, 'Books Unlimited'),
('11860', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11861', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11862', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11863', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11864', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11865', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11866', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11867', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11868', 'Management Information Systems', 'Laudon', 'Computers', '978-81-203-3468-7', '650+658:681.3/LAU', 'Prentice Hall of India', 2008, 'New Delhi', '10', 525, 'Details of management information systems.', NULL, 2015, 'Books Unlimited'),
('11899', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', 'For reference', 2015, 'Books Unlimited'),
('11900', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11901', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11902', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11903', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11904', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11905', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11906', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11907', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11908', 'Pattern Recognition and Image Analysis', 'Earl Gose', 'Computers', '978-81-203-1484-9', '681.322/GOS', 'Prentice Hall of India', 2007, 'New Delhi', 'Eastern', 325, 'Over the past 20 to 25 years, pattern recognition has become an important part of image processing applications where the input data is an image. This book is a complete introduction to pattern recognition and its increasing role in image processing.', NULL, 2015, 'Books Unlimited'),
('11909', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', 'For reference', 2015, 'Books Unlimited'),
('11910', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11911', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11912', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11913', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11914', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11915', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11916', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11917', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited'),
('11918', 'Networks for Computer Scientists and Engineers', 'Youlu Zheng,Shakil Akhtar', 'Select', '978-0-19568575-6', '681.324/ZHE', 'Oxford University Press', 2007, 'New York', '1', 375, 'Networks for Computer Scientists and Engineers is a data communications and networks textbook with a unique software projects and laboratory-based approach.', NULL, 2015, 'Books Unlimited');
";
$retval=mysql_query($query);
    if($retval)
        echo ' filled';
    else
        echo ' not filled'.mysql_error();

echo '<br />';
}

function create_age()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Age
		(
	    DOB DATE NOT NULL,
	    Age INT NOT NULL
		); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Age ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';

$query="INSERT INTO `Age` (`DOB`, `Age`) VALUES
('1993-08-27', 21),
('1993-12-04', 21),
('1996-12-24', 18),
('1993-03-15', 21),
('1996-03-21', 18),
('1994-07-25', 20),
('1994-11-23', 20),
('1991-04-08', 23),
('1996-06-27', 18),
('1997-11-22', 17),
('1995-02-13', 20),
('1991-06-12', 23),
('1997-02-28', 18),
('1991-09-18', 23),
('1995-06-23', 19),
('1995-10-02', 19),
('1996-05-25', 18),
('1992-03-06', 23),
('1998-10-20', 16),
('1996-01-11', 19),
('1992-05-10', 22),
('1998-01-26', 17),
('1992-07-14', 22),
('1995-05-21', 18),
('1996-09-27', 18),
('1998-04-23', 16),
('1983-03-29', 31),
('1985-09-17', 29),
('1976-11-05', 38),
('1995-10-16', 19),
('1995-03-28', 19),
('1995-07-04', 19),
('1995-12-10', 19),
('1984-01-12', 31),
('1981-05-24', 33);
";
    $retval=mysql_query($query);
    if($retval)
        echo 'Filled';
    else
        echo 'not Filled';
    
echo '<br />';
}

function create_user_rid()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS User_RID
		(
		RID INT(11) NOT NULL,
	    User_ID VARCHAR(20) NOT NULL
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'User_RID ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    $query="INSERT INTO `User_RID` (`RID`, `User_ID`) VALUES
(1, '111070011'),
(2, '131010017'),
(3, '121080014'),
(4, '141010016'),
(5, '141090029'),
(6, '131070006'),
(7, '111070011'),
(8, '131080013'),
(9, '121070010'),
(10, '121020024'),
(11, '141010016'),
(12, '121070010'),
(13, '131080013'),
(14, '141040018'),
(15, '121050058'),
(16, '111070011'),
(17, '131060021'),
(18, '131050026'),
(19, '141010016'),
(20, '141090029'),
(21, '121050028'),
(22, '131030002'),
(23, '1410600020'),
(24, '121080014'),
(25, '141080012'),
(26, '131090045'),
(27, '131080013'),
(28, '131020023'),
(29, '131010017'),
(30, '141040018'),
(31, '111070011'),
(32, '121080014'),
(33, '131081030'),
(34, '131081030'),
(35, '111070011'),
(36, '111070011'),
(37, '111070011'),
(38, '141010016'),
(39, '121080014');";
    $retval=mysql_query($query);
    if($retval)
        echo 'Filled';
    else
        echo 'not Filled';

    
echo '<br />';
}

function create_qualification()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Qualification
		(
		User_ID VARCHAR(20) NOT NULL,
	    Qualification VARCHAR(20) NOT NULL 
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Qualification ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    
    $query="INSERT INTO `Qualification` (`User_ID`, `Qualification`) VALUES
('mishrapranav108', '10th Pass'),
('mishrapranav108', 'Undergraduate'),
('priyashinde456', '10th Pass'),
('priyashinde456', 'Undergraduate'),
('priyashinde456', 'Graduate'),
('rahuljain123', '10th Pass'),
('rahuljain123', 'Undergraduate'),
('rahuljain123', 'Graduate'),
('rahuljain123', 'Postgraduate'),
('dipalimahajan789', '10th Pass'),
('patilmahesh357', '10th Pass'),
('patilmahesh357', 'Undergraduate'),
('patilmahesh357', 'Graduate');
";
    $retval=mysql_query($query);
    if($retval)
        echo 'filled';
    else
        echo ' not filled';
    
echo '<br />';
}

function create_vendor()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Vendor
		(
		Vendor_ID VARCHAR(20) NOT NULL,
	    Name VARCHAR(20) NOT NULL,
	    Email_id VARCHAR(40) NULL  
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Vendor ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    
$query="INSERT INTO `Vendor` (`Vendor_ID`, `Name`, `Email_id`) VALUES
('163', 'Scientific Books', 'scientificbooks@gmail.com'),
('25891', 'Narosa Books', 'narosabooks@gmail.com'),
('6106', 'Sita Books', 'sitabooks@gmail.com'),
('6018', 'Academic Book House', 'academicbookhouse@gmail.com'),
('24938', 'Books Unlimited', 'booksunlimited@gmail.com');
";
    $retval=mysql_query($query);
    if($retval)
        echo 'Filled';
    else
        echo 'not Filled';
echo '<br />';
}

function create_vendor_contact()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Vendor_Contact
		(
		Vendor_ID VARCHAR(20) NOT NULL,
	    Contact_no VARCHAR(14) NOT NULL 
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Vendor Contact ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    $query="INSERT INTO `Vendor_Contact` (`Vendor_ID`, `Contact_no`) VALUES
('163', '022-26354164'),
('25891', '022-26451606'),
('25891', '022-26451607'),
('6106', '022-27813704'),
('6018', '022-22877060'),
('24938', '022-24913450'),
('24938', '022-24913451'),
('24938', '022-24913452');
";
    $retval=mysql_query($query);
    if($retval)
        echo 'Filled';
    else
        echo 'not Filled';

echo '<br />';
}

function create_transaction()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Transaction
		(
		TID INT(11) NOT NULL AUTO_INCREMENT,
		User_ID VARCHAR(20) NOT NULL,
		Book_ID VARCHAR(6) NOT NULL,
		ISBN VARCHAR(40) NOT NULL,
		Issue_Date DATE NOT NULL,
		Return_Date DATE NULL,
		PRIMARY KEY (TID)
		); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Transaction ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    $query="INSERT INTO `Transaction` (`TID`, `User_ID`, `Book_ID`, `ISBN`, `Issue_Date`, `Return_Date`) VALUES
(1, '111070011', '11653', '0-07-100823-3', '2015-02-11', '2015-02-16'),
(2, '131010017', '11661', '0-07-112865-4', '2015-03-05', NULL),
(3, '121080014', '11671', '0-07-112647-3', '2015-02-10', '2015-02-21'),
(4, '141010016', '11660', '0-07-112865-4', '2015-03-05', NULL),
(5, '141090029', '11654', '0-07-100823-3', '2015-02-20', '2015-02-24'),
(6, '131070006', '11667', '0-07-112647-3', '2015-03-04', NULL),
(7, '111070011', '11669', '0-07-112647-3', '2015-03-04', '2015-03-17'),
(8, '131080013', '11656', '0-07-100823-3', '2015-02-15', '2015-02-28'),
(9, '121070010', '11663', '0-07-112865-4', '2015-02-13', '2015-02-18'),
(10, '121020024', '11666', '0-07-112865-4', '2015-02-01', '2015-02-05'),
(11, '141040018', '11672', '9814-12-618-7', '2015-01-06', '2015-01-27'),
(12, '121050028', '11674', '81-7319-069-2', '2015-01-15', '2015-01-20'),
(13, '111070011', '11675', '81-7319-069-2', '2015-01-17', '2015-01-23'),
(14, '121080014', '11677', '81-7319-069-2', '2015-03-02', NULL),
(15, '131060021', '11681', '0-19-568575-x', '2015-02-10', '2015-02-15'),
(16, '131050026', '11684', '0-19-568575-x', '2015-01-26', '2015-02-05'),
(17, '111070011', '11688', '0-201-02117-X', '2015-03-01', '2015-03-17'),
(18, '141010016', '11718', '81-7758-111-2', '2015-02-04', '2015-02-20'),
(19, '141090029', '11720', '81-7758-111-2', '2015-01-10', '2015-01-14'),
(20, '121050028', '11737', '0-07-026753-7', '2015-02-12', '2015-02-16'),
(21, '131030002', '11739', '0-07-026753-7', '2015-02-14', '2015-02-19'),
(22, '141060020', '11741', '0-07-026753-7', '2015-03-03', NULL),
(23, '121080014', '11745', '81-317-1727-5', '2015-01-24', '2015-01-28'),
(24, '141080012', '11751', '1403-93099-6', '2015-01-06', '2015-01-16'),
(25, '141070005', '11752', '1403-93099-6', '2015-03-04', NULL),
(26, '131090045', '11753', '1403-93099-6', '2015-02-27', '2015-03-02'),
(27, '131080013', '11759', '978-81-317-1625-0', '2015-01-25', '2015-01-31'),
(28, '141050025', '11759', '978-81-317-1625-0', '2015-02-17', '2015-02-25'),
(29, '131020023', '11760', '978-81-317-1625-0', '2015-02-19', '2015-02-24'),
(30, '131010017', '11789', '978-81-203-0140-5', '2015-03-04', NULL),
(31, '121080014', '11798', '978-81-203-0140-5', '2015-03-13', '2015-03-13'),
(32, '111070011', '11662', '0-07-112865-4', '2015-03-14', '2015-03-14'),
(33, '121080014', '11663', '0-07-112865-4', '2015-03-15', '2015-03-15'),
(34, '111070011', '11758', '978-81-317-1625-0', '2015-03-17', '2015-03-17'),
(35, '121080014', '11758', '978-81-317-1625-0', '2015-03-17', '2015-03-17'),
(36, '111070011', '11758', '978-81-317-1625-0', '2015-03-17', NULL),
(37, '111070011', '11751', '1403-93099-6', '2015-03-17', '2015-03-17'),
(38, '121080014', '11663', '0-07-112865-4', '2015-03-17', '2015-03-17'),
(39, '121080014', '11918', '978-0-19568575-6', '2015-03-17', '2015-03-17'),
(40, '121080014', '11918', '978-0-19568575-6', '2015-03-17', '2015-03-17'),
(41, '111070011', '11662', '0-07-112865-4', '2015-03-17', '2015-03-17'),
(42, '111070011', '11662', '0-07-112865-4', '2015-03-17', '2015-03-17'),
(43, '111070011', '11662', '0-07-112865-4', '2015-03-17', NULL);
";
    $retval=mysql_query($query);
    if($retval)
        echo 'filled';
    else
        echo ' not filled';

    
echo '<br />';
}

function create_fine()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Fine
		(
	    Issue_Date DATE NOT NULL,
		Return_Date DATE NULL,
	    Fine FLOAT NOT NULL 
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Fine ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    
    
    $query="INSERT INTO `Fine` (`Issue_Date`, `Return_Date`, `Fine`) VALUES
('2015-02-11', '2015-02-16', 0),
('2015-02-10', '2015-02-21', 4),
('2015-02-20', '2015-02-24', 0),
('2015-02-15', '2015-02-28', 6),
('2015-02-13', '2015-02-18', 0),
('2015-02-01', '2015-02-05', 0),
('2015-01-06', '2015-01-27', 21),
('2015-01-15', '2015-01-20', 0),
('2015-01-17', '2015-01-23', 0),
('2015-02-10', '2015-02-15', 0),
('2015-01-26', '2015-02-05', 3),
('2015-02-04', '2015-02-20', 11),
('2015-01-10', '2015-01-14', 0),
('2015-02-12', '2015-02-16', 0),
('2015-02-14', '2015-02-19', 0),
('2015-01-24', '2015-01-28', 0),
('2015-01-06', '2015-01-16', 3),
('2015-02-27', '2015-03-02', 0),
('2015-01-25', '2015-01-31', 0),
('2015-02-17', '2015-02-25', 1),
('2015-02-19', '2015-02-24', 0),
('2015-03-13', '2015-03-13', 0),
('2015-03-14', '2015-03-14', 0),
('2015-03-15', '2015-03-15', 0),
('0000-00-00', '0000-00-00', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0),
('2015-03-04', '2015-03-17', 6),
('2015-03-01', '2015-03-17', 11),
('2015-03-17', '2015-03-17', 0),
('2015-03-17', '2015-03-17', 0);
";
    $retval=mysql_query($query);
    if($retval)
        echo 'filled';
    else
        echo ' not filled';
    
echo '<br />';
}

function create_authentication()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Authentication
		(
		User_ID VARCHAR(20) NOT NULL,
	    Password VARCHAR(32) NOT NULL,
	    PRIMARY KEY (User_ID) 
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Authentication ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    $query="INSERT INTO `Authentication` (`User_ID`, `Password`) VALUES
('111070011', '7f064da04f6fce39f051d75dcfc43221'),
('111080015', '098f6bcd4621d373cade4e832627b4f6'),
('121020024', '098f6bcd4621d373cade4e832627b4f6'),
('121030003', '098f6bcd4621d373cade4e832627b4f6'),
('121050028', '098f6bcd4621d373cade4e832627b4f6'),
('121070010', '098f6bcd4621d373cade4e832627b4f6'),
('121080014', '098f6bcd4621d373cade4e832627b4f6'),
('121090046', '098f6bcd4621d373cade4e832627b4f6'),
('131010017', '098f6bcd4621d373cade4e832627b4f6'),
('131020023', '098f6bcd4621d373cade4e832627b4f6'),
('131030002', '098f6bcd4621d373cade4e832627b4f6'),
('131040019', '098f6bcd4621d373cade4e832627b4f6'),
('131050026', '098f6bcd4621d373cade4e832627b4f6'),
('131060021', '098f6bcd4621d373cade4e832627b4f6'),
('131070006', '098f6bcd4621d373cade4e832627b4f6'),
('131080013', '098f6bcd4621d373cade4e832627b4f6'),
('131081030', '098f6bcd4621d373cade4e832627b4f6'),
('131081031', '098f6bcd4621d373cade4e832627b4f6'),
('131081032', '098f6bcd4621d373cade4e832627b4f6'),
('131081033', '098f6bcd4621d373cade4e832627b4f6'),
('131090045', '098f6bcd4621d373cade4e832627b4f6'),
('141010016', 'e2b0bf757594589924baed1d9f810684'),
('141020022', '098f6bcd4621d373cade4e832627b4f6'),
('141030001', '098f6bcd4621d373cade4e832627b4f6'),
('141040018', '098f6bcd4621d373cade4e832627b4f6'),
('141050025', '098f6bcd4621d373cade4e832627b4f6'),
('141060020', '098f6bcd4621d373cade4e832627b4f6'),
('141070005', '098f6bcd4621d373cade4e832627b4f6'),
('141080012', '098f6bcd4621d373cade4e832627b4f6'),
('141090029', '098f6bcd4621d373cade4e832627b4f6'),
('dipalimahajan789', '098f6bcd4621d373cade4e832627b4f6'),
('mishrapranav108', '098f6bcd4621d373cade4e832627b4f6'),
('patilmahesh357', '098f6bcd4621d373cade4e832627b4f6'),
('priyashinde456', '098f6bcd4621d373cade4e832627b4f6'),
('rahuljain123', '098f6bcd4621d373cade4e832627b4f6');
";
    $retval=mysql_query($query);
    if($retval)
        echo ' filled';
    else
        echo ' no filled';
echo '<br />';
}

function create_reserve()
{

global $conn,$mysql_db;

$sql = 'CREATE TABLE IF NOT EXISTS Reserve
		(
		RID INT(11) NOT NULL AUTO_INCREMENT,
	    Book_ID VARCHAR(6) NOT NULL,
	    Time  TIME NOT NULL,
	    Date DATE NOT NULL,
	    PRIMARY KEY (RID)
	    ); ';

mysql_select_db($mysql_db);
$retval = mysql_query( $sql, $conn );
echo 'Reserve ';
if($retval)
	echo 'Created';
else
	echo 'Not Created';
    $query="INSERT INTO `Reserve` (`RID`, `Book_ID`, `Time`, `Date`) VALUES
(1, '11653', '07:30:00', '2015-03-04'),
(2, '11661', '15:20:00', '2015-03-04'),
(3, '11671', '08:40:00', '2015-02-09'),
(4, '11660', '10:30:00', '2015-03-04'),
(5, '11654', '15:10:00', '2015-02-19'),
(6, '11667', '18:30:00', '2015-03-03'),
(7, '11669', '15:24:00', '2015-03-03'),
(8, '11656', '20:50:00', '2015-02-14'),
(9, '11663', '16:40:00', '2015-02-09'),
(10, '11666', '22:35:00', '2015-01-31'),
(11, '11658', '08:25:00', '2015-06-13'),
(12, '11662', '13:15:00', '2015-01-21'),
(13, '11665', '11:38:00', '2015-04-19'),
(14, '11672', '10:55:00', '2015-01-05'),
(15, '11674', '09:30:00', '2015-01-14'),
(16, '11677', '14:20:00', '2015-03-02'),
(17, '11681', '07:45:00', '2015-02-08'),
(18, '11684', '18:45:00', '2015-01-25'),
(19, '11688', '11:00:00', '2015-02-28'),
(20, '11718', '15:45:00', '2015-02-03'),
(21, '11720', '17:36:00', '2015-01-08'),
(22, '11739', '08:23:00', '2015-02-14'),
(23, '11741', '13:39:00', '2015-03-02'),
(24, '11745', '16:32:00', '2015-01-23'),
(25, '11751', '10:54:00', '2015-01-02'),
(26, '11752', '12:13:00', '2015-03-03'),
(27, '11759', '07:21:00', '2015-01-24'),
(28, '11759', '12:49:00', '2015-02-16'),
(29, '11760', '14:10:00', '2015-02-18'),
(30, '11789', '14:16:00', '2015-03-03'),
(31, '11758', '23:29:13', '2015-03-09'),
(32, '11756', '23:32:33', '2015-03-12'),
(33, '11747', '23:34:26', '2015-03-12'),
(34, '11663', '23:35:17', '2015-03-09'),
(35, '11790', '13:04:26', '2015-03-11'),
(36, '11662', '21:27:17', '2015-03-13'),
(37, '11758', '15:34:29', '2015-03-14'),
(38, '11759', '16:19:37', '2015-03-17'),
(39, '11760', '16:32:55', '2015-03-17');
";
    $retval=mysql_query($query);
    if($retval)
        echo ' filled';
    else
        echo ' not filled';
echo '<br />';
}


$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';
$mysql_db = 'library_management';

$sql = 'CREATE DATABASE IF NOT EXISTS '.$mysql_db;

$conn = mysql_connect($mysql_host,$mysql_user,$mysql_pass);
$retval = mysql_query( $sql,$conn );

create_book();
create_user();
create_age();
create_qualification();
create_vendor();
create_vendor_contact();
create_reserve();
create_user_rid();
create_transaction();
create_fine();
create_authentication();


mysql_close($conn);

?>