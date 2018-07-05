import CnComponent from './CnComponent.js';


class CnForm extends CnComponent {

    constructor(selector = null) {

        super();

        if (selector != null) {
            this.node = $(selector);
        }
    }
}


export { CnForm as default}