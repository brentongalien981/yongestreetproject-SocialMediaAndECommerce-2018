class AjaxRequestConstants {

    static get REQUEST_TYPE_AJAX() {
        return "ajax";
    }

    static get REQUEST_TYPE_VIEW() {
        return "view";
    }

    static get REQUEST_METHOD_GET() {
        return "get";
    }

    static get REQUEST_METHOD_POST() {
        return "post";
    }

    static get CRUD_TYPE_CREATE() {
        return "create";
    }

    static get CRUD_TYPE_UPDATE() {
        return "update";
    }

    static get CRUD_TYPE_READ() {
        return "read";
    }

    static get CRUD_TYPE_INDEX() {
        return "index";
    }
}

export { AjaxRequestConstants as default}