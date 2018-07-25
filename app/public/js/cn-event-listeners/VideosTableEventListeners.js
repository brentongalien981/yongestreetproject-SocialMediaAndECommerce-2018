class VideosTableEventListeners {

    static implement(handlerObj) {

        $(handlerObj.view.nodeSelector + " .cn-table-container").scroll(function () {

            handlerObj.onScrollForMoreObjs();
        });


        $(handlerObj.view.nodeSelector + " tbody tr").click(function () {

            handlerObj.onRowClick(this);

        });

    }


    /**
     * Call this method instead of implement() if the 
     * calling class (delegator)
     * doesn't want to implement the event itself.
     * @param {ComponentController} delegator 
     */
    static handle(delegator) {

        delegator.onScrollForMoreObjs = this.onScrollForMoreObjs;
        delegator.onRowClick = this.onRowClick;
        this.implement(delegator);

    }


    static onRowClick(rowEl) {

        $(this.view.nodeSelector + " tbody tr").css("box-shadow", "none");

        $(rowEl).css("box-shadow", "0 0 20px lightblue");

        const selectedVideoObj = this.dataSource.getObj({ withId: $(rowEl).attr("obj-id") });
        
        this.view.parentComponent.childComponents.videoDetailsForm.populateFields(selectedVideoObj);

    }


    static onScrollForMoreObjs() {

        if (this.canReadMoreObjs({
            refNodeSelector: this.view.childComponents.refForLoadingMoreObjs.nodeSelector,
            heightGap: 700
        })) {
            this.read();
        }

    }

}

export { VideosTableEventListeners as default }