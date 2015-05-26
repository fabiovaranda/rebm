<html>
    <head>  
        <title>REBM</title>
        <?php
         include('importarBibliotecas.php');
        ?>
	
    <style type="text/css">
            body {
                
            }
            header {
                    padding: 2em 0;
                    border-bottom: 1px solid #cecece;
                    overflow: hidden;
            }
            header h1 {
                    font-size: 2em;
            }
            header h1 small:before  {
                    content: "|";
                    margin: 0 0.5em;
                    font-size: 1.6em;
            }
            footer {
                   background: #ccc;
                    color: #0003;
            }
            footer p {
                    padding: 0.5em 1em 0.5em 0;
                    margin: 0;        
            }
            .bottom-border {
                    border-bottom: 1px solid #cecece;
            }

            a:hover img {
                    box-shadow: 0 0 10px 0 #aaa;
                    cursor: pointer;
            }

    </style>
    </head>
    <body>
        <?php
        include('menu.php');        
        include('multimedia.html');
        include('footer.php');
        ?>
    </body>
</html>
