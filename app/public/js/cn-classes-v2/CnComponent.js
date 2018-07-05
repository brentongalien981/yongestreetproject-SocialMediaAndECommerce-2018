import CnTemplate from './CnTemplate.js';


class CnComponent extends CnTemplate {

    constructor(htmlTag = "div") {

        super();

        var component = document.createElement(htmlTag);

        this.node = component;
    }
}


export { CnComponent as default}