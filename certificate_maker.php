<?php
    session_start();
    if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
        header('location:index.php');
    }

    if(isset($_SESSION['template'])) {
        $display = 'block';
        $source = "partials/".$_SESSION['template'];
    } else {
        $display = 'none';
        $source = '';
    }

    if(isset($_SESSION['template_pdf'])) {
        $PDFsave ="partials/".$_SESSION['template_pdf'];
    } else {
        $PDFsave = '';
    }
?>
<?php require('partials/header.php'); ?>

<body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="assets/logo.svg">
            <img src="assets/logo.svg" alt="logo" width="30">
        </a>
        <a class="navbar-brand ml-2" href="#">Certificate Maker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php
                if(!isset($_SESSION['userEmail'])) {
                    echo '<ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="useremail.php">Set Sender\'s Email <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>';
                } else {
                    echo '<ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="useremail.php">Change Sender\'s Email <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>';
                }
            ?>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Navbar -->

    <!-- alerts -->
    <?php include("partials/alerts.php") ?>
    <!-- alerts -->

    <div class="container">
        <div class="my-4 border border-muted p-3 rounded">
            <h2 class="my-4 pb-2 text-dark text-center" style="font-family: 'Anton', sans-serif;">Certificate Maker
            </h2>

            <form id="uploadCertificate" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="custom-file col-md-9">
                        <input type="file" class="custom-file-input custom-file-input-sm" id="certificateTemplate"
                            name="certificateTemplate">
                        <label class="custom-file-label" for="certificateTemplate">Select Template</label>
                    </div>
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-light" name="templateBtn" id="templateBtn">Upload</button>

                        <button class="btn btn-light btn-sm" disabled style="display: none;" id="templateSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Uploading..
                        </button>
                    </div>
                </div>
            </form>

            <div class="text-center" style="display: <?=$display?>;" id="templateImage">
                <a href="<?=$source;?>" target="_blank">
                    <img src="<?=$source;?>" class="rounded" alt="..." width="40%" id="userTemplate">
                </a>
                <figcaption class="figure-caption">Your Template.</figcaption><br>
            </div>

            <form action="partials/action.php" method="post" target="_blank" id="participantNameFrom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="participantName">Participant Name</label>
                        <input type="text" class="form-control form-control-sm" id="participantName"
                            name="participantName" placeholder="Participant Name" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="participant_fontsize">Font Size</label>
                        <input type="text" class="form-control form-control-sm" id="participant_fontsize"
                            name="participant_fontsize" placeholder="Font Size" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="participant_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="participant_x_axis"
                            name="participant_x_axis" placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="participant_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="participant_y_axis"
                            name="participant_y_axis" placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="participantBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="participantBtn" name="participantBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="participantBtn">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="participantSave"
                            name="participantSave"><i class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="participantSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>
            <form action="partials/action.php" method="post" target="_blank" id="eventNameFrom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="eventName">Event Name</label>
                        <input type="text" class="form-control form-control-sm" id="eventName" name="eventName"
                            placeholder="Event Name" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="event_fontsize">Font Size</label>
                        <input type="text" class="form-control form-control-sm" id="event_fontsize"
                            name="event_fontsize" placeholder="Event Size" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="event_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="event_x_axis" name="event_x_axis"
                            placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="event_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="event_y_axis" name="event_y_axis"
                            placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="eventBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="eventBtn" name="eventBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="eventSave">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="eventSave" name="eventSave"><i
                                class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="eventSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>
            <form action="partials/action.php" method="post" target="_blank" id="resultNameFrom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="resultName">Result</label>
                        <input type="text" class="form-control form-control-sm" id="resultName" name="resultName"
                            placeholder="Result" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="result_fontsize">Font Size</label>
                        <input type="text" class="form-control form-control-sm" id="result_fontsize"
                            name="result_fontsize" placeholder="Font Size" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="result_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="result_x_axis" name="result_x_axis"
                            placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="result_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="result_y_axis" name="result_y_axis"
                            placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="resultBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="resultBtn" name="resultBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="resultSave">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="resultSave" name="resultSave"><i
                                class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="resultSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>
            <form action="partials/action.php" method="post" target="_blank" id="descriptionFrom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="descriptionName">Description</label>
                        <textarea class="form-control form-control-sm" id="descriptionName" rows="1"
                            name="descriptionName" placeholder="Description" required></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="description_fontsize">Font Size</label>
                        <input type="text" class="form-control form-control-sm" id="description_fontsize"
                            name="description_fontsize" placeholder="Font Size" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="description_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="description_x_axis"
                            name="description_x_axis" placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="description_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="description_y_axis"
                            name="description_y_axis" placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="descriptionBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="descriptionBtn" name="descriptionBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="descriptionSave">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="descriptionSave"
                            name="descriptionSave"><i class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="descriptionSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>
            <form action="partials/action.php" method="post" target="_blank" id="dateFrom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="datePicker">Date</label>
                        <input type="text" class="form-control form-control-sm" id="datePicker" name="dateName"
                            placeholder="Date" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="date_fontsize">Font Size</label>
                        <input type="text" class="form-control form-control-sm" id="date_fontsize" name="date_fontsize"
                            placeholder="Font Size" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="date_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="date_x_axis" name="date_x_axis"
                            placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="date_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="date_y_axis" name="date_y_axis"
                            placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="dateBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="dateBtn" name="dateBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="dateSave">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="dateSave" name="dateSave"><i
                                class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="dateSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>
            <form action="partials/action.php" method="post" target="_blank" id="organiserFrom">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="organiserName">Organiser</label>
                        <input type="text" class="form-control form-control-sm" id="organiserName" name="organiserName"
                            placeholder="Organiser" required>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="organiser_fontsize">Font Size</label>
                        <input type="text" class="form-control form-control-sm" id="organiser_fontsize"
                            name="organiser_fontsize" placeholder="Font Size" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="organiser_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="organiser_x_axis"
                            name="organiser_x_axis" placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="organiser_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="organiser_y_axis"
                            name="organiser_y_axis" placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="organiserBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="organiserBtn" name="organiserBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="organiserSave">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="organiserSave" name="organiserSave"><i
                                class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="organiserSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>

            <br>

            <form id="uploadSign" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="custom-file col-md-7">
                        <input type="file" class="custom-file-input custom-file-input-sm" id="signTemplate"
                            name="signTemplate">
                        <label class="custom-file-label " for="signTemplate">Select Sign</label>
                    </div>
                    <div class="form-group col-md-auto">
                        <button type="submit" class="btn btn-light" name="signBtn" id="signBtn">Upload</button>
                        <button class="btn btn-light btn-sm" disabled style="display: none;" id="signSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Uploading..
                        </button>
                    </div>
                </div>
            </form>
            <form action="partials/action.php" method="post" target="_blank" id="signPosFrom">
                <div class="form-row">
                    <div class="form-group col-md-auto">
                        <label for="signPos_x_axis">x-axis</label>
                        <input type="text" class="form-control form-control-sm" id="signPos_x_axis"
                            name="signPos_x_axis" placeholder="x-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="signPos_y_axis">y-axis</label>
                        <input type="text" class="form-control form-control-sm" id="signPos_y_axis"
                            name="signPos_y_axis" placeholder="y-axis" required>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="signPosBtn">Preview</label><br>
                        <button type="submit" class="btn btn-info btn-sm" id="signPosBtn" name="signPosBtn"><i
                                class="fas fa-eye"></i> Preview</button>
                    </div>
                    <div class="form-group col-md-auto">
                        <label for="signPosSave">Save</label><br>
                        <button type="button" class="btn btn-warning btn-sm" id="signPosSave" name="signPosSave"><i
                                class="fas fa-save"></i> Save</button>
                        <button class="btn btn-warning btn-sm" disabled style="display: none;" id="signPosSpinner">
                            <span class="spinner-border spinner-border-sm"></span>
                            Saving..
                        </button>
                    </div>
                </div>
            </form>


            <div class="form-group mt-4">
                <a href="<?=$source?>" class="btn btn-primary" download="your_certificate" id="saveLocally">Save Locally
                    as image</a>
                <a href="<?=$PDFsave?>" class="btn btn-primary" download="your_certificate" id="savePDF">Save Locally as
                    PDF</a>
                <?php
                    if(!isset($_SESSION['userEmail'])) {
                        echo '<span class="badge badge-danger" style="font-size:15px;">To Send as mail, Set Sender\'s mail</span>';
                    } else {
                        echo '<button type="submit" class="btn btn-secondary" data-toggle="collapse" data-target="#mailCollapse" aria-expanded="false" aria-controls="mailCollapse">Send as Mail</button>';
                    }
                ?>
                <div class="collapse mt-4" id="mailCollapse">
                    <div class="card card-body">
                        <div>
                            <div class="form-group row">
                                <label for="senderEmail" class="col-sm-2 col-form-label">From</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="senderEmail" name="senderEmail"
                                        value="<?=$_SESSION['userEmail']?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="recieverEmail" class="col-sm-2 col-form-label">To</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="recieverEmail" name="recieverEmail"
                                        placeholder="email@example.com" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="recieverSubject" class="col-sm-2 col-form-label">Subject</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="recieverSubject" name="recieverSubject"
                                        placeholder="Subject...">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="recieverBody" class="col-sm-2 col-form-label">Body</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="recieverBody" name="recieverBody" rows="3"
                                        placeholder="Body..."></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">Attachment</label>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-checkbox ">
                                        <input type="checkbox" class="custom-control-input" id="recieverImage">
                                        <label class="custom-control-label" for="recieverImage">Certificate as Image</label>
                                    </div>
                                    <div class="custom-control custom-checkbox ">
                                        <input type="checkbox" class="custom-control-input" id="recieverPDF">
                                        <label class="custom-control-label" for="recieverPDF">Certificate as PDF</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="button" id="sendMail" class="btn btn-success"><i class="fas fa-paper-plane"></i> Send</button>
                                    
                                    <button class="btn btn-success" disabled style="display: none;" id="mailSpinner">
                                        <span class="spinner-border spinner-border-sm"></span>
                                        Sending..
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>