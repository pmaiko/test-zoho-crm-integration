<template>
  <div class="p-10 relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <form class="w-4/12 mx-auto" @submit.prevent="onSubmit">
      <div class="text-center text-white mb-12 text-xl font-bold">
        Test Zoho crm integration
      </div>
      <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Account name
        </label>
        <input
          v-model="formData.accountName"
          type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="" />
        <div
          v-if="errors.accountName"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-red-500"
        >
          {{ errors.accountName[0] }}
        </div>
      </div>
      <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Website
        </label>
        <input
          v-model="formData.website"
          type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="" />
        <div
          v-if="errors.website"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-red-500"
        >
          {{ errors.website[0] }}
        </div>
      </div>
      <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Phone
        </label>
        <input
          v-model="formData.phone"
          type="tel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="" />

        <div
          v-if="errors.phone"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-red-500"
        >
          {{ errors.phone[0] }}
        </div>
      </div>
      <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Deal name
        </label>
        <input
          v-model="formData.dealName"
          type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="" />
        <div
          v-if="errors.dealName"
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-red-500"
        >
          {{ errors.dealName[0] }}
        </div>
      </div>
      <div class="mb-5">
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Stage
        </label>
        <input
          v-model="formData.stage"
          type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
          placeholder="" />
      </div>
      <div
        v-if="errors.stage"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-red-500"
      >
        {{ errors.stage[0] }}
      </div>

      <button type="submit" class="mx-auto flex justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
      <div
        v-if="loading"
        class="flex justify-center mt-4 text-sm font-medium text-gray-900 dark:text-white"
      >
        Loading...
      </div>
      <div
        v-if="submitted"
        class="flex justify-center mt-4 text-sm font-medium text-gray-900 dark:text-green-500"
      >
        Success
      </div>
      <div
        v-if="errors.criticalMessage"
        class="flex justify-center mt-4 text-sm font-medium text-gray-900 dark:text-red-500"
      >
        {{ errors.criticalMessage }}
      </div>
    </form>
  </div>
</template>
<script setup>
  import { reactive, ref } from 'vue'

  const formData = reactive({
    accountName: '',
    website: '',
    phone: '',
    dealName: '',
    stage: ''
  })

  const errors = ref({})

  const loading = ref(false)
  const submitted = ref(false)

  const onSubmit = async () => {
    errors.value = {}
    loading.value = true

    try {
      const data = await axios.post('/api/zoho-form', formData)
      console.log(data)

      submitted.value = true
      Object.keys(formData).forEach(key => {
        formData[key] = ''
      })

      setTimeout(() => {
        submitted.value = false
      }, 2000)
    } catch (event) {
      if (event.response.data.success === false) {
        errors.value = {
          criticalMessage: 'OOPS...'
        }
      } else {
        errors.value = event.response.data.errors
      }
    } finally {
      loading.value = false
    }
  }
</script>