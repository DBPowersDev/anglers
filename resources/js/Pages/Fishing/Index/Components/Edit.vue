<template>
  <TransitionRoot as="template" :show="open">
    <Dialog class="relative z-10" @close="$emit('close')">
      <TransitionChild
        as="template"
        enter="ease-out duration-300"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in duration-200"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 transition-opacity md:block" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div
          class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4"
        >
          <TransitionChild
            as="template"
            enter="ease-out duration-300"
            enter-from="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
            enter-to="opacity-100 translate-y-0 md:scale-100"
            leave="ease-in duration-200"
            leave-from="opacity-100 translate-y-0 md:scale-100"
            leave-to="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
          >
            <DialogPanel
              class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl"
            >
              <div
                class="relative flex w-full items-center overflow-hidden bg-white px-4 pb-8 pt-14 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8"
              >
                <button
                  type="button"
                  class="absolute right-4 top-4 text-gray-400 hover:text-gray-500 sm:right-6 sm:top-8 md:right-6 md:top-6 lg:right-8 lg:top-8"
                  @click="$emit('close')"
                >
                  <span class="sr-only">Close</span>
                  <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                </button>

                <div
                  class="grid w-full grid-cols-1 items-start gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8"
                >
                  <div class="sm:col-span-4 lg:col-span-5">
                    <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-100">
                      <img
                        v-if="fishing && fishing.picture"
                        :src="fishing.picture"
                        :alt="fishing.place"
                        class="object-cover object-center"
                      />
                    </div>
                  </div>
                  <div class="sm:col-span-8 lg:col-span-7">
                    <section aria-labelledby="options-heading" class="mt-6">
                      <h3 id="options-heading" class="sr-only">Fishing data</h3>

                      <form @submit.prevent="submit">
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                          <div class="sm:col-span-2 sm:col-start-1">
                            <label
                              for="fishing_date"
                              class="block text-sm font-medium leading-6 text-gray-900"
                              >Date</label
                            >
                            <div class="mt-2">
                              <input
                                type="date"
                                v-model="form.fishing_date"
                                id="fishing_date"
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                              />
                            </div>
                          </div>

                          <div class="col-span-full">
                            <label
                              for="comment"
                              class="block text-sm font-medium leading-6 text-gray-900"
                              >Comment</label
                            >
                            <div class="mt-2">
                              <textarea
                                id="comment"
                                v-model="form.comment"
                                rows="3"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                              />
                            </div>
                          </div>

                          <div class="sm:col-span-3">
                            <label
                              for="place"
                              class="block text-sm font-medium leading-6 text-gray-900"
                              >Place</label
                            >
                            <div class="mt-2">
                              <input
                                type="text"
                                v-model="form.place"
                                id="place"
                                autocomplete="off"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                              />
                            </div>
                          </div>

                          <div class="sm:col-span-3">
                            <fieldset>
                              <legend class="text-sm font-semibold leading-6 text-gray-900">
                                Fishing type
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
                                    >fly fishing</label
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
                                    >lure fishing</label
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
                                    >bait fishing</label
                                  >
                                </div>
                              </div>
                            </fieldset>
                          </div>
                        </div>

                        <div class="mt-6 flex items-center gap-x-6">
                          <button
                            type="button"
                            class="text-sm font-semibold leading-6 text-red-600"
                            @click="deleteFishing"
                          >
                            Delete
                          </button>
                          <div class="flex items-center gap-x-6 ml-auto">
                            <button
                              type="button"
                              class="text-sm font-semibold leading-6 text-gray-900"
                              @click="reset"
                            >
                              Cancel
                            </button>
                            <button
                              @click="updateFishing"
                              type="button"
                              class="rounded-md bg-orange-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
                            >
                              Save
                            </button>
                          </div>
                        </div>
                      </form>
                    </section>
                  </div>
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from 'vue'
import {
  Dialog,
  DialogPanel,
  RadioGroup,
  RadioGroupOption,
  TransitionChild,
  TransitionRoot
} from '@headlessui/vue'
import { ShieldCheckIcon, XMarkIcon } from '@heroicons/vue/24/outline'
import { CheckIcon, QuestionMarkCircleIcon, StarIcon } from '@heroicons/vue/20/solid'
import { useForm, usePage } from '@inertiajs/vue3'

const props = defineProps({
  open: Boolean,
  fishing: {
    type: Object,
    default: () => ({ picture: '', place: '' }) // デフォルト値を設定
  },
  mod_id: Number
})

const emit = defineEmits(['close'])

const page = usePage()

const form = useForm({
  fishing_date: props.fishing ? props.fishing.fishing_date : null,
  comment: props.fishing ? props.fishing.comment : null,
  place: props.fishing ? props.fishing.place : null,
  fishing_type: props.fishing ? props.fishing.fishing_type : null,
  mod_id: props.mod_id ? props.mod_id : null
})

const updateFishing = () => {
  form.put(route('fishing.update', { fishing: props.fishing.id }), {
    preserveScroll: true,
    onSuccess: () => {
      emit('close')
    },
    onError: (errors) => {
      if (page.props.errors) {
        alert(page.props.errors.error) // エラーメッセージを表示
      }
    },
    onFinish: () => {
      //
    }
  })
}

const deleteFishing = () => {
  form.delete(route('fishing.destroy', { fishing: props.fishing.id }), {
    preserveScroll: true,
    onSuccess: () => {
      emit('close')
    },
    onError: (errors) => {
      if (page.props.errors) {
        alert(page.props.errors.error) // エラーメッセージを表示
      }
    },
    onFinish: () => {
      //
    }
  })
}

const reset = () => {
  form.reset()
  emit('close')
}
</script>
