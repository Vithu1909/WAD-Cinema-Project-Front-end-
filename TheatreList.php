<?php
include './Header.php';
include './classes/Movie.php';


$movie = new Movie();


$movieId = "MV0000000000000001"; 
$timeList = $movie->getMovieTime($movieId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href='./css/Theatre.css'>
    <title>Document</title>
</head>
<body>
    <div class="Theatre-top-con">
        <div class="Theatre-top-boxs">
            <?php
           
            $dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            
           
            for ($i = 0; $i < 4; $i++) {
                $date = date('j', strtotime("+$i day"));
                $day = ($i == 0) ? "Today" : $dayNames[date('w', strtotime("+$i day"))];
                echo "
                <div class=\"Theatre-top-box\">
                    <div class=\"top-date\">$date</div>
                    <div class=\"top-date\">$day</div>
                </div>";
            }
            ?>
        </div>
    </div>
    <div class="Theatre-bars">
        <?php
        if (!empty($timeList)) {
            foreach ($timeList as $theater) {
                $theaterId = $theater['theater_ID'];
                $theaterDetails = $movie->getTheaterDetails($theaterId);
                $theaterName = $theaterDetails['name'];
                $theaterLocation = $theaterDetails['location'];
                $showTimes = $movie->getTheaterTimeDetails($theaterId, $movieId);

                echo "
                <div class=\"Theatre-bar\">
                    <img src='./img/mask.png' alt='mask' class='bar-img'>
                    <div class='Theatre-name-con'>
                        <span class='Theatre-name'>$theaterName</span>
                        <span class='Theatre-location'>$theaterLocation</span>
                    </div>
                    <div class='Theatre-time-con'>";
                
                foreach ($showTimes as $time) {
                    echo "
                        <div class='Theatre-time-but'>
                            <span class='Theatre-time'>$time</span>
                        </div>";
                }

                echo "
                    </div>
                </div>";
            }
        } else {
            echo "<p>No showtimes available.</p>";
        }
        ?>
    </div>
    <div class="book-but-Theatre">
        <button class="book-but">Book</button>
    </div>
</body>
</html>
<?php
include './Footer.php';
?>
