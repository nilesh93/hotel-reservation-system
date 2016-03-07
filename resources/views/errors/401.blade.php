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

        <script>
            //this function used to trigger whether the user clicks the back buttom
            window.onload = function () {

                if (typeof history.pushState === "function") {
                    history.pushState("jibberish", null, null);
                    window.onpopstate = function () {
                        history.pushState('newjibberish', null, null);


                        window.location.href = "{{ url('/') }}";


                        // Handle the back (or forward) buttons here
                        // Will NOT handle refresh, use onbeforeunload for this.
                    };
                }
                else {
                    var ignoreHashChange = true;
                    window.onhashchange = function () {
                        if (!ignoreHashChange) {
                            ignoreHashChange = true;
                            window.location.hash = Math.random();
                            // Detect and redirect change here
                            // Works in older FF and IE9
                            // * it does mess with your hash symbol (anchor?) pound sign
                            // delimiter on the end of the URL
                        }
                        else {
                            ignoreHashChange = false;
                        }
                    };
                }
            };

        </script>
    </body>
</html>
