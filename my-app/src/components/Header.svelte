<script>
    import logo from "../img/Picture10.jpg";

    import { createEventDispatcher } from "svelte";
    let dispatch = createEventDispatcher();

    export let items;
    export let activeItem;
</script>

<!-- <header>
    <h1>
        <img src={logo} alt="Poll Ninja Logo" />
    </h1>
</header> -->
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/daftar"
            >Daftar Calon</a
        >
    </li>
    <li class="nav-item dropdown">
        <a
            class="nav-link dropdown-toggle"
            data-bs-toggle="dropdown"
            href="#"
            role="button"
            aria-expanded="false">Dropdown</a
        >
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/daftar">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
    </li>
</ul>
