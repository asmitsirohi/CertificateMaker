<?php require('partials/header.php') ?>
<body id="main">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="center border border-dark p-3 rounded bg-light">
                    <div class="media ">
                        <img src="assets/logo.svg" class="mr-4" alt="..." width="150">
                        <div class="media-body">
                            <h1 class="mt-4 pt-4 text-dark" style="font-family: 'Anton', sans-serif;">Certificate Maker</h1>
                        </div>
                    </div>
                    <p class="my-2">Welcome to Certificate Maker. Please Enter Password to Continue.</p>

                    <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> -->
                        <div class="form-group">
                            <input type="password" class="form-control" name="loginPassword" id="loginPassword"
                                placeholder="Enter Password..." required>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-dark btn-block" name="submitUser" id="submitUser">Enter in Certificate Maker</button>
                        </div>
                        <div class="form-group" id="checkPassword" style="display: none;">
                            <p class="text-center text-danger">Invalid Password!</p>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(() => {
        $('#submitUser').click(() => {
            let password = $('#loginPassword').val();
            
            $.post('partials/authentication.php', {
                password : password
            }, function(response) {
                if(!response) {
                    $('#checkPassword').css('display','block');
                } else {
                    window.location.href = "useremail.php";
                    console.log("Hello");
                }
            });
        });
    });
</script>