import CnComponent from './CnComponent.js';


class CnPage extends CnComponent {

    constructor(selector = null) {

        super();

        if (selector != null) {
            this.node = $(selector);
        }
    }
}


export { CnPage as default}