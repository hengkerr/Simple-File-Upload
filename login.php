<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>File Upload</title>
</head>
<body style="background: rgb(171,78,202); background: linear-gradient(90deg, rgba(171,78,202,1) 12%, rgba(71,159,198,1) 46%, rgba(27,199,227,1) 100%);">
   
    <main class="m-3 d-block">
        <div class="container h-100 ">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 50px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                                    <form action="upload.php" method="POST" enctype="multipart/form-data">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" required><br><br>
                                        <label for="image">Unggah dan bagikan gambar anda.</label><br>
                                        <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" required><br><br>
                                        <div class="g-recaptcha" data-sitekey=""></div>
                                        <br>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">MULAI MENGUNGGAH</button>
                                        </div>
                                    </form>
</body>
</html>
