<?php
session_start();
$hostname="localhost";
$user="root";
$dbname="mconf";
mysql_connect($hostname,$user);
mysql_select_db($dbname);
$q="select * from groups order by id";
$groups= mysql_query($q);

if(isset($_GET['action'])){


if($_GET['action']=='RENAME GROUP'){
$q="update groups set name='".$_GET['newname']."' where id='".$_GET['group']."'";
mysql_query($q);
unset($_GET);
header ("Location:burn.php");
}


if($_GET['action']=='save'){
$q="update servers set name='".$_GET['name']."',address='".$_GET['address']."',port='".$_GET['port']."',use_node_name=1,groupid='".$_GET['group']."' where id='".$_GET['s_id']."'";
mysql_query($q);
unset($_GET);
header ("Location:burn.php");
}
if($_GET['action']=='NEW SERVER'){
$q="INSERT INTO `servers` ( `name` , `address` , `port` , `use_node_name` , `groupid` ) VALUES ( '".$_GET['name']."','".$_GET['address']."' , '".$_GET['port']."' , '1' , '".$_GET['group']."')";
mysql_query($q);                                                                                                                                                                                                                                                                                                             
unset($_GET);                                                                                                                                                                                                                                                                                                                
header ("Location:burn.php");
}
if($_GET['action']=='NEW GROUP'){
$q="INSERT INTO `groups` (`name`) VALUES ('".$_GET['grname']."')";
mysql_query($q);                                                                                                                                                                                                                                                                                                             
unset($_GET);                                                                                                                                                                                                                                                                                                                
header ("Location:index.php");
}

if($_GET['action']=='REMOVE GROUP'){
$q="delete FROM `groups` where id='".$_GET['group']."'";
mysql_query($q);                                                                                                                                                                                                                                                                                                             
unset($_GET);                                                                                                                                                                                                                                                                                                                
header ("Location:index.php");
}

if($_GET['action']=='remove'){
$q="delete FROM `servers` where id='".$_GET['s_id']."'";
mysql_query($q);                                                                                                                                                                                                                                                                                                             
unset($_GET);                                                                                                                                                                                                                                                                                                                
header ("Location:burn.php");
}

}


echo "<table border=0 bordercolor='c0c0c0'>";

while ( $grlist=mysql_fetch_assoc($groups)){
    $id=$grlist['id'];
    $list[$id]=$grlist['name']; 
    }
    
    foreach($list as $g_id => $g_name){
    
	echo "<tr><td><br></td></tr><tr><td colspan=2 bgcolor=gray>".$g_name."</td></tr>";
	echo "<tr align=center><td>group</td> <td>name</td> <td>address</td> <td>port</td> <td>use_node_name</td></tr>";
	$q="select * from servers where groupid=".$g_id." order by name";
	
	$servers=mysql_query($q);
while ($s=mysql_fetch_assoc($servers)) 
	    {
	    echo "<form action='index.php'><tr>
	    <input type=hidden name=s_id value=".$s['id']."><td><select name=group>";
		foreach ($list as $s_gr => $name){
		echo "<option ".($s_gr==$s['groupid']?'selected':'')." value=".$s_gr.">".$name."</option>";
		}
	    echo "</select></td>
	    <td><input type=text name=name size='40' value=".$s['name']."></td>
	    <td><input type=text name=address value=".$s['address']."></td>
	    <td><input type=text name=port size='6' value=".$s['port']."></td>
            <td><input type=text name=unn readonly  size='15' value=".($s['use_node_name']==1? "yes" : "no")."></td> 
	    <td><input name=action type=submit class=button value=save></td><td><input name=action type=submit class=button value=remove></tr>
	    </form>";
	    }
    
    }

echo "</table><br><br><br><br>";
echo "<table border=2 bordercolor='yellow' bgcolor='ba6039'"; 


	        echo "<tr><td colspan=6 bgcolor='cc8899'>NEW SERVER</td></tr>";                                                                                                                                                                                                                                                         
                echo "<tr align=center><td>group</td> <td>name</td> <td>address</td> <td>port</td> <td>use_node_name</td></tr>"; 

           echo "<form action='index.php'><tr>                                                                                                                                                                                                                                                                                                                                                                                                                                                      
		<td><select name=group>";                                                                                                                                                                                                                                                                             
                foreach ($list as $s_gr => $name){                                                                                                                                                                                                                                                                           
                echo "<option value=".$s_gr.">".$name."</option>";                                                                                                                                                                                                                  
                }                                                                                                                                                                                                                                                                                                            
        	echo "</select></td>                                                                                                                                                                                                                                                                                             
                <td><input type=text name=name></td>                                                                                                                                                                                                                                                        
                <td><input type=text name=address></td>                                                                                                                                                                                                                                                  
                <td><input type=text name=port value=4949></td>                                                                                                                                                                                                                                                        
                <td><input type=text name=unn readonly value=yes></td>                                                                                                                                                                                                                    
                <td><input name=action type=submit class=button value='NEW SERVER'></td></tr>                                                                                                                                                                                                                                            
                </form>";        
	
	
	echo "<tr><td colspan=6 bgcolor='cc8899'>GROUP ACTIONS</td></tr>"; 
	echo "<form action='index.php'>
	<td><input type=text name=grname></td>
	<td><input name=action type=submit class=button value='NEW GROUP'></td></tr><tr>
	<td><select name=group><option>select</option>"; 
	foreach ($list as $s_gr => $name){
	echo "<option value=".$s_gr.">".$name."</option>";
	}
	echo "</select></td><td><input name=action type=submit class=button value='REMOVE GROUP'></td>";	
	echo "</form><form action=index.php>";
	
	echo "</tr><tr><td><select name=group><option>select</option>"; 
	foreach ($list as $s_gr => $name){
	echo "<option value=".$s_gr.">".$name."</option>";
	}
	echo "</select></td><td><input name=newname type=text></td><td><input name=action type=submit class=button value='RENAME GROUP'></td>";	
	
	echo "</form>";




echo "<table>";
?>
