import { reactive } from "vue";
import LangUtil from "./utils/lang-util";
export default reactive({
    showLoader: false,
    showPageLoader: false,
    currentUser: null,
    dir: LangUtil.isArabic() ? 'rtl' : 'ltr',
})
