import { nextTick } from "vue";
import { createI18n } from "vue-i18n";

// export const SUPPORT_LOCALES = ['en'];

export const i18n = createI18n({
    legacy: false,
    locale: 'en',
    fallbackLocale: 'en',
    messages: {},
});

export function getLocale(i18n) {
    return i18n.global.locale.value
}

export function setLocale(i18n, locale) {
    i18n.global.locale.value = locale
}

export function setupI18n(options = { locale: "en" }) {
    const i18n = createI18n(options);
    setI18nLanguage(i18n, options.locale);
    loadLocaleMessages(i18n, options.locale);

    return i18n
}

export function setI18nLanguage(i18n, locale) {
    setLocale(i18n, locale)
    /**
     * NOTE:
     * If you need to specify the language setting for headers, such as the `fetch` API, set it here.
     * The following is an example for axios.
     *
     * axios.defaults.headers.common['Accept-Language'] = locale
     */
    document.querySelector("html").setAttribute("lang", locale)
}

// eslint-disable-next-line @typescript-eslint/no-explicit-any
const getResourceMessages = r => r.default || r

export async function loadLocaleMessages(locale) {
    if (! i18n.global.availableLocales.includes(locale)) {
        const messages = await import(`./../../lang/${locale}.json`).then(
            getResourceMessages
        )
        i18n.global.setLocaleMessage(locale, messages.default || messages)
    }

    i18n.global.locale.value = locale

    return nextTick()
}

