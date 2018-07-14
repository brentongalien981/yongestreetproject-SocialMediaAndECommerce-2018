class CnPageProperties {
    constructor(props) {
        let actualProps = {
            title: "Untitled CnPage | YSP",
            prop2: null,
            ...props
        };

        this.title = actualProps.title;
    }
}

export { CnPageProperties as default }