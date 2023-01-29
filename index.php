<?php
include_once "db.php";

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

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Droid+Sans:400,700'
          rel='stylesheet' type='text/css'>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>
</head>

<body>


<div class="container-fluid" style="text-align: center">
    <div class="row justify-content-center">
            <a href="/">
                <img src="images/ritsiCrossingLogo.png"
		     width="400"
                     alt="escudo">
            </a>
    </div>
</div>

 <div class="container-fluid">
    <div class="row justify-content-center">
		<?php
			foreach ( $teams as $team ) {
			?>
            <div class="col-lg-2 col-md-8">
		<div class="flex-container">
                <div class="listing-item">
                    <figure class="image">
                        <img src="images/<?= $team->name ?>.png"
                             alt="<?= $team->name ?>">
                        <figcaption class="<?= $team->name ?>">
                            <div class="caption">
							<div>
								<h1><?= $team->points ?></h1>
								<!-- <img class="bayas" src="images/bayas.png" alt="bayas"> -->
							</div>
							<p>bayas</p>
                            </div>
                        </figcaption>
                    </figure>
                    <div class="listing">
                        <h4><?= $team->name ?></h4>
                        <h5><b><?= $team->leader ?></b></h5>
						<?php
						 foreach ($team->members as $member) {
							?>
                            <h5><?= $member->name ?> <?= $member->lastname ?></h5>
							<?php
						}
						?>
                    </div>
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
