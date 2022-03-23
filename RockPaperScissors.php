<?php

    session_start();

    if (isset($_GET["userSelection"])) {        
        if (!isset($_SESSION["computerSelection"])) { // check for saved session
            switch (random_int(0, 2)) { // save random selection to session
                case 0: $_SESSION["computerSelection"] = "paper"; break;
                case 1: $_SESSION["computerSelection"] = "rock"; break;
                default: $_SESSION["computerSelection"] = "scissors"; break;
            }
            $_SESSION["numberOfTries"] = 0; // reset number of tries
        }
        
        $_SESSION["numberOfTries"]++; // bump user tries by 1

        if ($_GET["userSelection"] == $_SESSION["computerSelection"]) { // check if user guess was correct
            echo "Great work, you did it in ".$_SESSION["numberOfTries"]." tries.\n";
            session_destroy(); // kill active session
        }

        die();
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Paper, Rock & Scissors</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <form id="selectionForm">
        <div class="container">
            <p>Please select:</p>
                 <table>
                    <tr>
                        <td>
                            <input type="radio" id="rock" name="userSelectionRadio" value="rock"/>
                            <label for="rock"> Rock</label>
                        </td>
                        <td>
                            <input type="radio" id="paper" name="userSelectionRadio" value="paper"/>
                            <label for="paper"> Paper</label>
                        </td>
                        <td>
                            <input type="radio" id="scissors" name="userSelectionRadio" value="scissors"/>
                            <label for="scissors"> Scissors</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <input type="button" value="Select" id="selectionButton"/>
                        </td>
                    </tr>
                </table>           
        </div>
    </form>

    <script>
        $("#selectionButton").click(function(data) {
            var selection = $("input[name=userSelectionRadio]:checked", "#selectionForm").val()
            $.get("PaperRockScissors.php", {"userSelection": selection}, function(data) {
                console.log(data); 
            });
        });
    </script>
</body>
</html>