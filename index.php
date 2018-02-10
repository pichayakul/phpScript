<!DOCTYPE html>
<html>
<head>
    <link href="css.css" rel="stylesheet" type="text/css" />
    <script src="jquery-3.3.1.min.js" charset="utf-8"></script>
</head>
<body style="background-image:url('bg.jpg');margin-top:50px">
        <center>
        <div class="main" style="background-color:white">
         <div class="head">
            Select the option on Drop down menu
        </div>
        <div class="dropdown">
            <button class="dropbutton">
                Menu
            </button>
            <div class="dropdown-content">
                <div class="choice" id="BMI">
                    Calculate Your Body Mass Index(BMI)
                </div>
                <div class="choice" id="BMR">
                    Calculate Your Basal Metabolic Rate (BMR)
                </div>
                <div class="choice" id="cal">
                    Calculate Your cholesterol
                </div>
            </div>
        </div>
        <div id="name"></div>
        <div id="bmi" class="bmi">
        <form action="" method='post'>
        Your Height (centimeters) : <input type='text' name='hBMI'><br>
        <div style='margin-left:10px'>
            Your Weight (kilograms) : <input type='text' name='wBMI'>
        </div>
        <br>
        <input type="hidden" name="type" value="bmi">
        <input type='submit' name='submit' class="submit" value='Calculate'>
        <br>
        </form>
        </div>

        <div id="bmr" class="bmr">
        <form action="" method='post'>
            Your Gender <input type="radio" name='gender' value="male" checked>Male
            <input type="radio" name='gender' value="female">Female<br>
        Your Height (centimeters) : <input type='text' name='hBMR'><br>
        <div style='margin-left:10px'>
            Your Weight (kilograms) : <input type='text' name='wBMR'>
        </div>
        Your age : <input type='text' name='ageBMR'>
        <br>
        Frequently Activity :  
        <select id="select" name="day">
            <option value="0">Never</option>
            <option value="1">1 - 3 days</option>
            <option value="2">3 - 5 days</option>
            <option value="3">6 - 7 days</option>
            <option value="4">Every days</option>
        </select><br>
        <input type="hidden" name="type" value="bmr">
        <input type='submit' name='submit' style="margin-top:20px" class="submit" value='Calculate'>
        <br>
        </form>
        </div>
        <div id="cal" class="cal">
        <form action="" method='post'>
        Your LDL (low-density lipoprotein)(mg/dl) : <input type='text' name='LDL'><br>
        <div style='margin-left:-7px'>
            Your HDL (high-density lipoprotein)(mg/dl) : <input type='text' name='HDL'>
        </div>
        Your triglycerides (mg/dl) : <input type='text' name='tri'>
        <br>
        <input type="hidden" name="type" value="cal">
        <input type='submit' name='submit' style="margin-top:20px" class="submit" value='Calculate'>
        <br>
        </form>
        </div>
        <div id="result"></div>
        <script>
        var ans = <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                if ($_POST["type"]=="bmi"){
                    if (empty($_POST['wBMI']) || empty($_POST['hBMI'])){
                        echo "-99";
                    }
                    else if (!is_numeric($_POST['wBMI']) && !is_numeric($_POST['hBMI'])){
                        echo "-99";
                    }
                    else{
                    
                        $n = ($_POST['wBMI'] / ($_POST['hBMI']**2))*10000;
                        $ans = '%.2f';
                        echo sprintf($ans,$n);
                    }
                }
                else if ($_POST["type"]=="bmr"){
                    if (empty($_POST['wBMR']) || empty($_POST['hBMR']) || empty($_POST['ageBMR'])){
                        echo "-99";
                    }
                    else if (!is_numeric($_POST['wBMR']) && !is_numeric($_POST['hBMR']) && !is_numeric($_POST['ageBMR'])){
                        echo "-99";
                    }
                    else{
                    if ($_POST['gender']=="male"){
                        $ans=66+(13.7*$_POST['wBMR'])+(5*$_POST['hBMR'])-(6.8*$_POST['ageBMR']);
                        
                    }
                    else{
                        $ans=665+(9.6*$_POST['wBMR'])+(1.8*$_POST['hBMR'])-(4.7*$_POST['ageBMR']);
                        
                    }
                    // $BMR=$ans;
                    // if ($_POST['day']==0){
                    //     $ans=$ans*1.2;
                    // }
                    // if ($_POST['day']==1){
                    //     $ans=$ans*1.375;
                    // }
                    // if ($_POST['day']==2){
                    //     $ans=$ans*1.55;
                    // }
                    // if ($_POST['day']==3){
                    //     $ans=$ans*1.725;
                    // }
                    // if ($_POST['day']==4){
                    //     $ans=$ans*1.9;
                    // }
                    $ans = sprintf('%d',ceil($ans));
                    echo "$ans";
                    }

                }
                else if ($_POST["type"]=='cal'){
                    if (empty($_POST['LDL']) || empty($_POST['HDL']) || empty($_POST['tri'])){
                        echo "-99";
                    }
                    else if (!is_numeric($_POST['LDL']) && !is_numeric($_POST['HDL']) && !is_numeric($_POST['tri'])){
                        echo "-99";
                    }
                    else{
                        $ans = $_POST['LDL']+$_POST['HDL']+($_POST['tri']/5);
                    $ans = sprintf('%d',$ans);
                    echo "$ans";
                    }
                }
            }
            else{
                echo "-1";
            }
                ?>;
        var type = <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $a = $_POST['type'];
                echo "'$a'";
                ;
                }
                else{
                    echo "-1";
                }
                ?>;
        if (ans>=0 && type=='bmi'){
        $("#result").html("<div style='font-size:30px'>Your BMI : "+ans+"</div><div><ul><h3>สูตรคำนวณ BMI</h3>BMI = น้ำหนักตัว / ความสูง ยกกำลังสอง<h3>เปรียบเทียบค่า BMI</h3><div style='text-align:left'><li>40 หรือมากกว่านี้ : โรคอ้วนขั้นสูงสุด<li>35.0 - 39.9: โรคอ้วนระดับ2 คุณเสี่ยงต่อการเกิดโรคที่มากับความอ้วน หากคุณมีเส้นรอบเอวมากกว่าเกณฑ์ปกติคุณจะเสี่ยงต่อการเกิดโรคสูง คุณต้องควบคุมอาหาร และออกกำลังกายอย่างจริงจัง<li>28.5 - 34.9: โรคอ้วนระดับ1 และหากคุณมีเส้นรอบเอวมากกว่า 90 ซม.(ชาย) 80 ซม.(หญิง) คุณจะมีโอกาศเกิดโรคความดัน เบาหวานสูง จำเป็นต้องควบคุมอาหาร และออกกำลังกาย<li>23.5 - 28.4: น้ำหนักเกิน หากคุณมีกรรมพันธ์เป็นโรคเบาหวานหรือไขมันในเลือดสูงต้องพยายามลดน้ำหนักให้ดัชนีมวลกายต่ำกว่า 23<li>18.5 - 23.4: น้ำหนักปกติ และมีปริมาณไขมันอยู่ในเกณฑ์ปกติ มักจะไม่ค่อยมีโรคร้าย อุบัติการณ์ของโรคเบาหวาน ความดันโลหิตสูงต่ำกว่าผู้ที่อ้วนกว่านี้<li>น้อยกว่า 18.5: น้ำหนักน้อยเกินไป ซึ่งอาจจะเกิดจากนักกีฬาที่ออกกำลังกายมาก และได้รับสารอาหารไม่เพียงพอ วิธีแก้ไขต้องรับประทานอาหารที่มีคุณภาพ และมีปริมาณพลังงานเพียงพอ และออกกำลังกายอย่างเหมาะสม</div></ul></div>");
        }
        if (ans>=0 && type=='bmr'){
        $("#result").html("<div style='font-size:30px'>Your BMR : "+ans+"</div><div><h3>วิธีคำนวณการเผาผลาญพลังงาน Basal Metabolic Rate(BMR)</h3><ul style='margin-left:50px';><div style='text-align:left'><li>สำหรับผู้ชาย : BMR = 66+(13.7xน้ำหนักตัวเป็น กก.)+(5xส่วนสูงเป็น ชม.)-(6.8xอายุ)</li><li>สำหรับผู้ชาย : BMR = 665+(9.6xน้ำหนักตัวเป็น กก.)+(1.8xส่วนสูงเป็น ชม.)-(4.7xอายุ)</div></li>");
        }
        if (ans>=0 && type=='cal'){
        $("#result").html("<div style='font-size:30px'>Your Cholesterol : "+ans+"</div><div><h3>วิธีคำนวณ</h3> ไขมัน LDL + ไขมัน HDL + ไขมัน Triglycerides/5 = Total Cholesterol<br><ul style='width:300px;'><h3>เปรียบเทียบค่า Cholesterol</h3><div style='text-align:left'><li>ดีมาก - ต่ำกว่า 200 mg/dl</li><li>ค่อนข้างสูง - 200 ถึง 239 mg/dl</li><li>สูง - มากกว่า 240 หรือเท่ากับ 240 mg/dl</li></div></ul>");
        }
        if (ans==-99){
            $('#result').html('<h2>-Wrong Input-</h2>');
        }
        </script>
</div>

<script>
    $(".dropdown-content").hover(function(){
        $(".choice").css('display','block');
    });
    $(".choice").click(function(){
        $("#name").html($(this).html())
        $(".choice").css('display','none');
        $(".bmi").css("display","none");
        $(".bmr").css("display","none");
        $(".cal").css('display','none');
        $('#result').css('display','none');
        if ($(this).attr('id')=="BMI"){
            $(".bmi").css("display","block");
        }
        if ($(this).attr('id')=="BMR"){
            $(".bmr").css('display','block');
        }
        if ($(this).attr('id')=="cal"){
            $(".cal").css('display','block');
        }
    })
</script>
</div>
</center>
</body>
</html>