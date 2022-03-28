<script lang="ts">
    import { inertia } from "@inertiajs/inertia-svelte";
    import Logo from "../components/logo.svelte";
    import {zroute} from "../helpers"
</script>

<main>
    <header>
        <a use:inertia href="/">
            <Logo width="100px" />
        </a>

        <a use:inertia href={zroute('plant.index')}>Plants</a>
        <a use:inertia href={zroute('attempt.index')}>Attempts</a>
        <a use:inertia href={zroute('plant.index')}>Zones</a>
    </header>
    <article>
        <slot />
    </article>
</main>

<style>
    header {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    a {
        margin: 0 5px;
        display: inline-block;
    }
</style>
