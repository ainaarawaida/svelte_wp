<script>
    import { fade, slide, scale } from "svelte/transition";
    import { flip } from "svelte/animate";
    // import PollStore from "../stores/pollStore.js";
    import { onDestroy } from "svelte";
    import { onMount } from "svelte";
    // $: console.log("hehe", $PollStore);

    // const unsubscribe = PollStore.subscribe((value) => {
    //     localStorage.user = JSON.stringify(value);
    // });

    // onDestroy(unsubscribe);
    let PollStore;

    onMount(async function () {
        const dataanak = new FormData();
        dataanak.append("action", "luqvote_daftarcalon");
        dataanak.append("fungsi", "senaraicalon");
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

        PollStore = await ticket;
        console.log("ticket senarai calon", await ticket);
    });

    const deletecalon = (id) => {
        console.log("deletecalon", id);
    };
</script>

<main class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">Calon Pengerusi</h6>
        {#each PollStore as poll (poll.ID)}
            <div class="d-flex text-muted pt-3">
                <svg
                    class="bd-placeholder-img flex-shrink-0 me-2 rounded"
                    width="32"
                    height="32"
                    xmlns="http://www.w3.org/2000/svg"
                    role="img"
                    aria-label="Placeholder: 32x32"
                    preserveAspectRatio="xMidYMid slice"
                    focusable="false"
                    ><title>Placeholder</title><rect
                        width="100%"
                        height="100%"
                        fill="#007bff"
                    /><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text
                    ></svg
                >

                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">
                            {poll.post_content.nama}</strong
                        >
                        <progress id="file" value="32" max="100">
                            32%
                        </progress>
                    </div>
                    <span class="d-block">{poll.post_content.jawatan}</span>
                    <span class="button danger">Delete</span>
                </div>
            </div>
        {:else}
            <!-- this block renders when photos.length === 0 -->
            <p>loading...</p>
        {/each}
    </div>
</main>
