<?php
include './doctorheader.php';
if(!isset($_POST['submit1'])) {
?>
        <form name="f" action="docreport.php" method="post">
            <table class="center_tab" style="float:left;">
                <thead>
                    <tr>
                        <th colspan="4">PATIENT REPORT</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>From Date</th>
                        <td><input type="date" name="fdt" required autofocus></td>
                    </tr>
                    <tr>
                        <th>To Date</th>
                        <td><input type="date" name="tdt" required></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="center">
                            <input type="submit" name="submit1" value="Show">
                        </td>
                    </tr>
                </tfoot>
            </table>
<div style="float:right;"><img src="img/im4.jpg" style="width:400px;"></div>
        </form>
<?php
} else {
include './aes.class.php';
    include './aesctr.class.php';
    extract($_POST);
	$fdtt = strtotime($fdt);
	$tdtt = strtotime($tdt);
	$result = mysqli_query($link, "select name,gender,addr,city,mobile,n.userid,skey,dt from newpatient n,prescrip p where n.userid=p.userid and n.doctorid='$_SESSION[doctorid]' and n.accept='accept'") or die(mysqli_error($link));
echo "<table class='report_tab' style='float:none;margin:auto;min-width:700px;'><thead><tr><th colspan='7'>PATIENT LIST<tr><th>Name<th>Gender<th>Address<th>City<th>Mobile<th>Email<th>Date</thead><tbody>";
	while($row = mysqli_fetch_row($result)) {
	echo "<tr>";
	foreach($row as $k=>$r) {
	$dt1 = AesCtr::decrypt($row[7],AesCtr::decrypt($row[6],'abc',256),256);
	if(strtotime($dt1)>=$fdtt && strtotime($dt1)<=$tdtt) {
	if($k!=5 && $k!=6)
	$x = AesCtr::decrypt($r,AesCtr::decrypt($row[6],'abc',256),256);
	else if($k!=6)
	$x=$r;
	if($k!=6)
	echo "<td>$x";
	}
	}
//	echo "<tr><td>$row[0]<td>$row[1]<td>$row[2]<td>$row[3]<td>$row[4]<td>$row[5]<td>$row[6]<td>$row[7]";
	}
echo "</tbody></table>";
    echo "<div class='center'><br><br><a href='docreport.php'>Back</a></div>";
}
include './footer.php';
?>