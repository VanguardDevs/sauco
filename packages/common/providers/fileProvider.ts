import { fileProvider as defaultFileProvider } from '@jodaz_/file-provider'

export const fileProvider = defaultFileProvider({
    apiUrl: `${process.env.REACT_APP_API_DOMAIN}`,
    tokenName: `${process.env.REACT_APP_AUTH_TOKEN_NAME}`
})
