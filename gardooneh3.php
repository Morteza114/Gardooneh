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


                    function bastan()
                    {
                        document.getElementById("kadrDavat").style.display="none";
                        document.getElementById("kadrDavat").style.transform="scale(0,0)";
                        document.getElementById("kadrDavat").style.opacity="0";
                    }

                    function gardeshGardooneh()
                    {
/*با احتمال نا برابر*/
                        /*x=0;
                        y=0;
                        z=0;
                        b=0;
                        a=0;
                        darageh=(0 + Math.floor(Math.random() * 5))*60;

                        while(true)
                        {
                            if(darageh==60 && x==5)
                            {
                                document.getElementById('aksGardooneh').style.transform='rotate('+ (darageh+3600) +'deg)';
                                break;
                            }
                            else if(darageh==60)
                            {
                                darageh=(0 + Math.floor(Math.random() * 5))*60;
                                x++;
                                continue;
                            }
                            else if (darageh==120 && y==4)
                            {
                                document.getElementById('aksGardooneh').style.transform='rotate('+ (darageh+3600) +'deg)';
                                break;
                            }
                            else if (darageh==120)
                            {
                                darageh=(0 + Math.floor(Math.random() * 5))*60;
                                y++;
                                continue;
                            }
                            else if (darageh==180 && z==3)
                            {
                                document.getElementById('aksGardooneh').style.transform='rotate('+ (darageh+3600) +'deg)';
                                break;
                            }
                            else if (darageh==180)
                            {
                                darageh=(0 + Math.floor(Math.random() * 5))*60;
                                z++;
                                continue;
                            }
                            else if (darageh==240 && b==2)
                            {
                                document.getElementById('aksGardooneh').style.transform='rotate('+(darageh+3600)+'deg)';
                                break;
                            }
                            else if (darageh==240)
                            {
                                darageh=(0 + Math.floor(Math.random() * 5))*60;
                                b++;
                                continue;
                            }
                            else if (darageh==300 && a==1)
                            {
                                document.getElementById('aksGardooneh').style.transform='rotate('+(darageh+3600)+'deg)';
                                break;
                            }
                            else if (darageh==300)
                            {
                                darageh=(0 + Math.floor(Math.random() * 5))*60;
                                a++;
                                continue;
                            }
                            else if (darageh==0)
                            {
                                document.getElementById('aksGardooneh').style.transform='rotate('+ (3600)+'deg)';
                                break;
                            }
                        }*/
/*با احتمال برابر*/
                        darageh=(0 + Math.floor(Math.random() * 6))*60;
                        document.getElementById('aksGardooneh').style.transform='rotate('+(darageh+3600)+'deg)';
                        document.getElementById("kadrDavat").style.display="block";

                        setTimeout(function()
                        {
                            document.getElementById("kadrDavat").style.transform="scale(1,1)";
                            document.getElementById("kadrDavat").style.opacity="1";
                            document.getElementById('aksGardooneh').style.transform='rotate('+ 0 +'deg)';
                            switch (darageh)
                            {
                                case 0: document.getElementById("ghazaeBarande").innerHTML="بستنی قیفی"; break;
                                case 300: document.getElementById("ghazaeBarande").innerHTML="ساندویچ خوراک"; break;
                                case 240: document.getElementById("ghazaeBarande").innerHTML="پاچین کبابی"; break;
                                case 180: document.getElementById("ghazaeBarande").innerHTML="پیتزا"; break;
                                case 120: document.getElementById("ghazaeBarande").innerHTML="بعلبکی"; break;
                                default : document.getElementById("ghazaeBarande").innerHTML="سدورس"; break;
                            }
                        },6000);

                    }

                    function namayeshPeyghamAdamGardeshGardooneh()
                    {
                        document.getElementById("kadrDavat").style.display="block";
                        setTimeout(function()
                        {
                            document.getElementById("kadrDavat").style.transform="scale(1,1)";
                            document.getElementById("kadrDavat").style.opacity="1";
                            document.getElementById("ghazaeBarande").innerHTML="شانس شما به اتمام رسیده است";

                        },2000);
                    }
        </script>

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


               <a onclick="gardeshGardooneh()" href="gardooneh.php" id="dokmeh"> چرخاندن </a>

            </div>
        </div>

        <div id="kadrDavat" >

            <a id="dokmeBastan" href="#" onclick="bastan();"></a>

            <h1 id="titr">شما دعوت شده اید!!</h1>

            <p id="ghazaeBarande"></p>

        </div>



    </body>
</html>
