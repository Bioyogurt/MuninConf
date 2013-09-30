<?php
session_start();
$hostname="localhost";
$user="root";
$dbname="munin";
mysql_connect($hostname,$user);
mysql_select_db($dbname);
$q="select * from groups";
$groups= mysql_query($q);
echo "<table border=1 bordercolor=black action='authorise.php'>";



while ($lgr=mysql_fetch_assoc($groups))
{
	$q="select * from servers where groupid=".$lgr['id'];
	$servers=mysql_query($q);
	    while ($s=mysql_fetch_assoc($servers)) 
	    {
	    echo"<form action='index.php'><tr>
	    <input type=hidden name=id value=".$s['id'].">
	    <td><input type=text value=".$lgr['name']."></td>
	    <td><input type=text value=".$s['name']."></td>
	    <td><input type=text name=address value=".$s['address']."></td>
	    <td><input type=text name=port value=".$s['port']."></td>
	    <td>".($s['use_node_name']==1? "yes" : "no")."</td>
	    <td><input name=button type=submit class=button value=submit></td></tr>
	    </form>";
	    }
}
echo "<table>";
?>
