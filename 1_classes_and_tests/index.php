<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact us</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/jquery.min.js"></script>
</head>
<body>

<form action="vendor/send_form.php" method="post">
    <label>Full Name</label>
    <input class="data-input" type="text" name="name" placeholder="What's your name?" value="<?php echo $_SESSION['contact_name'] ?? ""; ?>">
    <label>Email address</label>
    <input class="data-input" type="text" name="email" placeholder="What's your email?" value="<?php echo $_SESSION['contact_email'] ?? ""; ?>">
    <label>Message</label>
    <textarea class="data-input" name="contact_message" placeholder="Write your message for us here"><?php echo $_SESSION['contact_message'] ?? ""; ?></textarea>
    <button id="submit" type="submit" onclick="sendMessage(event)">Submit</button>
    <?php
        echo '<br>';
        if ($_SESSION['message']) {
            echo '<p class="' . $_SESSION['message_class'] . ' msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
    ?>
</form>

</body>

<script>
    function sendMessage(event) {
        document.querySelector('#submit').disabled = true;
    }

    $(document).ready(function () {
        $('.data-input').on('input', function () {
            document.querySelector('#submit').disabled = false;
        })
    });
</script>
</html>
