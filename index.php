<?php
require_once 'libraries/Mysqli.php';

// istanza della classe
$db = new Database_Mysqli('localhost', 'root', '', 'jowa');

$db->query('SELECT * FROM jowa_videos');
$videos_num = $db->fetch(Database_Mysqli::FETCH_NUM);

$real_page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = $real_page - 1;
$offset = $page * 10;
$limit = 10;

$db->query("SELECT * FROM jowa_videos ORDER BY position ASC LIMIT {$offset}, {$limit}");
$videos = $db->fetchAll(Database_Mysqli::FETCH_OBJ);

?>


<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>jQuery Ordering #withArtur</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
		
		<style>
		.table-striped > tbody > tr:nth-of-type(2n+1) {
			background-color: #ffc8ff;
		}
		
		#pagination a {
			font-size: 30px;
			padding: 30px 40px;
		}
		</style>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="container">

        <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">Project name</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Projects</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Downloads</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </nav>
      </div>

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>jQuery Ordering #withArtur</h1>
      </div>

        <!-- Example row of columns -->
        <div class="row">
            
            <!-- lista di elementi -->
            <table class="table table-striped table-hover table-bordered table-condensed">
                <thead>
                    <th>#</th>
                    <th>Utente</th>
                    <th>Titolo</th>
                    <th>Desc</th>
                    <th>Lunghezza</th>
                    <th>ID YouTube</th>
                    <th>Caricato</th>
                    <th>Sposta</th>
                </thead>
                
                <tbody id="sortable">
                    <?php foreach($videos as $video): ?>

                    <tr class="ui-state-default" data-elementid="<?php echo $video->id; ?>">
                        <td class="">
                            #<?php echo $video->id; ?>
                        </td>
                        <td><?php echo $video->user_id; ?></td>
                        <td><?php echo $video->title; ?></td>
                        <td>
                            <?php echo substr($video->description, 0, 100); ?>
                            ...
                        </td>
                        <td>
                            <?php echo $video->lenght_seconds / 60; ?> minuti
                            <br>
                            (<?php echo $video->lenght_seconds; ?> secondi)
                        </td>
                        <td><a href="https://youtu.be/<?php echo $video->id_youtube; ?>" target="_blank"><?php echo $video->id_youtube; ?></a></td>
                        <td><?php echo $video->ts_uploaded; ?></td>
						<td class="srtbl-move">
                            <?php echo $video->position; ?>
                            <i class="glyphicon glyphicon-move"></i>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- paginzaione -->
            <nav class="text-center">
                <ul id="pagination" class="pagination">
                  <li>
                    <a href="#" aria-label="Previous" class="connectPage">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                  
                    <?php for($p=1;$p<=$videos_num/10;$p++): ?>
                        <li class="<?php echo ($real_page == $p) ? 'active' : ''; ?>"><a href="/index.php?page=<?php echo $p; ?>" class="connectPage" data-page="<?php echo $p; ?>"><?php echo $p; ?></a></li>
                    <?php endfor; ?>
                  
                  <li>
                    <a href="#" aria-label="Next" class="connectPage">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
        </div>

        <!-- Site footer -->
        <footer class="footer">
            <p>&copy; Company 2015</p>
        </footer>

        </div> <!-- /container -->

        
        
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. 
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
        -->
    </body>
</html>