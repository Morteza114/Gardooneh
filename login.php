<!DOCTYPE html>
<html>
<?php
session_start();
?>

    <head>
        <link rel="stylesheet" type="text/css" href="style-safhe-gardooneh.css"/>
        <meta charset="UTf-8"/>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
        <script>

            function namayeshPeygham(matn)
            {

                    document.getElementById("kadrPeyghamKhata").style.top = "20px";
                    document.getElementById("kadrPeyghamKhata").innerHTML = "<p>"+matn+"</p>";
            }
            setTimeout(
                function()
                {
                    document.getElementById("kadrPeyghamKhata").style.top = "-80px";

                },3000);


        </script>

    </head>

    <body dir="rtl">
    <div id="kadrPeyghamKhata"></div>

    <?php

        /*دسترسی به دیتابیس */

        $serverName="localhost";
        $userName="root";
        $password="";
        $dbName="db_gardooneh";
        $con=new mysqli($serverName,$userName,$password,$dbName);
        if($con->connect_error)
        {
            die("مشکلی در ازتباط با دیتا بیس به وجود آمده است");
        }
        $con->set_charset("utf8");

        /*------------------------------------------------------------------------*/
        try
        {
            function barasiInput($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = filter_var($data, FILTER_SANITIZE_STRING);
                $data = htmlspecialchars($data);
                return $data;
            }
        /*بررسی فارسی بودن داده*/
            function farsiBoodan($data)
            {
                $HorofAlefbaFarsi = "ا ب پ ت س ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی";
                $tolReshte = mb_strlen($data);

                for ($i = 0; $i < $tolReshte; $i++)
                {
                    $harfEbarat = mb_substr($data, $i, 1);
                    $x = strpos($HorofAlefbaFarsi, $harfEbarat);
                    if ($x === false)
                    {
                        break;
                    }
                }

                if ($i == $tolReshte)
                {
                    return true;
                }
                else
                {
                    return false;
                }

            }
            /*بررسی عددی و یازده رقمی بودن عدد*/
            function addVaYazdahRaghamBoodan($data)
            {
                if (strlen($data) == "11" && is_numeric($data))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            function vojodDashtanShomarehTelephon($data)
            {
                global $con;
                $sql="select * from tbl_moshakhasat
                        where shomareHamrah=\"".$data."\"";
                $result=$con->query($sql);
                if($result!==false && $result->num_rows>0)
                {
                    return true;
                }
                else
                {
                        return false;
                }
            }


            if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST")
            {
                /*تایید اعتبار نام و نام خانوادگی*/
                if (!empty($_POST["namVaFamil"]))
                {
                    $namVaFamil = $_POST["namVaFamil"];
                    $namVaFamil = barasiInput($namVaFamil);
                    if (farsiBoodan($namVaFamil) == false)
                    {
                        $IN="NVFN";
                        $namVaFamil="";
                    }
                }
                else
                {
                    $IN="NVFKH";
                }

                /*تایید اعتبار شماره تلفن*/
                if (!empty($_POST["shomareHamrah"]))
                {
                    $shomareHamrah=$_POST["shomareHamrah"];
                    $shomareHamrah= barasiInput($shomareHamrah);

                    if(addVaYazdahRaghamBoodan($shomareHamrah) == false)
                    {
                        $IN="SHN";
                        $shomareHamrah="";
                    }

                    elseif(vojodDashtanShomarehTelephon($shomareHamrah)==true)
                    {
                        $IN="SHV";
                        $shomareHamrah="";
                    }

                    else
                    {
                        $IN="SHKH";
                    }


                }
                
                if(!empty($namVaFamil) && !empty($shomareHamrah))
                {
                  $sql=@"insert into tbl_moshakhasat(id,namVaFamil,shomareHamrah)
                         values(0,?,?)";
                  $stmt=$con->prepare($sql);
                  $stmt->bind_param("ss",$namVaFamil,$shomareHamrah);
                  if($stmt->execute()!==true)
                    {
                        die($stmt->error);
                    }
                  $stmt->close();
                  $con->close();
                  $_SESSION["namVaFamil"]=$namVaFamil;
                  $_SESSION["shomareHamrah"]=$shomareHamrah;
                  header("location:gardooneh.php");
                }

                if(isset($IN))
                {

                    if($IN=="NVFN")
                    {
                        throw new Exception("fild eshtebh");
                    }
                    elseif ($IN=="NVFKH")
                    {
                        throw new Exception("fild Khali");
                    }
                    elseif ($IN=="SHN")
                    {
                        throw new Exception("fild eshtebh");
                    }
                    elseif ($IN=="SHKH")
                    {
                        throw new Exception("fild Khali");
                    }
                    elseif ($IN=="SHV")
                    {
                        throw new Exception("fild VojodDarad");
                    }

                }
            }
        }
        catch (Exception $e)
        {
            $Payam=$e->getMessage();

            if(strpos($Payam,"Khali")!==false)
            {
                echo "<script type=\"text/javascript\">
   
                                    namayeshPeygham('فیلد های خالی را پر کنید');

                      </script>";
            }
            elseif (strpos($Payam,"eshtebh")!==false)
            {
                echo "<script type=\"text/javascript\">
    
                                    namayeshPeygham('فیلد وارده را اشتباه وارد کرده اید');

                      </script>";
            }
            elseif (strpos($Payam,"Vojod")!==false)
            {
                echo "<script type=\"text/javascript\">
    
                                    namayeshPeygham('فیلد وارده قبلا ثبت شده است');

                      </script>";
            }
        }
    ?>


        <div id="kadrAsli">
           <div id="kadrSabteNam">
                <h2 id="titrSabteNam">
                    ثبت اطلاعات
                </h2>
                <form action="login.php" method="post">
                    <div class="kadrInput">
                        <span class="titrInput"> نام و نام خانوادگی :</span><input type="text" maxlength="50" name="namVaFamil" placeholder="فارسی وارد کنید"  value="<?php if(!empty($namVaFamil)) echo $namVaFamil; ?>" />
                    </div>
                    <div class="kadrInput">
                        <span class="titrInput"> شماره همراه :</span><input type="text" maxlength="50" name="shomareHamrah" placeholder="نمونه:09301145118" value="<?php if(!empty($shomareHamrah)) echo $shomareHamrah; ?>" />
                    </div>
                    <div class="kadrInput">
                        <input type="submit" name="dokmeVorod" value="ورود"/>
                    </div>
                </form>


            </div>
        </div>



    </body>
</html>
