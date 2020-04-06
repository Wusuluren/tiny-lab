<?php session_start(); ?>
<?php
include("./inc.php");

$username="";
$password="";
$website="";
$action="";
foreach ($_REQUEST as $key => $value) {
    $$key = $value;
}
$actions=array("login"=>1,"logout"=>1,"website"=>1,""=>1);
if (!array_key_exists($action,$actions)) {
    include($error404_page);
    return;
}

$con = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
if (!$con) {
    die(mysqli_error($con));
}

if (isset($_SESSION['username'])) {
    echo('<form>
<input type="hidden" name="action" value="logout">
<input type="submit" value="Logout">
</form>');
    $username=$_SESSION['username'];
    $password=$_SESSION['password'];
} else {
    echo('<form>
username: <input type="text" name="username"><br>
password: <input type="text" name="password"><br>
<input type="hidden" name="action" value="login">
<input type="submit" value="Submit">
</form>');
}

if ($action == "login") {
    assert($password);
    $sql="select * from admin where username='".$username."' and password='".$password."'";
    $result = mysqli_query($con,$sql);
    if($result->num_rows==0) {
        die("not found ".$username);
    }
    $_SESSION['username']=$username;
    $_SESSION['password']=$password;
    echo "<script language=JavaScript> location.replace(location.origin);</script>";
    return;
} else if ($action == "website") {
    $sql="update admin set website='".$website."' where username='".$_SESSION['username']."'";
    $result = mysqli_query($con,$sql);
    echo "<script language=JavaScript> location.replace(location.origin);</script>";
    return;
} else if ($action == "logout") {
    session_destroy();
    echo "<script language=JavaScript> location.replace(location.origin);</script>";
    return;
}

$sql="select * from admin where username='".$username."' and password='".$password."'";
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)) {
    echo("welcome <a href='".$row['website']."'>".$row['username']."</a>");
    echo('<form>
website: <input type="text" name="website"><br>
<input type="submit" value="Modify"><br>
<input type="hidden" name="action" value="website">
</form>');
    echo("<br>");
}

mysqli_close($con);
?>