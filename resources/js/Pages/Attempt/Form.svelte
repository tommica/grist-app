<script context="module" lang="ts">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { zroute } from "../../helpers";
    import { useForm, inertia } from "@inertiajs/inertia-svelte";
    import type { AttemptType, PlantType } from "../../types";
    export let attempt: AttemptType | null = null;
    export let plants: PlantType[] = [];
    import SveltyPicker from "svelty-picker";

    let form = useForm({
        plant_id: attempt?.plant?.id,
        seeded_at: attempt?.seeded_at,
        transplanted_at: attempt?.transplanted_at,
        completed_at: attempt?.completed_at,
        note: attempt?.note,
    });

    // everything in cursive is our info, normal text is just normal info

    function handleSubmit() {
        if (attempt?.id) {
            $form.put(zroute("attempt.update", attempt.id), attempt);
        } else {
            $form.post(zroute("attempt.store"), attempt);
        }
    }
</script>

<div>
    <h1>
        {#if attempt?.id}
            Edit attempt
        {:else}
            Create a new attempt
        {/if}
    </h1>

    <form on:submit|preventDefault={handleSubmit}>
        <fieldset>
            <label for="plant_id">Plant*:</label>
            <select bind:value={$form.plant_id}>
                {#each plants as plant}
                    <option value={plant.id}>{plant.name}</option>
                {/each}
            </select>
        </fieldset>

        <fieldset>
            <label for="seeded_at">Seeded at*:</label>
            <SveltyPicker
                name="seeded_at"
                format="yyyy-mm-dd"
                bind:value={$form.seeded_at}
            />
        </fieldset>

        <fieldset>
            <label for="transplanted_at">Transplanted at:</label>
            <SveltyPicker
                name="transplanted_at"
                format="yyyy-mm-dd"
                bind:value={$form.transplanted_at}
            />
        </fieldset>

        <fieldset>
            <label for="completed_at">Completed at:</label>
            <SveltyPicker
                name="completed_at"
                format="yyyy-mm-dd"
                bind:value={$form.completed_at}
            />
        </fieldset>

        <fieldset>
            <label for="name">Note:</label>
            <textarea bind:value={$form.note} rows="4" />
        </fieldset>

        <hr />
        <button>Save</button>

        <a use:inertia href={zroute("attempt.index")}>Cancel</a>
    </form>
</div>

<style>
    fieldset {
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 8px;
        display: flex;
        align-items: center;
    }

    textarea,
    input {
        vertical-align: middle;
    }

    textarea,
    input:not([type="radio"]):not([type="checkbox"]) {
        margin: 0 0 0 5px;
        padding-top: 0.2em;
        padding-bottom: 0.2em;
    }
</style>
