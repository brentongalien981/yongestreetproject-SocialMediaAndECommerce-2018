import CnComponent2 from './CnComponent2.js';


class CnForm extends CnComponent2 {

    // constructor(props = null) {

    //     super(props);
    // }

    getFormErrorLabelNodeBasedOnModelFieldName(fieldName = "") {
        // TODO: Override this.
    }

    clearInputFields() {
        $(this.node).find(".form-control").val("");
        $(this.node).find(".form-control").attr("value", "");
        $(this.node).find("[type=checkbox]").prop("checked", false);
    }
}


export { CnForm as default}