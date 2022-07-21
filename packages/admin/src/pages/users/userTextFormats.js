export const identityCard = value => {
    if (!value) return value;

    if (value.length <= 8) {
        const onlyNums = value.replace(/[^\d]/g, "");
        if (onlyNums.length <= 8) return onlyNums;
    }
};