import polyglotI18nProvider from "ra-i18n-polyglot";
import spanishMessages from "@blackbox-vision/ra-language-spanish";

//@ts-ignore
export const i18nProvider = polyglotI18nProvider(() => spanishMessages);
