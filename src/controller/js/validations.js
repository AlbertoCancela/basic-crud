class Validations{
    static isValidLength(value, maxLength) {
        return value.length <= maxLength;
    }

    static isEmail(value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(value);
    }
}
