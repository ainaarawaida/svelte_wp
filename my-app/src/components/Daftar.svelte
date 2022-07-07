<script>
    var luqscript = document.createElement("script"); // create a script DOM node
    luqscript.src = "https://cdn.startbootstrap.com/sb-forms-latest.js"; // set its src to the provided URL
    document.body.appendChild(luqscript);
</script>

<div class="container px-5 my-5">
    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
        <div class="form-floating mb-3">
            <input
                class="form-control"
                id="nama"
                type="text"
                placeholder="Nama"
                data-sb-validations="required"
            />
            <label for="nama">Nama</label>
            <div class="invalid-feedback" data-sb-feedback="nama:required">
                Nama is required.
            </div>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" id="jawatan" aria-label="Jawatan">
                <option value="Pengerusi">Pengerusi</option>
                <option value="Tim. Pengerusi">Tim. Pengerusi</option>
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
