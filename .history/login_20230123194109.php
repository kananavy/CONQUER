<?php
session_start();
if(isset($_SESSION['unique_id'])){ //if user logged in
    header("location: user.php");
}
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>🦇Chat - KaMi🦇</header>
            <form action="user.php" method="PO" autocomplete="off">
                <div class="error-txt"></div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" >
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" >
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to Chat">
                    </div>
            </form>
            <div class="link">not yet signed up? <a href="index.php">signup now</a></div>
        </section>
    </div>
    <script src="javascript/login.js"></script>
</body>
</html>