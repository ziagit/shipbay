import store from '../store'
import axios from 'axios'

store.subscribe((mutation) => {
    switch (mutation.type) {
        case 'auth/SET_TOKEN':
            if(mutation.payload){
                axios.defaults.headers.common['Authorization'] = `Bearer ${mutation.payload}`
                localStorage.setItem('token', mutation.payload)
                localStorage.setItem('in', 'true')
            }else{
                axios.defaults.headers.common['Authorization'] = null
            }
            break;
/*         case 'shared/SET_CARD':
            if(mutation.payload){
                localStorage.setItem('card',JSON.stringify(mutation.payload))
            }
            break;
        case 'shared/SET_TEMP':
            if(mutation.payload){
                localStorage.setItem('temp', JSON.stringify(mutation.payload))
            }
            break; */
    }
})