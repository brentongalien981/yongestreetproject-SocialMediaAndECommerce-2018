import CnComponent3 from "./CnComponent3.js";

export default class PageNumberNavigator extends CnComponent3 {

    constructor() {
        
        const myNode = CnComponent3.cnCloneTemplate({ id: "page-number-navigator-template" });
        super({ node: myNode });
    }
}