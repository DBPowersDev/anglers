import { ref, computed } from 'vue'
import axios from 'axios'
import { loadLanguageAsync, getActiveLanguage } from 'laravel-vue-i18n'

// 現在の言語を保持するref
const thisLang = ref(getActiveLanguage().replace('_', '-'))

// 言語を変更する関数
export const changeLang = async (lang) => {
  try {
    await axios.get('/setlocale/' + lang)
    await loadLanguageAsync(lang)
    thisLang.value = computed(() => lang)
  } catch (error) {
    console.error('Error changing language:', error) // エラーハンドリング
  }
}

// 現在の言語を取得する関数
export const getCurrentLanguage = () => {
  return thisLang.value // 現在の言語を返す
}
