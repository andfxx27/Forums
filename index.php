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
            <a href="#" class="brand-logo margin-left-xsm">Forums</a>

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

    <!-- Bunch of past forum post -->
    <main class="row">
        <!-- List represent several number of post -->
        <div class="col s9 left">
            <h1>Posts</h1>
            <ul class="collection">
                <li class="collection-item avatar">
                    <i class="material-icons circle">folder</i>
                    <span class="title"><a href="#">Title 1</a></span>
                    <p>Forum's headline 1</p>
                    <p class="truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum labore repudiandae beatae odio culpa voluptatibus obcaecati nulla nesciunt quam in similique animi commodi soluta illo, iusto aperiam sed aut nemo deleniti quae sapiente cumque nobis. Illum distinctio veritatis consequatur fugit consectetur? Odio unde dolorum voluptate adipisci libero dolor aut at.</p>
                    <a href="#" class="secondary-content"><i class="material-icons">keyboard_arrow_right</i></a>
                </li>
                <li class="collection-item avatar">
                    <i class="material-icons circle">folder</i>
                    <span class="title"><a href="#">Title 2</a></span>
                    <p>Forum's headline 2</p>
                    <p class="truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt nam delectus, harum alias quod quidem reprehenderit vitae placeat maxime laboriosam. Repudiandae doloremque debitis sunt officiis ratione veniam, iusto possimus nulla tempore aperiam ipsum molestias iure exercitationem, fugiat rerum. Enim alias ab corporis, dolore amet exercitationem tenetur sed iste illo est.</p>
                    <a href="#" class="secondary-content"><i class="material-icons">keyboard_arrow_right</i></a>
                </li>
            </ul>
        </div>

        <!-- List forum post from most likes to least likes count -->
        <div class="col s3 right hide-on-med-and-down">
            <h2>Popular</h2>
            <div class="divider"></div>
            <div class="section">
                <h5>Section 1</h5>
                <p>Stuff</p>
            </div>
            <div class="divider"></div>
            <div class="section">
                <h5>Section 2</h5>
                <p>Stuff</p>
            </div>
            <div class="divider"></div>
            <div class="section">
                <h5>Section 3</h5>
                <p>Stuff</p>
            </div>
        </div>
    </main>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Custom JS -->
    <script src="./js/index.js"></script>
</body>

</html>