<!DOCTYPE html>
<html>

<?php
session_start();
?>

    <head>
        <link rel="stylesheet" type="text/css" href="style-safhe-gardooneh.css"/>
        <meta charset="UTf-8"/>
        <meta http-equiv="content-type" content="text/html;charset=utf-8"/>


    </head>

    <body dir="rtl">



        <div id="kadrAsli">
            <?php
                if(isset($_SESSION["namVaFamil"]))
                {
                    echo "<div id=\"kadrOzviat\">".$_SESSION["namVaFamil"]."<a id='khorooj' href=\"khoroj.php\"></a></div>";
                }

                else
                {
                    echo "<div id=\"kadrOzviat\"><a href=\"Login.php\" id=\"ozviat\"> ورود </a></div>";
                }
            ?>

           <div id="kadrGardooneh">
                <h2 id="titrGardooneh">
                    گردونه شانس !!
                </h2>
                <div id="gardooneh">
                    <img src="gardooneh.png" id="aksGardooneh" style="transition:all 3s ease 0.4s"/>
                </div>


               <a onclick="gardeshGardooneh()" href="javascript:void(0)" id="dokmeh"> چرخاندن </a>

            </div>
        </div>

        <div id="kadrDavat" >

            <a id="dokmeBastan" href="#" onclick="bastan();"></a>

            <h1 id="titr">شما دعوت شده اید!!</h1>

            <p id="jayezahBarande"></p>

        </div>
<?php if(isset($_SESSION["namVaFamil"]))
{
   echo @"<script type=\"text/javascript\">

            function bastan()
            {
                document.getElementById(\"kadrDavat\").style.display=\"none\";
                document.getElementById(\"kadrDavat\").style.transform=\"scale(0,0)\";
                document.getElementById(\"kadrDavat\").style.opacity=\"0\";
            }

            function gardeshGardooneh()
            {
                    var xhttp= new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200)
                    {
                        raftVaBarGasht=true;
                        var arrEtelat=JSON.parse(this.responseText);

                            document.getElementById('aksGardooneh').style.transform = 'rotate(' + (arrEtelat[0][\"darajeGardoone_ID\"] * 60 + 1800) + 'deg)';
                            document.getElementById(\"kadrDavat\").style.display = \"block\";
                            setTimeout(function ()
                            {
                                document.getElementById(\"kadrDavat\").style.transform = \"scale(1,1)\";
                                document.getElementById(\"kadrDavat\").style.opacity = \"1\";
                                document.getElementById('aksGardooneh').style.transform = 'rotate(' + 0 + 'deg)';
                                document.getElementById(\"jayezahBarande\").innerHTML = arrEtelat[0][\"jayezeh\"];

                            }, 6000);

                    }
                    else if(raftVaBarGasht==true)
                    {
                        document.getElementById(\"kadrDavat\").style.display=\"block\";
                        setTimeout(function()
                        {
                            document.getElementById(\"kadrDavat\").style.transform=\"scale(1,1)\";
                            document.getElementById(\"kadrDavat\").style.opacity=\"1\";
                            document.getElementById(\"jayezahBarande\").innerHTML=\"باتشکر\";
                            document.getElementById(\"titr\").innerHTML=\"نوبت شما به اتمام رسیده است\";

                        },200);
                    }
                };
                xhttp.open(\"POST\", \"requestAjax.php\", true);
                xhttp.setRequestHeader(\"Content-type\", \"application/x-www-form-urlencoded\");
                xhttp.send();
            }

        </script>" ;
}
else
{
    echo @"<script type=\"text/javascript\">
            document.getElementById(\"dokmeh\").href=\"login.php\";
        </script>";
}
?>


    </body>
</html>
