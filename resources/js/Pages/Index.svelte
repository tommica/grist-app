<script context="module" lang="ts">
  import Layout from './Layout.svelte'
  export const layout = Layout
</script>

<script>
export let name = 'blah';
</script>

<style>
h1 {
    color: indigo;
    font-family: 'Calibri', cursive;
    font-size: 3em;
}
</style>

<h1> Svelte greets {name} through inertia </h1>
