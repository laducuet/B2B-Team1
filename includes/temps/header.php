<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><//?php getTitle(); ?></title>
  <link rel="stylesheet" href="<//?php echo $css?>bootstrap.min.css">
  <link rel="stylesheet" href="<//?php echo $css?>all.min.css">
  <link rel="stylesheet" href="<//?php echo $css?>frontend.css">
  <link rel="stylesheet" href="<//?php echo $css?>style.css">
  <link rel="stylesheet" href="<//?php echo $css?>style1.css">
  <link rel="stylesheet" href="<//?php echo $css?>bootstrap-icons.css">
  <link rel="manifest" href="favicon/manifest.json">
  <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

</head>

<body>
  <div class="scroll-to-top "><i class="fas fa-arrow-up"></i></div> -->

<!DOCTYPE html>
<html lang="en">

 	<head>
 		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="author" content="Kamran Mubarik">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Title -->
 		<title>Team 1</title>
 		<!-- Style Sheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="<?php echo $css?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $css?>all.min.css">
    <link rel="stylesheet" href="<?php echo $css?>front.css">
    <link rel="stylesheet" href="<?php echo $css?>frontend.css">
    <link rel="stylesheet" href="<?php echo $css?>bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo $css?>checkout.css">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<!-- Javascript -->	
		<script type="text/javascript" src="js/jquery.min.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  		<script>		   
		    $( function() {
			    $( "#slider-range" ).slider({
			      range: true,
			      min: 0,
			      max: 10000,
			      values: [ 1000, 3000 ],
			      slide: function( event, ui ) {
			        $( "#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
			      }
			    });
			    $( "#amount" ).val( "Rs." + $( "#slider-range" ).slider( "values", 0 ) +
			      " - Rs." + $( "#slider-range" ).slider( "values", 1 ) );
			});
		 </script>
 	</head>
<body>