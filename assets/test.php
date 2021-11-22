<html>
    <head>
        <title>Register</title>
    </head>
    <body>
    <script>
        function show(){
            var option = document.getElementById("category").value;
            if(option == "Student")
                  {
                        document.getElementById("enroll1").style.display="block";
                  }
            if(option == "Parents")
                  {
                        document.getElementById("enroll1").style.display="none";
                  }
            if(option == "Guardians")
                  {
                        document.getElementById("enroll1").style.display="none";
                  }
        }
    </script>
            <form action="#" method="post">
                <table>
                    <tr>
                        <td><label>Name </label></td>
                        <td><input type="text" id="name" size=20 maxlength=20 value=""></td>
                    </tr>
                    <tr style="display:block;" id="enroll1">
                        <td><label>Enrollment No. </label></td>
                        <td><input type="number" id="enroll" style="display:block;" size=20 maxlength=12 value=""></td>
                    </tr>
                    <tr>
                        <td><label>Email </label></td>
                        <td><input type="email" id="emailadd" size=20 maxlength=25 value=""></td>
                    </tr>
                    <tr>
                        <td><label>Mobile No. </label></td>
                        <td><input type="number" id="mobile" size=20 maxlength=10 value=""></td>
                    </tr>
                    <tr>
                        <td><label>Address</label></td>
                        <td><textarea rows="2" cols="20"></textarea></td>
                    </tr>
                    <tr >
                        <td><label>Category</label></td>
                        <td><select id="category" onchange="show()">    <!--onchange show methos is call-->
                                <option value="Student">Student</option>
                                <option value="Parents">Parents</option>
                                <option value="Guardians">Guardians</option>
                            </select>
                        </td>
                    </tr>
                </table><br/>
            <input type="submit" value="Sign Up">
        </form>
    </body>
</html>