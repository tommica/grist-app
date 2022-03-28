<script context="module" lang="ts">
  import Layout from '../Layout.svelte'
  export const layout = Layout
</script>

<script lang="ts">
import { zroute } from '../../helpers';
    import { Link } from "@inertiajs/inertia-svelte";
    import { Inertia } from "@inertiajs/inertia";
    import type { PlantType } from "../../types";

    export let plant: PlantType;

    function handleDelete() {
        if (confirm(`Are you sure you want to delete ${plant.name}`)) {
            Inertia.delete(zroute('plant.destroy', plant.id));
        }
    }
</script>

<div>
    <Link href={zroute('plant.index')}>Back</Link>
    <h1>{plant.name}</h1>

    <hr />

    <Link href={zroute('plant.edit', plant.id)}>Edit</Link>
    <a href="." on:click|preventDefault={handleDelete}>Delete</a>
</div>

<style>
</style>
