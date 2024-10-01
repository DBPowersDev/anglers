<template>
  <ul
    role="list"
    class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8"
  >
    <li v-for="fishing in fishings" :key="fishing.id" class="relative">
      <div
        class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-orange-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100"
      >
        <img
          :src="fishing.picture"
          alt=""
          class="pointer-events-none object-cover group-hover:opacity-75"
        />
        <Link
          :href="route('fishing.show', { fishing: fishing.id })"
          as="button"
          class="absolute inset-0 focus:outline-none"
        >
          <span class="sr-only">View details for {{ fishing.place }}</span>
        </Link>
      </div>
      <div class="flex justify-between mt-2">
        <!-- 左寄せと右寄せを分ける -->
        <div class="flex-1">
          <!-- コンテンツを左寄せ -->
          <p class="pointer-events-none block truncate text-sm font-medium text-gray-900">
            {{ fishing.place }}
          </p>
          <p class="pointer-events-none block text-sm font-medium text-gray-500">
            {{ fishing.fishing_date }}
          </p>
        </div>
        <div class="flex justify-end">
          <!-- ボタンを右寄せ -->
          <button
            @click="openEditModal(fishing.id)"
            type="button"
            class="rounded-md bg-orange-600 px-3 py-1 text-sm font-semibold text-white shadow-sm hover:bg-orange-500"
          >
            Edit
          </button>
        </div>
      </div>
    </li>
  </ul>
  <EditModal
    :open="isEditModalOpen"
    :fishing="page.props.flash.one_data"
    :mod_id="page.props.flash.mod_id"
    @close="closeEditModal"
  />
</template>

<script setup>
// import Pagination from '@/Components/UI/Pagination.vue'
import EditModal from '@/Pages/Fishing/Index/Components/Edit.vue'
import { ref, computed, onMounted } from 'vue'
import { router, usePage, Link } from '@inertiajs/vue3'
defineProps({
  fishings: Object
})

const isEditModalOpen = ref(false)

const page = usePage()
const flashOnefish = computed(() => {
  if (page.props.flash.one_data) {
    return true
  } else {
    return false
  }
})

const openEditModal = (id) => {
  router.visit(route('fishing.edit', { fishing: id }), {
    except: ['fishings'],
    preserveScroll: true
  })
}

// const show = (id) => router.visit(route('fishing.show', { fishing: id }))

const closeEditModal = () => {
  isEditModalOpen.value = false
}

onMounted(() => {
  isEditModalOpen.value = flashOnefish.value
})
</script>
