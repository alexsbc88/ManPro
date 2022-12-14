<?php
require_once 'functions.php';

//pagination
$dataPerPage = 10;
$totalData = count(query("SELECT * FROM event"));
$pageCount = ceil($totalData / $dataPerPage);
$activePage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$begin = ($dataPerPage * $activePage) - $dataPerPage;
$dataEvent = query("SELECT * FROM event e join lokasi l on e.id_lokasi = l.id_lokasi ORDER by id_event LIMIT $begin, $dataPerPage");

//tombol cari ditekan
if (isset($_POST["btnSubmit"])) {
    $dataEvent = cari($_POST["keyword"]);
}

$lokasi = query("SELECT * FROM lokasi")[1];


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cari Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    </link>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <br><br><br>
    <div class="container">
        <h1 style="text-align: center;"><span id="ourEvent"> &nbsp; E V E N T &nbsp;</span></h1>
        <br>
        <div class="row justify-content-center">
            <div class="col-4 col-md-3 col-lg-2">
                <a href="insertevent.php">
                    <button class="btn btn-dark mx-auto" type="button" id="createEventButton" style="width: 100%;">+ Create Event</button>
                </a>
            </div>
        </div>
        <!-- <a type="button" class="btn btn-primary" id="createEventButton" href="insertevent.php">+ Create Event</a> -->

        <br>
        <div class="card my-3 mx-auto" style="width: 18rem;">
            <div class="card-body">
                <form action="" method="post">

                    <div class="mb-3">
                        <label for="search_keyword" class="form-label">Cari Event</label>
                        <input type="text" name="keyword">
                    </div>
                    <!-- bikin table untuk menunjukkan event -->
                    <!-- pada masing masing event buat button untuk input pendonor -->
                    <!-- buat modal atau page baru untuk input id pendonor dan cc darah -->
                    <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>

                </form>
            </div>
        </div>

        <div id="container my-3">
            <table class="table table-striped table-bordered" border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>

                        <th>#</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Jam mulai</th>
                        <th>Jam selesai</th>
                        <th>Lokasi</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <?php if (empty($dataEvent)) : ?>
                    <tr>
                        <td colspan="7" align="center">data mahasiswa tidak ditemukan</td>
                    </tr>
                <?php endif; ?>

                <?php $i = 1; ?>
                <?php foreach ($dataEvent as $row) { ?>
                    <tr>
                        <td><?= $row["id_event"]; ?></td>
                        <td><?= $row["nama_event"]; ?></td>
                        <td><?= $row["tanggal_event"]; ?></td>
                        <td><?= $row["waktu_event_mulai"]; ?></td>
                        <td><?= $row["waktu_event_selesai"]; ?></td>
                        <td><?= $row["nama_lokasi"]; ?></td>
                        <td><a href="inputDonor.php?id=<?php echo $row["id_event"]; ?>">Input Donor</a></td>
                    </tr>
                    <?php $i++; ?>
                <?php } ?>
            </table>
        </div>
        <br>
        <!--PAGINATION-->
        <nav aria-label="...">

            <ul class="pagination">

                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>

                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endfor; ?>

                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>

    </div>

    <script src="jquery-3.1.1.min.js"></script>
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"> </script>
</body>

</html>
