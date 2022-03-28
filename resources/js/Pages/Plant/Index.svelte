<script context="module" lang="ts">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { Link } from "@inertiajs/inertia-svelte";
    import { Inertia } from "@inertiajs/inertia";
    import type { PlantType } from "../../types";
    import { zroute } from "../../helpers";

    export let plants: PlantType[] = [];

    function handleDelete(plant: PlantType) {
        if (confirm(`Are you sure you want to delete ${plant.name}`)) {
            const id = plant?.id || "";
            const url = zroute("plant.destroy", id);
            Inertia.delete(url);
        }
    }
</script>

<div>
    <table>
        <thead>
            <tr>
                <th>name</th>
                <th>&nbsp;</th>
            </tr>
        </thead>

        <tbody>
            {#each plants as plant}
                <tr>
                    <td>{plant.name}</td>
                    <td>
                        <Link href={zroute("plant.show", plant.id)}>show</Link>
                        <Link href={zroute("plant.edit", plant.id)}>edit</Link>
                        <a
                            href="."
                            on:click|preventDefault={() => handleDelete(plant)}
                        >
                            delete
                        </a>
                    </td>
                </tr>
            {/each}
        </tbody>
    </table>

    <Link href={zroute("plant.create")}>create</Link>
</div>

<style>
</style>
