    <head>
        <title>Tee It Up!</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Charm' rel='stylesheet'>
        <style>
            html
            {
                /*text-align:center;*/
                background-color:black;
            }
            
            /* !important Overrides any a tag styling on other pages where this page is included*/
            a.header
            {
                text-decoration:none !important;
            }
            
            a.header:visited
            {
                color:black !important; 
                text-decoration:none !important;
            }

            #header
            {
                /*font-family:Georgia;*/
                color:black;
                background-color:seagreen;
                /*top:0;//To make header stick to top*/
                position: -webkit-sticky; /* In case run on Safari */
                position:sticky;
                border-style:ridge;
                border-color: white;
                border-radius: 10px;
                /*height:200px;*/
                padding:3% 0;
            }
        </style>

    </head>


    <body>
        <a class="header" target="_self" href="index.php">
            <div id="header">
                <span style="font-size:430%;">&ensp;<span style="text-decoration: underline; text-decoration-color: black; font-family: 'Charm';">Tee It Up!</span></span><span style="font-size:200%">&ensp;A simple solution to book and manage your golf tee times.</span>
                <!--&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;<img id="logo" src="teeItUpLogo.png" alt="Tee It Up">-->
            </div>
        </a>
    </body>
</html>

