import i18n, {InitOptions} from 'i18next';
import LanguageDetector from 'i18next-browser-languagedetector';
import {initReactI18next} from 'react-i18next';
import ca from './ca';
import en from './en';
import es from './es';

const options: InitOptions = {
    resources: {
        ca,
        en,
        es,
    },

    fallbackLng: 'en',
    supportedLngs: ['ca', 'en', 'es'],
    nonExplicitSupportedLngs: true,
    load: 'languageOnly',
    defaultNS: 'app',

    interpolation: {
        escapeValue: false
    },

    detection: {
        order: ['localStorage', 'navigator', 'querystring'],

        lookupLocalStorage: 'language',
        lookupQuerystring: 'hl',

        caches: ['localStorage'],
    },
}

i18n
    .use(LanguageDetector)
    .use(initReactI18next)
    .init(options);

export default i18n;
