<?php
include './adminheader.php';
if(!isset($_POST['submit1'])) {
?>
        <form name="f" action="adminhome.php" method="post" onsubmit="return check()">
            <table class="center_tab" style="float:left;">
                <thead>
                    <tr>
                        <th colspan="4">DOCTOR CREATION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><input type="text" name="name" required autofocus></td>
                        <th>Qualification</th>
                        <td><!--input type="text" name="qual" required-->
		<select name="qual">
		<option value="MBBS">MBBS</option>
		<option value="MS">MS</option>
		<option value="BDS">BDS</option>
        <option value="BHMS">BHMS</option>
		</select>
		</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>
                            <input type="radio" name="gender" value="Male" checked>Male
                            <input type="radio" name="gender" value="Female">Female
                        </td>
                        <th>Specialized In</th>
                        <td><!--input type="text" name="special" required-->
		<select name="special">
		<option value="General">General</option>
		<option value="Ortho">Ortho</option>
		<option value="Neuro">Neuro</option>	
		<option value="Gyneacology">Gyneacology</option>
		<option value="Physiology">Physiology</option>
		<option value="Hepatologist">Hepatologist</option>
		<option value="Brain">Brain</option>
		
		</select>
		</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><textarea name="addr" required></textarea></td>
                        <th>Certificate No.</th>
                        <td><input type="text" name="certno" required></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td><input type="text" name="city" required></td>
                        <th>Experience (Years)</th>
                        <td><input type="text" name="expr" pattern="\d+" required></td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td><input type="text" name="mobile" required maxlength="10"></td>
                        <th>DOB</th>
                        <td><input type="date" name="dob" required></td>
                    </tr>
                    <tr>
                        <th>EMail (Userid)</th>
                        <td><input type="text" name="email" required></td>
                        <th></th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <td><input type="password" name="pwd" required></td>
                        <th></th>
                        <td></td>
                    </tr>                    
                    <tr>
                        <th>Confirm Pwd</th>
                        <td><input type="password" name="cpwd" required></td>
                        <th></th>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="center">
                            <input type="submit" name="submit1" value="Create">
                        </td>
                    </tr>
                </tfoot>
            </table>
<div style="float:right;"><img src="img/im2.jpg" style="width:400px;"></div>
        </form>

<?php
} else {
    extract($_POST);
    mysqli_query($link, "insert into newdoctor(name,gender,addr,city,mobile,userid,pwd,qual,special,certno,expr,dob) values('$name','$gender','$addr','$city','$mobile','$email','$pwd','$qual','$special','$certno','$expr','$dob')");
    echo "<div class='center'>Doctor Id Created Successfully...!<br><a href='adminhome.php'>Back</a></div>";
}
?>
<script>
    function check() {
        var m = f.mobile.value
        var e = f.email.value
        var pw = f.pwd.value
        var cp = f.cpwd.value
        
        var mp = /^[9876]\d{9}$/
        var ep = /^\w+\.{0,1}\w+\@\w+\.([a-z]{3}|[a-z]{2}\.[a-z]{2}){1}$/
        
        if(!m.match(mp)) {
            alert("Invalid Mobile Number")
            f.mobile.focus()
            return false
        }
        if(!e.match(ep)) {
            alert("Invalid EMail Id")
            f.email.focus()
            return false
        }
        if(pw!=cp) {
            alert("Confirm Password not Match")
            f.cpwd.focus()
            return false
        }
        return true
    }
</script>
<?php
include './footer.php';
?>