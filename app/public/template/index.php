<html>
<head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans);

        body {
            font-family: 'Open Sans', sans-serif;
            background: #151837;
            width: 90%;
            margin: 0 auto;
            padding: 20px 0 6em;
        }

        h1 {
            font-size: 3em;
            color: #fefefe;
            text-transform: lowercase;
        }

        .wrapper {
            margin: 1em 0;
        }

        a, a:visited, a:hover, a:active {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            position: relative;
            transition: 0.5s color ease;
            text-decoration: none;
            color: #81b3d2;
            font-size: 2.5em;
        }

        a:hover {
            color: #d73444;
        }

        a.before:before, a.after:after {
            content: "";
            transition: 0.5s all ease;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            position: absolute;
        }

        a.before:before {
            top: -0.25em;
        }

        a.after:after {
            bottom: -0.25em;
        }

        a.before:before, a.after:after {
            height: 5px;
            height: 0.35rem;
            width: 0;
            background: #d73444;
        }

        a.first:after {
            left: 0;
        }


    </style>
</head>
<body>
<h1>List template</h1>

</body>
</html>
<?php
if ($handle = opendir('.')) {
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/";

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {
            echo '<div class="wrapper"><a class="first after"  href="' .$actual_link. $entry . '" target="_blank" >' . $entry . '</a></div>';
        }
    }

    closedir($handle);
}