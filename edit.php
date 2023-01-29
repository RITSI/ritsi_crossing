<?php

include_once "db.php";

if ( isset( $_POST['teamId'] ) && is_numeric( $_POST['teamId'] )
     && isset( $_POST['newPoints'] )
     && is_numeric( $_POST['newPoints'] )
) {
	updatePoints( intval( $_POST['teamId'] ), intval( $_POST['newPoints'] ) );
}

$teams = fetch_teams();
?>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>RITSI Crossing!</title>
	
	<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	<link rel="manifest" href="/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
</head>

<body>

<div class="container-fluid" style="text-align: center">
    <div class="row justify-content-center">
            <a href="/">
                <img src="images/ritsiCrossingLogo.png"
                     style="margin-top: 30px; margin-bottom: 30px;"
		     width="400"
                     alt="escudo">
            </a>
    </div>
</div>
<div class="container-fluid" style="margin-top: 50px">
    <div class="row justify-content-center">
		<?php
		foreach ( $teams as $team ) {
			?>
            <div class="col-md-2">
                <div class="listing-item">
                    <figure class="image">
                        <img src="images/<?= $team->name ?>.png"
                             height="200px"
                             alt="<?= $team->name ?>"
                             style="padding: 20px; background-color: <?= $team->img_background_color ?>;">
                        <figcaption>
                            <div class="caption">
                                <h1><?= $team->points ?></h1>
                                <p>bayas</p>
                            </div>
                        </figcaption>
                    </figure>
                    <div class="listing">
                        <h4><?= $team->name ?></h4>
                        <form action="/edit.php" method="POST">
                            <div class="form-group">
                                <label style="font-size:px14;" for="email">Nueva puntuación(+/-):</label>
                                <input style="max-height:30px;font-size:14px;" type="number" class="form-control"
                                       name="newPoints">
                                <input type="hidden" class="form-control"
                                       name="teamId" value="<?= $team->id ?>">
                            </div>
                            <button style="max-height:30px;font-size:14px;margin-top:-8px" type="submit">
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
			<?php
		}
		?>
    </div>
</div>

</body>

</html>