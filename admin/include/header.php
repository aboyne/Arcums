<?php
echo "
	<div id='topbar'>
	<a href='$root/admin/playlist/index.php'><img src='$root/themes/$curtheme/admin_images/arcumsheader.png' width='203' height='58' border='0' /></a>
	</div>
	<div id='topbarmenuother' class='menu'>
	<table><tr><td>
";
$session_username = $_SESSION['username'];
$session_djid = $_SESSION['djid'];

//Get playlists for this DJ and shoe select form
$query = "SELECT DISTINCT datetime FROM playlist WHERE dj_id = '$session_djid' ORDER by datetime DESC";
$result = mysql_query($query) or die(mysql_error());
echo "<form action='$root/playlist/viewdate.php'><u>Past Playlists</u><br><select name='datelist'>";

while ($datelist = mysql_fetch_array($result)) {
    echo "<option value='$datelist[date]'>$datelist[date]</option>";
}

echo "</select><input type='hidden' name='anotherdj' value='$session_username'><input type=\"submit\" value=\"View\"></form>";
?></td><td>


<?php
//Show select for other DJs playlist
$query = "SELECT * FROM accounts ORDER by name ASC";
$result = mysql_query($query) or die(mysql_error());
echo "
	<form action='$root/playlist/selectdate.php' method='get'>
	<u>Other DJs Playlists</u>
	<br>
	<select name='anotherdj'>
";

while ($nt = mysql_fetch_array($result)) {
    echo "<option value=$nt[username]>$nt[name]</option>";
}
echo "</select> <input type=\"submit\" value=\"View\"></form>";
?>

&nbsp;&nbsp;&nbsp;<a href="<? echo $root; ?>/admin/playlist/index.php">Playlist</a> | <a href="<? echo $root; ?>/admin/profile/">My Profile</a>
| <a href="<? echo $root; ?>/admin/downloads/">Record Show</a> | <a href="<? echo $root; ?>/admin/blog/">Blog</a> | <a href="<? echo $root; ?>/admin/catalog/">Catalog</a>


</div></td></tr></table></div>
<br><br><br><br>

<?php
$get_info = mysql_query("SELECT * FROM accounts WHERE username = '$session_username' LIMIT 1");

    //PERMISSIONS
    //1=DJ
    //2=Genre Director
    //3=Staff
    //4=Administrator

if (mysql_num_rows($get_info) > 0) {
    $user_info = mysql_fetch_assoc($get_info);
    
    if ($user_info['permissions'] == '2') {
        echo '
		<table width="735" align="center">
		<tr><td class="headers" align="center">Genre Director Menu: &nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../charting/index.php">Arcums Charting </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../catalog/menu.php">Catalog Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../webcharting/index.php">WebCharting</a>&nbsp;&nbsp;&nbsp;&nbsp;
		</td></tr>
		</table>
	';
    }
    
    if ($user_info['permissions'] == '3') {
        echo '
		<table width="735" align="center">
		<tr><td class="headers" align="center">Staff Menu: &nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../profile/staff_edit.php">Staff Profile </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../charting/index.php">Arcums Charting </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../charting/tracker.php">CD Tracker </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../webcharting/index.php">WebCharting</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../catalog/menu.php">Catalog Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../events/index.php">Events</a>&nbsp;&nbsp;&nbsp;&nbsp;
		</td></tr>
		</table>
	';
    }
    
    if ($user_info['permissions'] == '4') {
        echo '
		<table width="735" align="center">
		<tr><td class="headers" align="center">Staff Menu: &nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../profile/staff_edit.php">Staff Profile </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../charting/index.php">Arcums Charting </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../charting/tracker.php">CD Tracker </a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../webcharting/index.php">WebCharting</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../catalog/menu.php">Catalog Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../events/index.php">Events</a>&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="../user_control.php">User Control</a>&nbsp;&nbsp;&nbsp;&nbsp;
		</td></tr>
		</table>
	';
    }
}
?>
