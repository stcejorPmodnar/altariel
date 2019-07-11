<!DOCTYPE html>
<html>
    <head>
        <title>Fitness App | Your Exercise</title>
        <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
        <link rel="stylesheet" type="text/css" href="../stylesheets/exercise.css">

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
        <p id=coordinates>test</p>
        <?php 


            $trans = $_POST['transport'];
            $focus = $_POST['focus'];

            echo "<span style='color:white;'>$trans</span><br>";
            echo "<span style='color:white;'>$focus</span>";
        ?>
            <script type="text/javascript">


            function getCoords(){
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('coordinates').innerHTML = position.coords.latitude + ',' + position.coords.longitude;
                });
            }
            
            getCoords()

            // function getLocation() {
            //     if (navigator.geolocation) {
            //         navigator.geolocation.getCurrentPosition(showPosition);
            //     } else {
            //         x.innerHTML = "Geolocation is not supported by this browser.";
            //     }
            // }

            // function showPosition(position) {
            //     var coords = position.coords.latitude + ',' + position.coords.longitude; 
            //     return coords
            // }
            // console.log(getLocation());
            // function coords() {
            //     if(navigator.geolocation) {
            //         navigator.geolocation.getCurrentPosition(position => {
            //             console.log("Latitude:" + position.coords.latitude + "\nLongitude:" + position.coords.longitude)
            //         })
            //     }
            // }
            // for (let i = 0; i < 5; i++) {
            //     document.getElementById('coordinates').innerHTML = coords();
            // }

        </script>

    </body>
</html>
