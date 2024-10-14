<template>
  <div class="flex absolute inset-0 w-full flex-1">
    <div class="mx-auto max-w-7xl lg:grid lg:grid-cols-12 lg:gap-x-8 lg:px-8">
      <div class="px-6 pb-24 pt-10 sm:pb-32 lg:col-span-7 lg:px-0 lg:pb-56 lg:pt-48 xl:col-span-6">
        <div class="mx-auto max-w-2xl lg:mx-0">
          <img
            class="h-36 w-auto"
            :src="'/storage/images/facebook_profile_image_whiteout.png'"
            alt="Your Company"
          />
          <h1 class="mt-24 text-4xl font-bold tracking-tight text-gray-900 sm:mt-10 sm:text-6xl">
            Angler's
          </h1>
          <div class="flex items-center text-sm text-gray-500 mt-6">
            <button
              type="button"
              @click="changeLanguage('ja')"
              class="text-sm font-semibold leading-6 text-gray-900"
            >
              {{ $t('Japanese') }}
            </button>
            <button
              type="button"
              @click="changeLanguage('en')"
              class="ml-3 text-sm font-semibold leading-6 text-gray-900 border-l border-gray-200 pl-3"
            >
              {{ $t('English') }}
            </button>
          </div>

          <div class="mt-6">
            {{
              $t(
                "This Angler's Site is a platform where you can upload photos of the trout you catch and show them off! Share your fishing achievements with fellow enthusiasts, celebrate your catches, and connect with a community that appreciates the art of fishing. Join us to showcase your best moments on the water and inspire others with your fishing adventures!"
              )
            }}
          </div>
          <div class="mt-10 flex items-center gap-x-6">
            <Link
              :href="route('login')"
              class="rounded-md bg-orange-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
              >{{ $t('Sign in') }}</Link
            >
            <a href="#" class="text-sm font-semibold leading-6 text-gray-900"
              >{{ $t('Learn more') }} <span aria-hidden="true">→</span></a
            >
          </div>
        </div>
      </div>
      <div class="relative lg:col-span-5 lg:-mr-8 xl:absolute xl:inset-0 xl:left-1/2 xl:mr-0">
        <img
          class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
          :src="'/storage/images/IMG_1812.JPG'"
          alt=""
        />
      </div>
    </div>
  </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3'
import SingleLayout from '/resources/js/Layouts/SingleLayout.vue'
defineOptions({ layout: SingleLayout })
import { changeLang } from '../../utils'

const changeLanguage = async (lang) => {
  await changeLang(lang)
}
</script>
