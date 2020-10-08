<!-- Header for guest -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forums</title>

    <!-- MaterializeCSS -->
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Google's Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Author's own CSS -->
    <link rel="stylesheet" href="css/helper.css">
    <link rel="stylesheet" href="css/reset.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="light-blue darken-2">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo margin-left-sm">Forums</a>

            <!-- Hamburger menu which will appears on medium screen (tablet) and down -->
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <ul class="right hide-on-med-and-down">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Create post</a></li>
                <li><a href="#">Register</a></li>
            </ul>
        </div>
    </nav>

    <!-- Below list will be shown instead on medium screen (tablet) and down -->
    <ul class="sidenav" id="mobile-demo">
        <li><a href="#">Home</a></li>
        <li><a href="#">Create post</a></li>
        <li><a href="#">Register</a></li>
    </ul>