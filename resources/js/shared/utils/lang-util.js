import { inject } from "vue";
import { useI18n } from "vue-i18n";

export default {
    key: "LANG",
    set(lang) {
        localStorage.setItem(this.key, lang);
    },
    get() {
        return localStorage.getItem(this.key) ? localStorage.getItem(this.key) : "en";
    },
    isRtl() {
        var lang = localStorage.getItem(this.key) ? localStorage.getItem(this.key) : "en";
        return lang == "ar";
    },
    isArabic() {
        return this.get() == 'ar';
    },
    isEnglish() {
        return this.get() == 'en';
    },
    setup() {
        const { t, locale } = useI18n({ useScope: 'global' });
        const store = inject("store");
        const self = this;
        function changeAdminLang(lang) {
            self.set(locale.value = lang);
            store.dir = locale.value == "ar" ? "rtl" : "ltr";
            store.showPageLoader = true;
            setTimeout(() => {
                if (lang == "ar") {
                    $("#body").attr("dir", "rtl");
                    $("#core").attr("href", "/vendors/styles/core-rtl.css");
                    $("#dataTables").attr("href", "/src/plugins/datatables/css/dataTables.bootstrap4-rtl.min.css");
                    $("#bootstrap").attr("href", "/src/plugins/datatables/css/responsive.bootstrap4-rtl.min.css");
                    $("#steps").attr("href", "/src/plugins/jquery-steps/jquery.steps-rtl.css");
                    $("#style").attr("href", "/vendors/styles/style-rtl.css");
                } else if (lang == "en") {
                    $("#body").attr("dir", "ltr");
                    $("#core").attr("href", "/vendors/styles/core.css");
                    $("#dataTables").attr("href", "/src/plugins/datatables/css/dataTables.bootstrap4.min.css");
                    $("#bootstrap").attr("href", "/src/plugins/datatables/css/responsive.bootstrap4.min.css");
                    $("#steps").attr("href", "/src/plugins/jquery-steps/jquery.steps.css");
                    $("#style").attr("href", "/vendors/styles/style.css");
                }
            }, 500)
            setTimeout(() => {
                store.showPageLoader = false;
            }, 2000)
        }
        return { changeAdminLang };
    }

}