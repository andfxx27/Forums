<?php require_once("templates/header_guest.php"); ?>

<!-- Bunch of past forum post -->
<main class="row container">
    <!-- List represent several number of post -->
    <!-- On small & medium screen, takes up all 12-parts column -->
    <!-- On large screen, takes up 9-parts/12 of the entire row -->
    <div class="col s12 m12 l9 left">
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
    <!-- On large screen, takes up 3-parts/12 of the entire row -->
    <div class="col l3 right hide-on-med-and-down">
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

<?php require_once("templates/footer.php"); ?>