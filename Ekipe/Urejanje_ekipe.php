<?php
include "../login/config.php";
session_start();
$idEkipe = $_GET['id'];
$sql = "SELECT * FROM uporabniki";
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
}
$get = mysqli_query($db, $sql);
$optionTrener = "";
$optionPom1 = "";
$optionPom2 = "";
$sqlEkipa = "SELECT * FROM ekipe WHERE `ID` = '$idEkipe'";
$query = mysqli_query($db, $sqlEkipa);
$ekipa = mysqli_fetch_assoc($query);
while ($row = mysqli_fetch_assoc($get)) {
    if ($row['ID'] == $ekipa['trenerID']) {
        $optionTrener .= '<option selected value = ' . $row['ID'] . '>' . $row['ime'] . " " . $row['priimek'] . '</option>';
    } else {
        $optionTrener .= '<option value = ' . $row['ID'] . '>' . $row['ime'] . " " . $row['priimek'] . '</option>';
    }
    if ($row['ID'] == $ekipa['pomocnik1ID']) {
        $optionPom1 .= '<option selected value = ' . $row['ID'] . '>' . $row['ime'] . " " . $row['priimek'] . '</option>';
    } else {
        $optionPom1 .= '<option value = ' . $row['ID'] . '>' . $row['ime'] . " " . $row['priimek'] . '</option>';
    }
    if ($row['ID'] == $ekipa['pomocnik2ID']) {
        $optionPom2 .= '<option selected value = ' . $row['ID'] . '>' . $row['ime'] . " " . $row['priimek'] . '</option>';
    } else {
        $optionPom2 .= '<option value = ' . $row['ID'] . '>' . $row['ime'] . " " . $row['priimek'] . '</option>';
    }
}
?>

<html style="background-color: rgb(60, 68, 77);">

<head>
    <title>NK Malecnik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../fixed-left.css">
    <link rel="stylesheet" href="../style.css">
    <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-left">
        <a class="navbar-brand" href="">NK MALEČNIK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard.php">Domov</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="Moji_igralci.php">Moji igralci</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Vsi_igralci/Vsi_igralci.php">Vsi igralci</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Ekipe.php">Ekipe</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Obvestilo</a>
                </li>

                <div class="dropdown-divider"></div>
                <!-- NOVA KATEGORIJA -->
                <li class="nav-item">
                    <a class="nav-link" href="">Koledar</a>
                </li>
                <li class="nav-item">
                <li class="nav-item dropdown">
                    <a href="#treningiSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Treningi</a>
                    <ul class="collapse list-unstyled" id="treningiSub">
                        <li>
                            <a class="nav-link sub-link" href="#">Nov trening</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Moji treningi</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Vsi treningi</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Predloge treningov</a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="nav-item">
                <li class="nav-item dropdown">
                    <a href="#tekmeSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Tekme</a>
                    <ul class="collapse list-unstyled" id="tekmeSub">
                        <li>
                            <a class="nav-link sub-link" href="#">Nova tekma</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Moje tekme</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Vse tekme</a>
                        </li>
                    </ul>
                </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Zdravstveni karton</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="">Poročilo prisotnosti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Testiranja</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Skavting</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Video analiza</a>
                </li>
                <div class="dropdown-divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="">Uporabniki</a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#nastavitveSub" class="nav-link dropdown-toggle" data-toggle="collapse" aria-haspopup="true" aria-expanded="false">Nastavitve</a>
                    <ul class="collapse list-unstyled" id="nastavitveSub">
                        <li>
                            <a class="nav-link sub-link" href="#">Podatki kluba</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Prestavi igralce</a>
                        </li>
                        <li>
                            <a class="nav-link sub-link" href="#">Lokacije treningov</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="container">
        <div class="row glava">
            <!--GLAVA-->
            <div class="col-11 colGlava">
                <h1>Urejanje ekipe <?php echo $ekipa['imeEkipe']; ?></h1>
            </div>
            <div class="col colGlava">
            </div>
        </div>
        <div class="row kavarna">
            <!--KAVARNA-->
            <div class="col-11 col-sm-11 order-sm-1  colKavarna novIgralec">
                <h2>Nova ekipa</h2>
                <form id="novIgralecSplosno" action="./Uredi_ekipo.php" method="post">
                <input type="hidden" name="idEkipe" value=<?php echo $idEkipe;?>>
                    <div class="col">
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Ime ekipe*</span>
                                </div>
                                <input type="text" class="form-control" name="imeEkipe" value="<?php echo $ekipa['imeEkipe']; ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Trener*</span>
                                </div>
                                <select required class="form-control" name="trener">
                                    <?php echo $optionTrener; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Pomočnik 1</span>
                                </div>
                                <select class="form-control" name="pomocnik1">
                                    <option value="">Prazno</option>
                                    <?php echo $optionPom1; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Pomočnik 2</span>
                                </div>
                                <select class="form-control" name="pomocnik2">
                                    <option value="">Prazno</option>
                                    <?php echo $optionPom2; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" onclick="" class="btn btn-primary btnForma">Uredi</button>
                    <button type="reset" class="btn btn-danger btnForma">Prekliči</button>
                </form>



            </div>

        </div>
</body>

</html>