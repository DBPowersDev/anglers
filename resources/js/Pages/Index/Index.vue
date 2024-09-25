<template>Hello {{ counter }}!</template>
<script setup>
import { ref } from 'vue'
const counter = ref(0)
setInterval(() => counter.value++, 1000)
</script>
