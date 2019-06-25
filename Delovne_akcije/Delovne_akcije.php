<?php
include "../login/config.php";
session_start();
if (!isset($_SESSION['id']) && empty($_SESSION['id'])) {
    header("location: ../index.php");
}
?>
<html>
<head>
    <title>Delovne akcije</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="utf-8">
    <meta name=viewport content=width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=yes>
     <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../script.js"></script>
    <link rel="stylesheet" href="../fixed-left.css">
    <link rel="stylesheet" href="../style.css">
    <script src="../script.js"></script>
    <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
     
</head>
<body>
    <div class="modal fade" id="vnosPrisotnosti" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Prisotnost</h5>
                    <button type="button" class="close zapri" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center;">

                    <?php echo $beseda; ?>
                </div>
                <div class="modal-footer">

                </div>
                </form>
            </div>
        </div>
    </div>
    <div id="nav-placeholder">
        <script>
            $(function() {
                $("#nav-placeholder").load("../nav.html");
            });
        </script>
    </div>
    <div id="container">
        <div class="row glava">
            <!--GLAVA-->
            <div class="col-9 colGlava">
                <h1>Delovne akcije</h1>
            </div>
            <div class="col-2 colGlava divNovGumb">
                <button type="button" class="btn btn-primary btn-md btn-block gumbNov" onclick="location.href='Nova_akcija.php'">Nova akcija</button>
            </div>
        </div>
        <div class="row kavarna">
            <!--KAVARNA-->
            <div class="col colKavarna">
                <div class="row" style="margin-top:0.5vh;margin-left:1vh;">
                    <div class="col-9">
                        <input type="text" id="iskanje" class="form-control" onkeyup="isciE()" placeholder="Iskanje...">
                    </div>
                    <div class="col-1">
                        <form name="exportExcel" action="../Export/excelM.php" method="post">
                            <!--<input type="submit" name="export" class="btn btn-secondary" value="Excel">-->
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="tabela" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Naslov</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Poročilo</th>
                                <th scope="col">Število ur</th>
                                <th scope="col">Prisotnost</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $table;
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

</body>

</html>