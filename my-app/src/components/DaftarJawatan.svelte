<script>
    let fields = { jawatan: "" };
    let errors = { jawatan: "" };
    let valid = false;

    const submitHandler = async () => {
        valid = true;
        const dataanak = new FormData();
        dataanak.append("action", "luqvote_daftarcalon");
        dataanak.append("jawatan", fields.jawatan);
        dataanak.append("fungsi", "DaftarJawatan");
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
                });
        });
    };
</script>

<div class="container px-5 my-5">
    <form id="contactForm" on:submit|preventDefault={() => submitHandler()}>
        <div class="form-floating mb-3">
            <input
                required
                class="form-control {errors.jawatan ? 'is-invalid' : ''}"
                id="nama"
                type="text"
                placeholder="Nama"
                data-sb-validations="required"
                bind:value={fields.jawatan}
            />
            <label for="nama">Jenis Jawatan</label>
            <div class="error alert">{errors.jawatan}</div>
        </div>
        <div class="d-grid">
            <button
                class="btn btn-primary btn-lg"
                id="submitButton"
                type="submit">Simpan</button
            >
        </div>
    </form>
</div>
