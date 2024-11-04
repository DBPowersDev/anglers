<template>
  <nav class="flex items-center justify-between border-t border-gray-200 px-4 sm:px-0">
    <div class="-mt-px flex w-0 flex-1">
      <Link
        :href="prev_page_url ?? 'null'"
        :class="[
          'inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700',
          { 'pointer-events-none opacity-50': !prev_page_url }
        ]"
      >
        <ArrowLongLeftIcon class="mr-3 h-5 w-5 text-gray-400" aria-hidden="true" />
        {{ $t('Previous') }}
      </Link>
    </div>
    <div class="hidden md:-mt-px md:flex">
      <section v-for="(link, index) in links">
        <section v-if="index !== 0 && index !== links.length - 1">
          <Link
            v-if="link.url !== null && link.active !== true"
            :key="index"
            class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
            :href="link.url"
            :class="{
              'inline-flex items-center border-t-2 border-orange-500 px-4 pt-4 text-sm font-medium text-orange-600':
                link.active
            }"
            v-html="$t(link.label)"
          />
          <Link
            v-if="link.url !== null && link.active === true"
            :key="index"
            class="inline-flex items-center border-t-2 border-orange-500 px-4 pt-4 text-sm font-medium text-orange-600"
            :href="link.url ?? 'null'"
            aria-current="page"
            v-html="$t(link.label)"
          />
          <span
            v-else-if="link.label === '...'"
            class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500"
            >...</span
          >
        </section>
      </section>
    </div>
    <div class="-mt-px flex w-0 flex-1 justify-end">
      <Link
        :href="next_page_url ?? 'null'"
        :class="[
          'inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700',
          { 'pointer-events-none opacity-50': !next_page_url }
        ]"
      >
        {{ $t('Next') }}
        <ArrowLongRightIcon class="ml-3 h-5 w-5 text-gray-400" aria-hidden="true" />
      </Link>
    </div>
  </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ArrowLongLeftIcon, ArrowLongRightIcon } from '@heroicons/vue/20/solid'
defineProps({ links: Array, next_page_url: String, prev_page_url: String })
</script>
