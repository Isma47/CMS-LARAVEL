document.addEventListener('alpine:init', () => {
    Alpine.data('filterModal', () => ({
        statePanel : false,

        toggleFilters(){
            this.statePanel = !this.statePanel
        },
        //Cierra el panel de categorias
        closeFilters() {
            this.statePanel = false
        },

        
        getCategoriePublications() {



        }

    }))
})