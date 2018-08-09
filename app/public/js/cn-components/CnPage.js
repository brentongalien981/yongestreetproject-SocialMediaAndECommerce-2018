import CnComponent2 from './CnComponent2.js';
import CnPageProperties from "../cn-classes-v3/CnPageProperties.js";


class CnPage extends CnComponent2 {

    /** @override */
    regularInit() {
        super.regularInit();
        this.initPageProperties();
    }

    

    initPageProperties(props) {

        this.pageProps = new CnPageProperties(props);
        
        $("title").html(this.pageProps.title);

        
    }
}


export { CnPage as default}