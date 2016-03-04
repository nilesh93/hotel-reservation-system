<!DOCTYPE html>
<html>
    <head>
        <title>Unauthorized Action.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Unauthorized Action.</div>
                <div class="content">
                    <b><big><span style="color: indianred">Do not try to access unauthorized pages using URL or using back/forward buttons </span></big></b>
                     <br><br>
                    <button onclick="document.location.href = '{{ url('/') }}'"><b>Return Home</b></button>
                </div>
            </div>
        </div>
    </body>
</html>
