<script context="module" lang="ts">
  import Layout from '../Layout.svelte'
  export const layout = Layout
</script>

<script lang="ts">
import { zroute } from '../../helpers';
    import { useForm, inertia } from "@inertiajs/inertia-svelte";
    import TimePeriod from "../../components/timePeriod.svelte";
    import type { ActivityPeriod, PlantType } from "../../types";

    export let plant: PlantType | null = null;

    let form = useForm({
        name: plant?.name,
        scientific_name: plant?.scientific_name,
        botanic_family: plant?.botanic_family,
        cultivar: plant?.cultivar,
        plant_spacing: plant?.plant_spacing,
        row_spacing: plant?.row_spacing,
        sowing_depth: plant?.sowing_depth,
        germination_days: plant?.germination_days,
        days_to_maturity: plant?.days_to_maturity,
        height: plant?.height,
        diameter: plant?.diameter,
        temperature: plant?.temperature,
        is_root: plant?.is_root,
        soil_condition: plant?.soil_condition,
        light_requirement: plant?.light_requirement,
        note: plant?.note,
        seed_periods: plant?.seed_periods || [],
        sow_periods: plant?.sow_periods || [],
        transplant_periods: plant?.transplant_periods || [],
        harvest_periods: plant?.harvest_periods || [],
    });

    // everything in cursive is our info, normal text is just normal info

    function handleSubmit() {
        if (plant?.id) {
            $form.put(zroute('plant.update', plant.id), plant);
        } else {
            $form.post(zroute('plant.store'), plant);
        }
    }

    function handleNewPeriod(event: any, listName: string, index: number) {
        const newPeriod: ActivityPeriod = event.detail.period;
        const list = [...$form[listName]];
        list[index] = newPeriod;
        $form[listName] = list;
    }

    function removePeriod(listName: string, index: number) {
        const list = [...$form[listName]];
        list[index] = null;
        $form[listName] = list.filter((x) => !!x);
    }

    function addNewPeriod(listName: string) {
        const newPeriod: ActivityPeriod = {
            start_month: 4,
            end_month: 6,
            start_time: "START",
            end_time: "END",
        };
        const list = [...$form[listName]];
        list.push(newPeriod);
        $form[listName] = list;
    }
</script>

<div>
    <h1>
        {#if plant?.id}
            Edit plant
        {:else}
            Create a new plant
        {/if}
    </h1>

    <form on:submit|preventDefault={handleSubmit}>
        <fieldset>
            <label for="name">Name*:</label>
            <input type="text" bind:value={$form.name} />
        </fieldset>

        <fieldset>
            <label for="scientific_name">Scientific name:</label>
            <input type="text" bind:value={$form.scientific_name} />
        </fieldset>

        <fieldset>
            <label for="botanic_family">Botanical family:</label>
            <input type="text" bind:value={$form.botanic_family} />
        </fieldset>

        <fieldset>
            <label for="cultivar">Cultivar:</label>
            <input type="text" bind:value={$form.cultivar} />
        </fieldset>

        <fieldset>
            <label for="plant_spacing">Plant spacing <small>(cm)</small>:</label
            >
            <input type="number" bind:value={$form.plant_spacing} />
        </fieldset>

        <fieldset>
            <label for="row_spacing">Row spacing <small>(cm)</small>:</label>
            <input type="number" bind:value={$form.row_spacing} />
        </fieldset>

        <fieldset>
            <label for="sowing_depth">Sowing depth <small>(cm)</small>:</label>
            <input type="number" bind:value={$form.sowing_depth} />
        </fieldset>

        <fieldset>
            <label for="germination_days">Germination days:</label>
            <input type="number" bind:value={$form.germination_days} />
        </fieldset>

        <fieldset>
            <label for="days_to_maturity">Days to maturity:</label>
            <input type="number" bind:value={$form.days_to_maturity} />
        </fieldset>

        <fieldset>
            <label for="height">Height <small>(cm)</small>:</label>
            <input type="number" bind:value={$form.height} />
        </fieldset>

        <fieldset>
            <label for="diameter">Diameter <small>(cm)</small>:</label>
            <input type="number" bind:value={$form.diameter} />
        </fieldset>

        <fieldset>
            <label for="temperature">Temperature <small>(c)</small>:</label>
            <input type="number" bind:value={$form.temperature} />
        </fieldset>

        <fieldset>
            Is root
            <label>
                <input
                    type="radio"
                    bind:group={$form.is_root}
                    name="is_root"
                    value={1}
                />
                Yes
            </label>

            <label>
                <input
                    type="radio"
                    bind:group={$form.is_root}
                    name="is_root"
                    value={0}
                />
                No
            </label>
        </fieldset>

        <fieldset>
            <label for="light_requirement">Light requirement:</label>
            <select bind:value={$form.light_requirement}>
                <option value="FULL_SUN">FULL SUN</option>
                <option value="PART_SUN">PART SUN</option>
                <option value="PART_SHADE">PART SHADE</option>
                <option value="FULL_SHADE">FULL SHADE</option>
            </select>
        </fieldset>

        <fieldset>
            <label for="soil_condition">Soil condition:</label>
            <input type="text" bind:value={$form.soil_condition} />
        </fieldset>

        <fieldset>
            <label for="note">Note:</label>
            <textarea bind:value={$form.note} rows="4" />
        </fieldset>

        <fieldset class="periods">
            SEED PERIODS
            {#each $form.seed_periods as period, i}
                <TimePeriod
                    {period}
                    on:message={(event) =>
                        handleNewPeriod(event, "seed_periods", i)}
                />

                <button
                    type="button"
                    on:click={() => removePeriod("seed_periods", i)}>X</button
                >
            {/each}

            <button type="button" on:click={() => addNewPeriod("seed_periods")}
                >ADD</button
            >
        </fieldset>

        <fieldset class="periods">
            TRANSPLANT PERIODS
            {#each $form.transplant_periods as period, i}
                <TimePeriod
                    {period}
                    on:message={(event) =>
                        handleNewPeriod(event, "transplant_periods", i)}
                />
                <button
                    type="button"
                    on:click={() => removePeriod("transplant_periods", i)}
                    >X</button
                >
            {/each}

            <button
                type="button"
                on:click={() => addNewPeriod("transplant_periods")}>ADD</button
            >
        </fieldset>

        <fieldset class="periods">
            SOW PERIODS
            {#each $form.sow_periods as period, i}
                <TimePeriod
                    {period}
                    on:message={(event) =>
                        handleNewPeriod(event, "sow_periods", i)}
                />

                <button
                    type="button"
                    on:click={() => removePeriod("sow_periods", i)}>X</button
                >
            {/each}

            <button type="button" on:click={() => addNewPeriod("sow_periods")}
                >ADD</button
            >
        </fieldset>

        <fieldset class="periods">
            HARVEST PERIODS
            {#each $form.harvest_periods as period, i}
                <TimePeriod
                    {period}
                    on:message={(event) =>
                        handleNewPeriod(event, "harvest_periods", i)}
                />

                <button
                    type="button"
                    on:click={() => removePeriod("harvest_periods", i)}
                    >X</button
                >
            {/each}

            <button
                type="button"
                on:click={() => addNewPeriod("harvest_periods")}>ADD</button
            >
        </fieldset>

        <hr />
        <button>Save</button>

        <a use:inertia href={zroute('plant.index')}>Cancel</a>
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

    input,
    textarea {
        vertical-align: middle;
    }

    textarea,
    select,
    input:not([type="radio"]):not([type="checkbox"]) {
        margin: 0 0 0 5px;
        padding-top: 0.2em;
        padding-bottom: 0.2em;
    }

    .periods {
        flex-direction: column;
        align-items: flex-start;
        justify-content: center;
    }
</style>
