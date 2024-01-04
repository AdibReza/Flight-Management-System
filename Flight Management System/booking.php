
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Booking Form</title>
    <link rel="stylesheet" href="booking.css">
     <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
    <section class="prothom">
        <div class="container"><!--container-->
            <form class="form-group" action="http://localhost/FRONT-END/booking_db.php" method="post">
            
                <h1 class="text-center">Airline Booking Form</h1>

                <div id="form"><!--form-->
                    <h3 class="text-white">Booking Details</h3>

                <div id="input"><!--input-->
                    <input type="text" id="input-group" placeholder="User ID" name="id"><br>
                    <input type="text" id="input-group" placeholder="Origin" name="origin">
                    <input type="text" id="input-group" placeholder="Destination" name="dest">
                    <label for="dateInput" class="input-text">Departure: </label>
                    <input type="date" id="dateInput" placeholder="Departure" name="depart"><br>
                    <label for="dateInput" class="input-text">Arrival: </label>
                    <input type="date" id="dateInput" placeholder="Arrival" name="arr"><br>
                                                                                       
                    
                    <div>
                    <?php

                    define('dbServer','localhost');
                    define('dbUsername','root');
                    define('dbPass','');
                    define('dbName','flight');
                    
                    $link=mysqli_connect(dbServer, dbUsername, dbPass, dbName);

                    if ($link==false){
                        die('Error: could not connect.' .mysqli_connect_error());
                    }

                    echo '<label for="input-group" class="input-text">Preferred Airlines: </label>';
                    echo '<select id="input-group" style="background: black;" placeholder="airlines" name="airlines">';
                    $sql3='SELECT* FROM airlines';
                    if ($result3=mysqli_query($link,$sql3)){
                        if (mysqli_num_rows($result3)>0){
                            while($row3=mysqli_fetch_array($result3)){
                                echo "<option value='" . $row3['airline_name'] . "'>" . $row3['airline_name'] . "</option>";
                            }
                        }
                    }            
                    echo '</select><br>';
                    
                    echo "<label for='input-group' class='input-text'>Food: </label>"; 
                    echo "<select id='input-group' style='background: black;' placeholder='food' name='food'>"; 
                    $sql='SELECT* FROM food';
                    if ($result=mysqli_query($link,$sql)){
                        if (mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_array($result)){
                                echo "<option value='" . $row['food_name'] . "'>" . $row['food_name'] . "</option>";
                            }
                        }
                    }                                   
                    echo "</select><br>";

                    echo '<label for="input-group" class="input-text">Class: </label>';
                    echo '<select  id="input-group" style="background: black;" placeholder="class" name="class">';
                    $sql2='SELECT* FROM class';
                    if ($result2=mysqli_query($link,$sql2)){
                        if (mysqli_num_rows($result2)>0){
                            while($row2=mysqli_fetch_array($result2)){
                                echo "<option value='" . $row2['class_type'] . "'>" . $row2['class_type'] . "</option>";
                            }
                        }
                    }                        
                    echo '</select>';


                    ?>

                    </div>

                    
                                               
                       
                                              
                    
                    <label for="input-group" class="input-text">Seat Number:</label>
                    <select  id="input-group2" style="background: black;" placeholder="seat" name="seat">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                    </select>
                    <!-- </div>input4 -->
                </div>

                    
                    <button type="submit" class="btn-warning-text-white-submit">Submit Form</button>
                    <button type="reset" class="btn-warning-text-white-clear">Clear Form</button>
                    <button type="submit" class="btn-warning-text-white-next">Next</button>
                </div><!--form-->
            </form>

            

        </div><!--container-->
    </section>
    <section class="">

    </section>
    </body>
    </html>