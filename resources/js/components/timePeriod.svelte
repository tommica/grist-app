<script lang="ts">
    import type { ActivityPeriod } from "../types";
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();
    export let period: ActivityPeriod;

    function handleUpdate() {
        dispatch("updatePeriod", {
            period: period,
        });
    }
</script>

<fieldset class="timePeriod">
    <div>
        <label for="start_month">Start month</label>
        <input
            type="number"
            min="1"
            max="12"
            step="1"
            bind:value={period.start_month}
            on:input={handleUpdate}
        />
    </div>

    <div>
        <label for="start_time">Start time</label>
        <select bind:value={period.start_time} on:input={handleUpdate}>
            <option value="START">START</option>
            <option value="MID">MID</option>
            <option value="END">END</option>
        </select>
    </div>

    <div>
        <label for="">End month</label>
        <input
            type="number"
            min="1"
            max="12"
            step="1"
            bind:value={period.end_month}
            on:input={handleUpdate}
        />
    </div>

    <div>
        <label for="end_time">End time</label>
        <select bind:value={period.end_time} on:input={handleUpdate}>
            <option value="START">START</option>
            <option value="MID">MID</option>
            <option value="END">END</option>
        </select>
    </div>
</fieldset>
