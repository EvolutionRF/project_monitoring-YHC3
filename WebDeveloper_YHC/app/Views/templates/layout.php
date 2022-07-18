<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- CSS Bootstrap  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <?= $this->renderSection('header') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Navbar Bar -->

        <?= $this->include('templates/navbar') ?>
        <!-- Navbar Side -->


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-primary p-2 text-dark bg-opacity-25">
            <!-- Main Content -->
            <div id="content">
                <p class="mb-2"></p>
                <!-- Begin Page Content -->
                <div class="container-fluid small">
                    <!-- Render Content -->
                    <?= $this->renderSection('page-content') ?>
                    <!-- Render Content -->
                </div>

                <!-- Footer -->
                <footer class="sticky-footer small">
                    <div class="copyright text-end my-2 me-3">
                        <span>Created By : <b>Ridha Fahmi J</b></span>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content -->

        </div>
        <!-- End Of Content Wraper -->
    </div>
    <!-- End of Page Wrapper -->



    <!-- Bootstrap core JavaScript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <?= $this->renderSection('footer') ?>

</body>

</html>