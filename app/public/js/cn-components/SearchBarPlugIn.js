import CnComponent3 from "./CnComponent3.js";

export default class SearchBarPlugIn extends CnComponent3 {

    constructor() {
        
        const myNode = CnComponent3.cnCloneTemplate({ id: "search-bar-plug-in-template" });
        super({ node: myNode });
    }
}