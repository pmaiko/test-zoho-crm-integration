<template>
  <div>
    name: {{ data.name }}

    <a
      href="/"
      class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
    >Home
    </a>

    <Link href="/my" method="post" :data="{ foo: 'asdsadasdasdasd' }">Save</Link>

    <input v-model="query" type="text" />

    {{ new Date() }}
    <Link href="/my" :data="{ query }" preserve-state>Search</Link>
  </div>
</template>
<script setup>
  import { Link } from '@inertiajs/vue3'
  import { ref } from 'vue'

  defineProps({
    data: Object
  })

  const query = ref('')
</script>