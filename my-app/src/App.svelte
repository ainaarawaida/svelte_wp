<script>
  import Header from "./components/Header.svelte";
  import Footer from "./components/Footer.svelte";
  import Daftar from "./components/Daftar.svelte";
  import SenaraiCalon from "./components/SenaraiCalon.svelte";
  import logo from "./assets/svelte.png";
  import Counter from "./lib/Counter.svelte";

  // import "./luq.js";
  // $: console.log(window.location.href);

  var luqscript = document.createElement("script"); // create a script DOM node
  luqscript.src =
    "https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"; // set its src to the provided URL
  document.body.appendChild(luqscript);

  var luqscript = document.createElement("script"); // create a script DOM node
  luqscript.src = `${import.meta.env.BASE_URL}script/luq.js`; // set its src to the provided URL
  document.body.appendChild(luqscript);

  // tabs
  let activeItem = "daftar";
  const tabChange = (e) => {
    console.log("change", activeItem);
    activeItem = e.detail;
  };
  const handleAdd = () => {
    activeItem = "Senarai_Calon";
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
    <Header {activeItem} on:tabChange={tabChange} />
    <!-- <img src={logo} alt="Svelte Logo" /> -->
    {#if activeItem === "daftar"}
      <Daftar on:add={handleAdd} />
    {:else if activeItem === "Senarai_Calon"}
      <SenaraiCalon />
    {/if}
  </main>

  <footer />
</div>
