<template>
  <div class="flex absolute inset-0 w-full flex-1">
    <div class="flex min-h-full flex-1 items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
      <div class="w-full max-w-sm space-y-10">
        <div>
          <img
            class="mx-auto h-36 w-auto"
            :src="'/storage/images/facebook_profile_image_whiteout.png'"
            alt="Your Company"
          />
          <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
            Sign in to your account
          </h2>
        </div>
        <form @submit.prevent="login" class="space-y-6" action="#" method="POST">
          <div class="relative -space-y-px rounded-md shadow-sm">
            <div
              class="pointer-events-none absolute inset-0 z-10 rounded-md ring-1 ring-inset ring-gray-300"
            />
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input
                id="email-address"
                v-model="form.email"
                type="email"
                autocomplete="email"
                class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                placeholder="Email address"
              />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input
                id="password"
                v-model="form.password"
                type="password"
                autocomplete="current-password"
                class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-100 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-orange-600 sm:text-sm sm:leading-6"
                placeholder="Password"
              />
            </div>
          </div>

          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember-me"
                v-model="form.remember_me"
                type="checkbox"
                class="h-4 w-4 rounded border-gray-300 text-orange-600 focus:ring-orange-600"
              />
              <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-900"
                >Remember me</label
              >
            </div>

            <div class="text-sm leading-6">
              <a href="#" class="font-semibold text-orange-600 hover:text-orange-500"
                >Forgot password?</a
              >
            </div>
          </div>

          <div>
            <button
              type="submit"
              class="flex w-full justify-center rounded-md bg-orange-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white hover:bg-orange-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-600"
            >
              Sign in
            </button>
          </div>
        </form>

        <p class="text-center text-sm leading-6 text-gray-500">
          Not a member?
          {{ ' ' }}
          <a href="#" class="font-semibold text-orange-600 hover:text-orange-500"
            >Start a 14-day free trial</a
          >
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { useForm, Link, usePage } from '@inertiajs/vue3'
import SingleLayout from '/resources/js/Layouts/SingleLayout.vue'
defineOptions({ layout: SingleLayout }) // ここでレイアウトファイルを指定する

const form = useForm({
  email: null,
  password: null,
  remember_me: false
})

const login = () => form.post(route('login.store'))
</script>
