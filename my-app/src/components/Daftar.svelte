<script>
    import { createEventDispatcher } from "svelte";
    let dispatch = createEventDispatcher();
    import PollStore from "../stores/pollStore.js";
    import { onMount } from "svelte";

    // var luqscript = document.createElement("script"); // create a script DOM node
    // luqscript.src = "https://cdn.startbootstrap.com/sb-forms-latest.js"; // set its src to the provided URL
    // document.body.appendChild(luqscript);

    let fields = { nama: "", jawatan: "" };
    let errors = { nama: "", jawatan: "" };
    let valid = false;

    const submitHandler = () => {
        valid = true;
        // console.log(fields);
        if (fields.nama.trim().length < 5) {
            valid = false;
            errors.nama = "Nama must be at least 5 chars long";
        } else {
            errors.nama = "";
        }

        if (valid) {
            // console.log($PollStore);
            // let poll = { ...fields, id: Math.random(), votes: 0 };
            // $PollStore = [poll, ...$PollStore];

            const dataanak = new FormData();
            dataanak.append("action", "luqvote_daftarcalon");
            dataanak.append("nama", fields.nama);
            dataanak.append("jawatan", fields.jawatan);
            let ticket = new Promise(function (myResolve, myReject) {
                fetch(frontend_ajax_object.ajaxurl, {
                    method: "POST",
                    // or 'PUT'
                    body: dataanak,
                })
                    .then((response) => response.json())
                    .then((data) => {
                        console.log("tiket", data);
                        myResolve(data);
                        alert("Berjaya Daftar");
                        dispatch("add");
                    });
            });
        }
    };

    let senaraijawatan = [];

    onMount(async () => {
        const dataanak = new FormData();
        dataanak.append("action", "luqvote_daftarcalon");
        dataanak.append("fungsi", "senaraijawatan");
        let ticket = new Promise(function (myResolve, myReject) {
            fetch(frontend_ajax_object.ajaxurl, {
                method: "POST",
                // or 'PUT'
                body: dataanak,
            })
                .then((response) => response.json())
                .then((data) => {
                    // console.log("tiketsc", data);
                    myResolve(data);
                });
        });

        senaraijawatan = await ticket;
    });
    // $: console.log("senaraijawatan", senaraijawatan);
</script>

<div class="container px-5 my-5">
    <form id="contactForm" on:submit|preventDefault={() => submitHandler()}>
        <div class="form-floating mb-3">
            <input
                required
                class="form-control {errors.nama ? 'is-invalid' : ''}"
                id="nama"
                type="text"
                placeholder="Nama"
                data-sb-validations="required"
                bind:value={fields.nama}
            />
            <label for="nama">Nama</label>
            <div class="error alert">{errors.nama}</div>
        </div>
        <div class="form-floating mb-3">
            <select
                class="form-select"
                id="jawatan"
                aria-label="Jawatan"
                bind:value={fields.jawatan}
                required
            >
                {#each senaraijawatan as jwtn (jwtn)}
                    <option value={jwtn.substring(2)}
                        >{jwtn.substring(2)}</option
                    >
                {:else}
                    <option value="">tiada</option>
                {/each}
            </select>
            <label for="jawatan">Jawatan</label>
        </div>
        <div class="d-none" id="submitSuccessMessage">
            <div class="text-center mb-3">
                <div class="fw-bolder">Form submission successful!</div>
                <p>To activate this form, sign up at</p>
                <a href="https://startbootstrap.com/solution/contact-forms"
                    >https://startbootstrap.com/solution/contact-forms</a
                >
            </div>
        </div>
        <div class="d-none" id="submitErrorMessage">
            <div class="text-center text-danger mb-3">
                Error sending message!
            </div>
        </div>
        <div class="d-grid">
            <button
                class="btn btn-primary btn-lg"
                id="submitButton"
                type="submit">Hantar</button
            >
        </div>
    </form>
</div>
