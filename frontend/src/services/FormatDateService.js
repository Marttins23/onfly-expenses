function getUTCDateObject(date) {
    const utcDate = new Date(date);
    return {
        day: (`0${utcDate.getUTCDate()}`).slice(-2),
        month: (`0${utcDate.getUTCMonth() + 1}`).slice(-2),
        year: utcDate.getUTCFullYear(),
    };
}

export const formatDate = (date) => {
    const utcObject = getUTCDateObject(date);
    return `${utcObject.year}-${utcObject.month}-${utcObject.day}`;
}

export const formatBRDate = (date) => {
    const utcObject = getUTCDateObject(date);
    return `${utcObject.day}/${utcObject.month}/${utcObject.year}`;
}
