<script context="module" lang="ts">
  import Layout from '../Layout.svelte'
  export const layout = Layout
</script>

<script lang="ts">
import { zroute } from '../../helpers';
    import { Link } from "@inertiajs/inertia-svelte";
    import { Inertia } from "@inertiajs/inertia";
    import type { AttemptType } from "../../types";

    export let attempt: AttemptType;

    function handleDelete() {
        if (confirm(`Are you sure you want to delete ${attempt.id}`)) {
            Inertia.delete(zroute('attempt.destroy', attempt.id));
        }
    }
</script>

<div>
    <Link href={zroute('attempt.index')}>Back</Link>
    <h1>{attempt.id}</h1>

    <hr />

    <Link href={zroute('attempt.edit', attempt.id)}>Edit</Link>
    <a href="." on:click|preventDefault={handleDelete}>Delete</a>
</div>

<style>
</style>
