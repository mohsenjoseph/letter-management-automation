<?php
if(isset($_POST['cfnd'])){
    require('/home/bbholding/public_html/desk/app/core/Config.php');
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    if(!$con) echo "error Connect DB";
    else{
        mysqli_query($con, 'SET NAMES utf8mb4');
        $result = mysqli_query($con, "select * from tbl_user where apiKey ='".$_POST['cfnd']."' limit 1");
        $row = mysqli_fetch_array($result);
        if(isset($row['id'])){
            $send_userID = $row['id']; 
            $input = 1; //نوع نامه
            $dabirId = 1; //کد دبیرخانه
            $print_size = 2; // 1:a5 2:a4
            $subject = "درخواست نمایندگی ".$_POST['brand']; // عنوان نامه
            $text = "تلفن همراه: ".$_POST['mobile']."<br>شهر/استان: ".$_POST['city']."<br>میزان سرمایه: ".$_POST['amount']."<br>توضیحات درخواست: ".$_POST['description']; // متن نامه
            $description = $_POST['fullname']; //نام و نام خانوادگی - فرستنده نامه
            $status = 2 ;//وضعیت - nameh vardeh 2
            $date_create = time(); //تاریخ ایجاد
            $date_signature = time(); //تاریخ امضا
            $archive = 0; // وضعیت بایگانی نامه برای ایجاد کننده
            $levelId_create = 6; //کد پست کاربر کننده
            $levelId_signature = 2;//کد پست کاربر امضا کننده
            $levelId_Recive = "6";//کد پست سازمانی کاربران دریافت کننده
            $levelId_Cc = ""; // کد پست سازمانی کاربران گیرنده رونوشت
            $file = 0;//وضعیت پیوست فایل
            $date_save = time(); //زمان ذخیره شدن نامه
            $date_numLetter = time();//زمان ثبت شماره نامه
            $numLetter = "req".date("YmdHi",time()).rand(1,1000); // شماره نامه
            $date_number_input = date("Y/m/d"); //شماره و تاریخ نامه جهت ثبت نامه به عنوان نامه وارده
            $sql = "INSERT INTO tbl_letter(input,dabirId,print_size,subject,text,description,status,date_create,date_signature,archive,levelId_create,
                                levelId_signature,levelId_Recive,levelId_Cc,file,date_save,date_number_input,date_numLetter,numLetter) 
                        values ($input,$dabirId,$print_size,'$subject','$text','$description',$status,$date_create,$date_signature,$archive,$levelId_create,
                                $levelId_signature,'$levelId_Recive','$levelId_Cc',$file,'$date_save','$date_number_input','$date_numLetter','$numLetter')";
            $result = mysqli_query($con, $sql); 
            if($result){
                echo "<center>درخواست شما با موفقیت ثبت شد";
                echo "<br>"."کد پیگیری: ".$numLetter;
                echo "<br>"."تاریخ: ".date("Y/m/d H:i",$date_numLetter);
                echo "</center>";
                $result = mysqli_query($con, "select * from tbl_letter where numLetter ='".$numLetter."' limit 1");
                $row = mysqli_fetch_array($result);
                if(isset($row['id'])){
                    $letterId = $row['id'];        
                    $forwardLevelId = 9 ; // کد پست کاربر دبیرخانه
                    $recive_status = 2 ;
                    $date_send = time();
                    $sql = "INSERT INTO tbl_letter_recive(`letterId`, `levelId`, `forwardLevelId`, `recive_status`, `date_send`) 
                        values ($letterId,$levelId_Recive,$forwardLevelId,$recive_status,'$date_send')";
                    $result = mysqli_query($con, $sql);
                }
            }
            else{
                echo "ثبت درخواست با مشکل مواجه شد";
            }
    
        }
    
    }
}
?>