import CnComponent3 from './CnComponent3.js';


class CnForm extends CnComponent3 {

    // constructor(props = null) {

    //     super(props);
    // }

    
    getFormErrorLabelNodeBasedOnModelFieldName(fieldName = "") {
        // TODO: Override this.
        return null;
    }

    clearInputFields() {
        $(this.node).find(".form-control").val("");
        $(this.node).find(".form-control").attr("value", "");
        $(this.node).find("[type=checkbox]").prop("checked", false);
    }
}


export { CnForm as default}