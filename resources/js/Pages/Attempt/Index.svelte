<script context="module" lang="ts">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { Link } from "@inertiajs/inertia-svelte";
    import Grid from "gridjs-svelte";
    import { html } from "gridjs";
    import type { AttemptType } from "resources/js/types";
    import { formatDate } from "../../helpers";
    import { zroute } from "../../helpers";

    export let items: any;

    const columns = [
        {
            name: "ID",
            hidden: true,
            id: "id",
        },
        {
            name: "Plant ID",
            hidden: true,
            id: "plant.id",
            data: (row: AttemptType) => row.plant.id,
        },
        {
            name: "Plant",
            sort: true,
            id: "plant.name",
            data: (row: AttemptType) => row.plant.name,
        },
        {
            name: "Seeded at",
            sort: true,
            id: "seeded_at",
            data: (row: AttemptType) => formatDate(row.seeded_at),
        },
        {
            name: "Transplant at",
            sort: true,
            id: "transplant_at",
            data: (row: AttemptType) => formatDate(row.transplant_at),
        },
        {
            name: "Transplanted at",
            sort: true,
            id: "transplanted_at",
            data: (row: AttemptType) => formatDate(row.transplanted_at),
        },
        {
            name: "Harvest at",
            sort: true,
            id: "harvest_at",
            data: (row: AttemptType) => formatDate(row.harvest_at),
        },
        {
            name: "Zone",
            sort: true,
            id: "zone",
            data: (row: AttemptType) => "zone todo",
        },
        {
            name: "Actions",
            id: "actions",
            data: (row: AttemptType) => row.id,
            formatter: (_, row) => html(`<a href='${zroute('attempt.show', row.cells[0].data)}'>Show</a>`)
        },
    ];
</script>

<div>
    <Grid data={items} {columns} />
    <Link href={zroute("attempt.create")}>create</Link>
</div>

<style>
</style>
