<template>
  <div class="dashboard-setting user-notification">
    <div class="dropdown">
      <a
        @click.prevent="changeLang($i18n.locale == 'en' ? 'ar' : 'en')"
        class="dropdown-toggle no-arrow"
        href="javascript:;"
      >
        <i class="icon-copy dw dw-worldwide"></i>
      </a>
    </div>
  </div>
</template>
<script>
import LangUtil from "../utils/lang-util";
export default {
  setup(props, context) {
    const lang = LangUtil.setup();
    function changeLang(locale) {
      lang.changeAdminLang(locale);
    }
    return { changeLang };
  },
  props: ["layout"],
};
</script>
<style lang="scss" scoped>
</style>
