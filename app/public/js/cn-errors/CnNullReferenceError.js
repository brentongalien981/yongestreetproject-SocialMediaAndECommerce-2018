class CnNullReferenceError extends Error {

    constructor() {
        super();
        this.message = "Cn error of type: CnNullReferenceError.";
    }

    /**
     * @override
     * @returns {string}
     */
    toString() {
        return "CnNullReferenceError";
    }
}