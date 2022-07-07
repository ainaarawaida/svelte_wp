<script>
  import Header from "./components/Header.svelte";
  import Daftar from "./components/Daftar.svelte";
  import logo from "./assets/svelte.png";
  import Counter from "./lib/Counter.svelte";

  // import "./luq.js";

  var luqscript = document.createElement("script"); // create a script DOM node
  luqscript.src =
    "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"; // set its src to the provided URL
  document.body.appendChild(luqscript);

  // tabs
  let items = ["Current Polls", "Add New Poll"];
  let activeItem = "Current Polls";
  const tabChange = (e) => (activeItem = e.detail);
  const handleAdd = () => {
    activeItem = "Current Polls";
  };
</script>

<svelte:head>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    crossorigin="anonymous"
  />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
  />
</svelte:head>

<div class="container-fluid">
  <main>
    <Header {activeItem} {items} on:tabChange={tabChange} />
    <!-- <img src={logo} alt="Svelte Logo" /> -->
    <Daftar />
  </main>

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; 2017–2022 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
