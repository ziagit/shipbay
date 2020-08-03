

export default {

    state: {
        carrierData: {
            carrierId: null,
            countryId: null
        },
        notificationId: null
    },
    getters: {
        getCarrierData(state) {
            return state.carrierData;
        }
    },

    mutations: {
        setCarrierData(state, data) {
            state.carrierData.carrierId = data.carrierId
            state.carrierData.countryId = data.countryId
        },
        setNotificationId(state, id){
            state.notificationId = id
        }
    },
    actions: {


    }
};