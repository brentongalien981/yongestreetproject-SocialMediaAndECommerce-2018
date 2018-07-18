import CnComponent from './CnComponent.js';


class CnForm extends CnComponent {

    // constructor(props = null) {

    //     super(props);
    // }

    getFormErrorLabelNodeBasedOnModelFieldName(fieldName = "") {
        // TODO: Override this.
    }

    clearInputFields() {
        $(this.node).find(".form-control").val("");
        $(this.node).find(".form-control").attr("value", "");
    }
}


export { CnForm as default}