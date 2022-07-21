export const normalizePhone = value => {
    if (!value) return value;

    const onlyNums = value.replace(/[^\d]/g, "");
    if (onlyNums.length <= 3) return onlyNums;
    if (onlyNums.length <= 7)
        return `(${onlyNums.slice(0, 3)}) ${onlyNums.slice(3, 7)}`;
        
    return `(${onlyNums.slice(0, 3)}) ${onlyNums.slice(3, 6)}-${onlyNums.slice(6,10)}`;
};

export const normalizeRif = value => {
    let letter = 'J-';
    if (!value) return letter;

    value = value.toUpperCase();

    if (value.length <= 2) {
        if (value[0] === 'J' || value[0] === 'V' 
            || value[0] === 'G' || value[0] === 'E')
        {
            letter = `${value[0]}-`
        }

        return letter;
    }

    const nValue = value.slice(2, 12).replace(/[^\d]/g, "");

    if (value.length <= 2) return `${letter}${nValue}`;
    if (value.length <= 10) {
        return `${letter}${nValue}`
    }
    return `${letter}${nValue.slice(0, 8)}-${nValue.slice(8, 12)}`;
}