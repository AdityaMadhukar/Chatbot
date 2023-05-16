<?php
$question = "";
$answer = "Hi user, how can I help you?";
if (isset($_POST['question'])) {
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server, $username, $password);
    if (!$con) {
        die("Connection to this database failed due to " . mysqli_connect_error());
    }
    $question = $_POST['question'];

    $sql = "Select Answer FROM `faq`.`faq` WHERE Question= '$question'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $answer = $result->fetch_array();
    } else {
        // echo "ERROR: $sql <br> $con->error";
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Chatbot</title>
</head>

<body>
    <div class="page">
        <div class="chat_tab">
            <div class="header">
                <h2>Chatbot</h2>
            </div>
            <div class="container">
                <div class="sent">
                    <?php
                    echo $question
                    ?>
                </div>
                <br />
                <div class="received">
                    <?php
                    echo $answer[0];
                    ?>
                </div>
            </div>
            <div class="textbox">
                <form action="index.php" method="post">
                    <textarea name="question" rows="1" cols="10" wrap="soft" required id="msg"></textarea>
                    <button>Send</button>
                </form>
            </div>

        </div>
    </div>
</body>

</html>