import AppForm from '../app-components/Form/AppForm';

Vue.component('building-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                address:  '' ,
                
            },
            mediaCollections: ['gallery', 'featured']

        }
    }

});