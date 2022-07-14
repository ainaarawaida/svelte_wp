<script>
    import { fade, slide, scale } from "svelte/transition";
    import { flip } from "svelte/animate";
    // import PollStore from "../stores/pollStore.js";
    import { onDestroy } from "svelte";
    import { onMount } from "svelte";
    let PollStore = [];

    const uid = function () {
        return Date.now().toString(36) + Math.random().toString(36).substr(2);
    };

    // localStorage.setItem("lastname", "Smith");
    let getdevid = localStorage.getItem("devid");
    if (getdevid === null) {
        localStorage.setItem("devid", uid());
    }
    getdevid = localStorage.getItem("devid");
    let luqinterval;
    onMount(async () => {
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

        luqinterval = setInterval(async () => {
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
            // console.log("salam");
        }, 60 * 1000);
    });

    onDestroy(() => {
        clearInterval(luqinterval);
    });

    const deletecalon = async (id) => {
        // console.log("deletecalon", id);

        const dataanak = new FormData();
        dataanak.append("action", "luqvote_daftarcalon");
        dataanak.append("fungsi", "deletecalon");
        dataanak.append("post_id", id);
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

    // $: console.log("PollStore2xx", PollStore);

    let myfilter = (data, data2) => {
        return data.filter((data) => {
            return data.post_content.jawatan == data2;
        });
    };

    const votecalon = async (id, jwtn) => {
        // console.log("deletecalon", id);

        const dataanak = new FormData();
        dataanak.append("action", "luqvote_daftarcalon");
        dataanak.append("fungsi", "votecalon");
        dataanak.append("post_id", id);
        dataanak.append("getdevid", `${getdevid}_${jwtn}`);
        dataanak.append("getjawatan", `${jwtn}`);
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
        alert("success vote");
    };

    let statuslogin = frontend_ajax_object.statuslogin.ID;
</script>

<main class="container">
    {#if senaraijawatan.length !== 0}
        {#each senaraijawatan as jwtn (jwtn)}
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">
                    Calon {jwtn.substring(2)}
                </h6>

                {#each myfilter(PollStore, jwtn.substring(2)) as poll (poll.ID)}
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
                            /><text x="50%" y="50%" fill="#007bff" dy=".3em"
                                >32x32</text
                            ></svg
                        >

                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark">
                                    {poll.post_content.nama}
                                </strong>
                                <progress
                                    id="file"
                                    value={poll.vote}
                                    max={poll.totalvote}
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="total vote-{poll.vote}"
                                />
                            </div>
                            <span class="d-block"
                                >{poll.post_content.jawatan}</span
                            >
                            {#if statuslogin !== 0}
                                <button
                                    class="btn btn-danger"
                                    on:click={() => deletecalon(poll.ID)}
                                    >Delete</button
                                >
                            {/if}
                            <button
                                class="btn btn-primary"
                                on:click={() =>
                                    votecalon(
                                        poll.ID,
                                        poll.post_content.jawatan
                                    )}>Undi</button
                            >
                        </div>
                    </div>
                {:else}
                    <!-- this block renders when photos.length === 0 -->
                    <p>Tiada data</p>
                {/each}
            </div>
        {:else}
            <!-- this block renders when photos.length === 0 -->
            <p>Tiada data</p>
        {/each}
    {:else}
        <p>No data to show</p>
    {/if}
</main>
