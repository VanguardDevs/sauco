import spanishMessages from '@blackbox-vision/ra-language-spanish';
import polyglotI18nProvider from 'ra-i18n-polyglot';

const i18nProvider = polyglotI18nProvider(() => ({
  ...spanishMessages,
  page: {
    dashboard: "Inicio",
  },
  pos: {
    menu: {
      'reports': 'Reportes',
      'taxpayers': 'Contribuyentes',
      'settings': 'Configuraciones',
      'administration': 'Administración'
    }
  }
}));

export default i18nProvider;
