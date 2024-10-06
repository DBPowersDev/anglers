<template>
  <form @submit.prevent="submit" novalidate>
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base font-semibold leading-7 text-gray-900">
          {{ $t('Fishing registration') }}
        </h2>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-2 sm:col-start-1">
            <label for="fishing_date" class="block text-sm font-medium leading-6 text-gray-900">{{
              $t('Date')
            }}</label>
            <div class="relative mt-2 rounded-md shadow-sm">
              <input
                @focus="form.clearErrors('fishing_date')"
                type="date"
                v-model="form.fishing_date"
                id="fishing_date"
                autocomplete="off"
                :class="form.errors.fishing_date ? 'input-text-valid' : 'input-text'"
              />
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <ExclamationCircleIcon
                  v-if="form.errors.fishing_date"
                  class="h-5 w-5 text-red-500"
                  aria-hidden="true"
                />
              </div>
            </div>
            <div v-if="form.errors.fishing_date" class="input-error">
              {{ $t(form.errors.fishing_date) }}
            </div>
          </div>

          <div class="col-span-full">
            <label for="comment" class="block text-sm font-medium leading-6 text-gray-900">{{
              $t('Comment')
            }}</label>
            <div class="relative mt-2 rounded-md shadow-sm">
              <textarea
                @focus="form.clearErrors('comment')"
                id="comment"
                v-model="form.comment"
                rows="3"
                :class="form.errors.comment ? 'input-text-valid' : 'input-text'"
              />
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <ExclamationCircleIcon
                  v-if="form.errors.comment"
                  class="h-5 w-5 text-red-500"
                  aria-hidden="true"
                />
              </div>
            </div>
          </div>

          <div class="col-span-full">
            <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">{{
              $t('Cover photo')
            }}</label>
            <div
              class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10"
            >
              <div class="text-center" @dragover.prevent @drop.prevent="handleDrop">
                <div v-if="!form.file">
                  <!-- 画像がセットされていない場合のみ表示 -->
                  <PhotoIcon class="mx-auto h-12 w-12 text-gray-300" aria-hidden="true" />
                </div>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label
                    for="file-upload"
                    class="relative cursor-pointer rounded-md bg-white font-semibold text-orange-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-orange-600 focus-within:ring-offset-2 hover:text-orange-500"
                  >
                    <span>Upload a file</span>
                    <input
                      id="file-upload"
                      name="file-upload"
                      type="file"
                      class="sr-only"
                      @change="handleFileChange"
                    />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                <!-- 追加: セットされた画像を表示 -->
                <img
                  v-if="form.file"
                  :src="createObjectURL(form.file)"
                  class="mt-2 max-w-full h-auto"
                  alt="Selected file preview"
                />
              </div>
            </div>
            <div v-if="form.errors.file" class="input-error">
              {{ $t(form.errors.file) }}
            </div>
          </div>
        </div>
      </div>

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-3">
            <label for="place" class="block text-sm font-medium leading-6 text-gray-900">{{
              $t('Place')
            }}</label>
            <div class="relative mt-2 rounded-md shadow-sm">
              <input
                @focus="form.clearErrors('place')"
                type="text"
                v-model="form.place"
                id="place"
                autocomplete="off"
                :class="form.errors.place ? 'input-text-valid' : 'input-text'"
              />
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                <ExclamationCircleIcon
                  v-if="form.errors.place"
                  class="h-5 w-5 text-red-500"
                  aria-hidden="true"
                />
              </div>
            </div>
            <div v-if="form.errors.place" class="input-error">
              {{ $t(form.errors.place) }}
            </div>
          </div>
        </div>
      </div>

      <div class="border-b border-gray-900/10 pb-12">
        <div class="mt-10 space-y-10">
          <fieldset>
            <legend class="text-sm font-semibold leading-6 text-gray-900">
              {{ $t('Fishing type') }}
            </legend>

            <div class="mt-6 space-y-6">
              <div class="flex items-center gap-x-3">
                <input
                  id="fly-fishing"
                  v-model="form.fishing_type"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-orange-600 focus:ring-orange-600"
                  value="fly"
                />
                <label
                  for="fly-fishing"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >{{ $t('fly fishing') }}</label
                >
              </div>
              <div class="flex items-center gap-x-3">
                <input
                  id="lure-fishing"
                  v-model="form.fishing_type"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-orange-600 focus:ring-orange-600"
                  value="lure"
                />
                <label
                  for="lure-fishing"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >{{ $t('lure fishing') }}</label
                >
              </div>
              <div class="flex items-center gap-x-3">
                <input
                  id="bait-fishing"
                  v-model="form.fishing_type"
                  type="radio"
                  class="h-4 w-4 border-gray-300 text-orange-600 focus:ring-orange-600"
                  value="bait"
                />
                <label
                  for="bait-fishing"
                  class="block text-sm font-medium leading-6 text-gray-900"
                  >{{ $t('bait fishing') }}</label
                >
              </div>
            </div>
          </fieldset>
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900" @click="reset">
        {{ $t('Cancel') }}
      </button>
      <button
        @click="store"
        type="submit"
        class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
      >
        {{ $t('Save') }}
      </button>
    </div>
  </form>
</template>

<script setup>
import { computed } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import { PhotoIcon, ExclamationCircleIcon } from '@heroicons/vue/24/solid'
import NProgress from 'nprogress'

router.on('progress', (event) => {
  if (event.detail.progress.percentage) {
    NProgress.set((event.detail.progress.percentage / 100) * 0.9)
  }
})

const props = defineProps({
  fishing: Object
})

const form = useForm({
  fishing_date: new Date().toISOString().split('T')[0], // 今日の日付を設定
  comment: '',
  place: '',
  fishing_type: 'fly',
  file: null
})

const handleFileChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.file = file
  }
}

const handleDrop = (event) => {
  const file = event.dataTransfer.files[0]
  if (file) {
    form.file = file
  }
}

const createObjectURL = (file) => {
  return URL.createObjectURL(file)
}

const store = () => {
  form.post(route('fishing.store'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      form.clearErrors()
    }
  })
}

const reset = () => {
  form.reset()
  form.clearErrors()
}
</script>
