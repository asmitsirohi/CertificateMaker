<?php
    session_start();
    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
        header('location:index.php');
    }

    if(isset($_SESSION['userEmail'])) {
        $email = $_SESSION['userEmail'];
    } else {
        $email = '';
    }

    if(isset($_POST['submitUser'])) {
        $userEmail = $_POST['userEmail'];
        $userPassword = $_POST['userPassword'];

        session_start();
        $_SESSION['userEmail'] = $userEmail;
        $_SESSION['userPassword'] = $userPassword;

        header('location: certificate_maker.php');
    }
    
?>
<?php require('partials/header.php') ?>

<body id="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="center border border-dark p-3 rounded bg-light">
                    <h4 class="my-2 text-dark text-center" style="font-family: 'Anton', sans-serif;">Certificate Maker
                    </h4>
                    <p class="text-center my-3" style="font-family: 'Anton', sans-serif;">Enter Account to send
                        certificate through GMAIL</p>

                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="form-group">                            
                            <input type="email" class="form-control" id="useremail" name="userEmail"
                                aria-describedby="emailHelp" placeholder="Enter email" value="<?=$email?>" required>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">                            
                            <input type="password" class="form-control" id="userPassword" name="userPassword"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary" name="submitUser">Continue</button>
                            <a href="certificate_maker.php" class="btn btn-warning float-right">Skip</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</body>

</html>