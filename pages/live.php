<!DOCTYPE html>
<html>
    <head>
        <title>Fitness App | Workout In Progress</title>

        <!---===============  FOR STYLSHEETS  =======================-->
        <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
        <link rel="stylesheet" type="text/css" href="../stylesheets/exercise.css">

        <!---=============== FOR SETTING THE SCALE =======================-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!---=============== FOR APEXCHARTS LIBRARY =======================-->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!---==================== FOR JQUERY ===============================================-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <div id="navbar">
            <h2 id="navbar-title">Fitness App</h2>
            <a href="../index.html" class="navbar-link-text">
                <h4>Home</h4>
            </a>
            <a href="exercise.html" class="navbar-link-text">
                <h4>Exercise</h4>
            </a>
        </div>
        <div id='bumper'></div>
        <p id='coord'></p>
        <?php 
            $trans = $_POST['transport'];
            $focus = $_POST['focus'];

            if ( $trans == "buttonTop1" ) {
                $transEng = "running";
            }
            elseif ( $trans == "buttonTop2" ) {
                $transEng = "cycling";
            }
            else {
                $transEng = "walking";
            }

            if ( $focus == "buttonBottom1" ) {
                $focusEng = "distance";
            }
            elseif ( $focus == "buttonBottom2" ) {
                $focusEng = "time";
            }
            else {
                $focusEng = "speed";
            }

            $folderNum = shell_exec('../foldermaker.sh');
            $folderNum = preg_replace('/\s+/', '', $folderNum);

            $folderName = "../loc-data/" . "$folderNum" . "_" . "$transEng" . "_" . "$focusEng";
            mkdir($folderName);
            $newFolderName = "loc-data/" . "$folderNum" . "_" . "$transEng" . "_" . "$focusEng";
        ?>
            <script>
                function sleep(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }

                async function demo() {
                    while (1) {
                        await sleep(2000);
                        $(document).ready(function() {
                            if(navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showLocation);
                            }
                            else { 
                                console.log('Geolocation is not supported by this browser.');
                            }
                            });
                            function showLocation(position) {
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;
                                $.ajax({
                                    type:'POST',
                                    url:'locationSaver.php',
                                    data:'latitude='+latitude+'&longitude='+longitude+'&<?php echo "fileName=$newFolderName"?>',
                                    success:function(msg){
                                        if(msg){
                                            // console.log(msg);
                                            document.getElementById('coord').innerHTML = msg;
                                        }else{
                                            console.log('not Available');
                                        }
                                    }
                                });
                            }
                    }
                }

                demo();
            </script>
           <!-- <script>

                $(document).ready(function() {
                    if(navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showLocation);
                    }
                    else { 
                        console.log('Geolocation is not supported by this browser.');
                    }
                });
                function showLocation(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    $.ajax({
                        type:'POST',
                        url:'locationSaver.php',
                        data:'latitude='+latitude+'&longitude='+longitude+'&fileNum=5',
                        success:function(msg){
                            if(msg){
                                console.log(msg);
                            }else{
                                console.log('not Available');
                            }
                        }
                    });
                }
            </script> -->

    </body>
</html>
