<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <title>ERROR 404</title>
    <style>
        * {
            font-family: "Poppins", Helvetica, sans-serif;
        }

        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #28527A;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container-fluid {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .card {
            background-color: #D9D9D9;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1150px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .content {
            height: 100%;
            align-items: center;
            display: flex;
        }

        .title {
            color: black;
            font-size: 2.5rem;
            font-family: Poppins;
            font-weight: 700;
            word-wrap: break-word;
        }

        .caption {
            color: black;
            font-size: 1.25rem;
            font-family: Poppins;
            font-weight: 500;
            word-wrap: break-word;
        }

        .btn {
            background: #28527A;
            padding: 8px 35px;
            color: white;
            font-size: 1.25rem;
            border-radius: 15px;
        }

        .btn:hover {
            background: #f4d160;
            color: #28527A;
        }

        .pageimg img {
            width: 90%;
        }

        .pageimg {
            text-align: center;
        }

        @media (max-width: 768px) {
            .card {
                height: 90%;
                justify-content: center;
                align-items: center;
            }

            .title {
                font-size: 2rem;
                margin-top: 80px;
            }

            .caption {
                font-size: 0.8rem;
            }

            .btn {
                font-size: 1rem;
                padding: 8px 25px;
            }

            .pageimg img {
                max-width: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <div class="content ps-3 text-md-start">
                                <div>
                                    <h1 class="title pb-3">Halaman Tidak Ditemukan</h1>
                                    <h2 class="caption pb-3">
                                        Maaf, halaman yang Anda tuju tidak ditemukan.
                                        Anda dapat kembali ke halaman sebelumnya. </h2>
                                    <a href="javascript:void(0);" onclick="history.back();">
                                        <button type="button" class="btn btn-lg">Kembali</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <div class="pageimg">
                                <img src="<?= base_url("assets/img/404.gif") ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>