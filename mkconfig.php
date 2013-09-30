<?php
session_start();
$hostname="localhost";
$user="root";
$dbname="mconf";
mysql_connect($hostname,$user);
mysql_select_db($dbname);
$q="select * from groups";
$groups= mysql_query($q);

echo "
includedir /etc/munin/conf.d
graph_strategy cron
cgiurl_graph /munin-cgi/munin-cgi-graph
html_strategy cron

";

while ($lgr=mysql_fetch_assoc($groups))
{
	$q="select * from servers where groupid=".$lgr['id'];
	$servers=mysql_query($q);
	    while ($s=mysql_fetch_assoc($servers)) 
	    {
		echo "[".$lgr['name'].";".$s['name']."]\n  address ".$s['address']."\n  port ".$s['port']."\n  use_node_name ".($s['use_node_name']==1? "yes" : "no")."\n\n";
	    }
}
?>
