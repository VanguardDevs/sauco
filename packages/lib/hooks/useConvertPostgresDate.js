export const useConvertPostgresDate = (date) => {
    const ISODate = new Date(date.replace(' ', 'T'));
    const shortOptions = {
        month: 'long',
        day: 'numeric'
    }

    const shortDate = new Intl.DateTimeFormat('es-ES', shortOptions).format(ISODate)
    const year = new Intl.DateTimeFormat('es-ES', { year: 'numeric' }).format(ISODate)

    return `${shortDate}, ${year}`
}
