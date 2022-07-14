<script>
    import logo from "/logosuraux.png";

    import { createEventDispatcher } from "svelte";
    let dispatch = createEventDispatcher();

    export let activeItem;
    let statuslogin = frontend_ajax_object.statuslogin.ID;
</script>

<div class="d-flex flex-column bd-highlight mb-3">
    <div class="d-flex justify-content-center">
        <img src={logo} alt="Surau Al-Baiti" />
    </div>
    <div class="d-flex justify-content-center">
        <h1>Surau Al-Baiti</h1>
    </div>
    <div class="d-flex justify-content-center">
        <ul class="nav nav-pills p-2 bd-highlight">
            {#if statuslogin !== 0}
                <li
                    class="nav-item"
                    on:click={() => dispatch("tabChange", "DaftarJawatan")}
                >
                    <button
                        class="nav-link {activeItem == 'DaftarJawatan'
                            ? 'active'
                            : ''}"
                        aria-current="page">Daftar Jawatan</button
                    >
                </li>

                <li
                    class="nav-item"
                    on:click={() => dispatch("tabChange", "daftar")}
                >
                    <button
                        class="nav-link {activeItem == 'daftar'
                            ? 'active'
                            : ''}"
                        aria-current="page">Daftar Calon</button
                    >
                </li>
            {/if}
            <li
                class="nav-item"
                on:click={() => dispatch("tabChange", "Senarai_Calon")}
            >
                <button
                    class="nav-link {activeItem == 'Senarai_Calon'
                        ? 'active'
                        : ''}"
                    aria-current="page">Senarai Calon</button
                >
            </li>
        </ul>
    </div>
</div>

<!-- <ul class="nav nav-pills">
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
</ul> -->
