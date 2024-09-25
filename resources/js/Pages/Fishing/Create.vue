<template>
  <form>
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Fishing registration</h2>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-2 sm:col-start-1">
            <label for="fishing_date" class="block text-sm font-medium leading-6 text-gray-900"
              >Date</label
            >
            <div class="mt-2">
              <input
                type="date"
                name="fishing_date"
                id="fishing_date"
                autocomplete="off"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
            </div>
          </div>

          <div class="col-span-full">
            <label for="comment" class="block text-sm font-medium leading-6 text-gray-900"
              >Comment</label
            >
            <div class="mt-2">
              <textarea
                id="comment"
                name="comment"
                rows="3"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
            </div>
          </div>

          <div class="col-span-full">
            <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900"
              >Cover photo</label
            >
            <div
              class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
            >
              <div class="text-center">
                <PhotoIcon class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label
                    for="file-upload"
                    class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                  >
                    <span>Upload a file</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="place" class="block text-sm font-medium leading-6 text-gray-900"
              >Palce</label
            >
            <div class="mt-2">
              <input
                type="text"
                name="place"
                id="place"
                autocomplete="off"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 space-y-10">
          <fieldset>
            <legend class="text-sm font-semibold leading-6 text-gray-900">Fishing type</legend>

            <div class="mt-6 space-y-6">
              <div class="flex items-center gap-x-3">
                <input
                  id="fly-fishing"
                  name="fishing_type"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                />
                <label for="fly-fishing" class="block text-sm font-medium leading-6 text-gray-900"
                  >fly fishing</label
                >
              </div>
              <div class="flex items-center gap-x-3">
                <input
                  id="lure-fishing"
                  name="fishing_type"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                />
                <label for="lure-fishing" class="block text-sm font-medium leading-6 text-gray-900"
                  >lure fishing</label
                >
              </div>
              <div class="flex items-center gap-x-3">
                <input
                  id="bait-fishing"
                  name="fishing_type"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                />
                <label for="bait-fishing" class="block text-sm font-medium leading-6 text-gray-900"
                  >bait fishing</label
                >
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      <button
        type="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
      >
        Save
      </button>
    </div>
  </form>
</template>

<script setup>
import { PhotoIcon, UserCircleIcon } from '@heroicons/vue/24/solid'
</script>
