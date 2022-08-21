<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGH Software Solutions</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<?php
session_start();
if (isset($_SESSION['error'])) {
?>
    <div class="container alert alert-danger" role="alert">
        <h6 class="d-flex justify-content-center">Please upload only jpg/png/jpeg images</h6>
    </div>
<?php
}
?>
<div class="container">
    <div class="col-md-6 offset-md-3 mt-3 pb-1">
        <div class="bg-image" id="dImg">
            <?php
            // session_start();
            if (isset($_SESSION["filepath"])) {
                $filepath = $_SESSION["filepath"];
            ?>
                <img src="<?php echo $filepath ?>" class="d-img" alt="not found">
                <label for="username" class="uname"><?php echo $_SESSION['name'] ?></label>
            <?php
            } else {
            ?>
                <div class="dotimage">
                    <!-- <h4 class="imgtext">
                    Your Image Hare
                </h4> -->
                    <!-- <h5 class="disname">Your Name</h5> -->
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="col-md-6 offset-md-3 mt-2 pb-1">
        <?php
        if (isset($_SESSION["filepath"])) {
            $filepath = $_SESSION["filepath"];
        ?>
            <button type="button" class="btn btn-primary col offset-md-3 d-md-flex dow" id="btndownload">Download Image</button>
        <?php
        } else {
        ?>
            <button type="button" class="btn btn-primary col-md-6 offset-md-3" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Upload</button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Upload Your Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="download.php" enctype="multipart/form-data">
                                <div class="mb-2">
                                    <label for="recipient-name" class="col-form-label">Name</label>
                                    <input type="text" class="form-control" name="txtname" id="recipient-name" name="txtname" required>
                                </div>
                                <div class="mb-2">
                                    <label for="message-text" class="col-form-label">Image</label>
                                    <input class="form-control" type="file" id="formFile" name="selectfile" required>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="uploadfile" accept=".jpg,.jpeg,.png">Upload</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<body>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/html2canvas.min.js"></script>
    <script>
        document.getElementById("btndownload").onclick = function() {
            var screenshotTarget = document.getElementById("dImg");
            html2canvas(screenshotTarget).then((canvas) => {
                var imagedow = canvas.toDataURL("image/png");
                var anchore = document.createElement('a');
                anchore.setAttribute("href", imagedow);
                anchore.setAttribute("download", "<?php echo $_SESSION['name'] ?>.png");
                anchore.click();
                anchore.remove();
            });
        };
    </script>
</body>

</html>