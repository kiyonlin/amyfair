export default (value) => {
    if (value === undefined || value === null) {
        return false;
    }
    return /[\w\d]{5,12}/.test(String(value));
};
