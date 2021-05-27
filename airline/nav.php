<nav class="nav-header">
    <h1>Airline App</h1>
    <ul>
        <li><a href="/airline" <?php if ($page == "HOME") { echo 'class="active"'; } ?>>Home</a></li>
        <li><a href="/airline/add_flight" <?php if ($page == "ADD_FLIGHT") { echo 'class="active"'; } ?>>Add a flight</a></li>
        <li><a href="/airline/update_flight" <?php if ($page == "UPDATE_FLIGHT") { echo 'class="active"'; } ?>>Update a flight</a></li>
    </ul>
</nav>