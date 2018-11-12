<HTML>
<HEAD>
<link rel="stylesheet" href="../../main.css">
<TITLE>PhishAPI</TITLE>
<link rel="apple-touch-icon" sizes="57x57" href="../../images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="../../images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="../../images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="../../images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="../../images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="../../images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="../../images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="../../images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="../../images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="../../images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="../../images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon/favicon-16x16.png">
<link rel="manifest" href="../../images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="../../images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
</HEAD>
<BODY>
<CENTER>
<?php

// Read Database Connection Variables
require_once '../../config.php';

$dbname = "phishingdocs";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>


<?php

// Show Credentails for the Selected Project
if(isset($_REQUEST['UUID'])){
$UUID = $_REQUEST['UUID'];

$UUID = filter_var($UUID, FILTER_SANITIZE_SPECIAL_CHARS);
$UUID = mysqli_real_escape_string($conn, $UUID);

$sql = "Call GetUUIDRecord('$UUID');";
$result = $conn->query($sql);

?>
    <h2><FONT COLOR="#FFFFFF">Received Requests</FONT></h2>
<TABLE BORDER=1><TR><TH>Date/Time</TH><TH>IP</TH><TH>Target</TH><TH>Org</TH><TH>Hash</TH><TH>UserAgent</TH><TH>User</TH><TH>Pass</TH></TR>
<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
//$pw = $row["pass"];
echo "<tr><td>".$row["Datetime"]."</td><td>".$row["IP"]."</td><td>".$row["Target"]."</td><td>".$row["Org"]."</td><td>".$row["NTLMv2"]."</td><td>".$row["UA"]."</td><td>".$row['User']."</td><td>".base64_decode($row['Pass'])."</td></tr>";
    }

printf($conn->error);



$conn->close();
}
?></TABLE>
</CENTER>
</BODY>
</HTML>
