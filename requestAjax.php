<?php
session_start();
?>
<?php
/*دسترسی به دیتابیس*/

    $serverName="localhost";
    $userName="root";
    $password="";
    $dbName="db_gardooneh";
    $con=new mysqli($serverName,$userName,$password,$dbName);
    if($con->connect_error)
    {
        die("مشکل ارتباط با دیتابیس");
    }
    $con->set_charset("utf8");

/*---------------------------------------------------------*/


    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_SESSION["shomareHamrah"]))
    {

        $sql=@"select * from tbl_moshakhasat
                   where shomareHamrah=".$_SESSION["shomareHamrah"]."";
        $result=$con->query($sql);
        if($result!==false && $result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                echo $row["darajeGardoone_ID"];
                $nobatGardandanDarad=$row["darajeGardoone_ID"];
                break;
            }
        }

        if($nobatGardandanDarad===null)
        {
            $daragehCharkhesh=mt_rand(1,6);

            $sql=@"update tbl_moshakhasat
            set darajeGardoone_ID = \"". $daragehCharkhesh . "\"
            where shomareHamrah=".$_SESSION["shomareHamrah"]."";
            if ($con->query($sql) !== true)
            {
                echo $con->error;
            }



            $sql=@"select * from tbl_moshakhasat
                   inner join tbl_javayez on tbl_moshakhasat.darajeGardoone_ID = tbl_javayez.id
                   where shomareHamrah=".$_SESSION["shomareHamrah"]."";
            $result=$con->query($sql);
            if($result!==false && $result->num_rows>0)
            {
                $i=0;
                while($row=$result->fetch_assoc())
                {
                    $arrEtelateGardooneh[$i]=$row;
                }
            }

            echo json_encode($arrEtelateGardooneh);
        }
    }
$con->close();
?>
