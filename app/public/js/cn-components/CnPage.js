import CnComponent from './CnComponent.js';


class CnPage extends CnComponent {

    // constructor(props = null) {

    //     super(props);
    // }

    setPageProperties(cnPageProps) {
        this.title = cnPageProps.title;
        
        $("title").html(this.title);
    }
}


export { CnPage as default}