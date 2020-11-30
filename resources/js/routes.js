window.Vue = require('vue');

import VueRouter from 'vue-router';
import Home from './components/frontend/Home';
import Register from './components/frontend/auth/Register';
import Login from './components/frontend/auth/Login';
import Welcome from './components/frontend/auth/Welcome';

import Card from './components/frontend/card/Card';

import HomeContent from './components/frontend/company/HomeContent';
import Help from './components/frontend/company/Help';
import AboutUs from './components/frontend/company/AboutUs'
import ContactUs from './components/frontend/company/ContactUs'

import Privacy from './components/frontend/company/Privacy'
import Terms from './components/frontend/company/Terms'
import OurCarriers from './components/frontend/company/OurCarriers'
import OurShippers from './components/frontend/company/OurShippers'

import CarrierProfile from './components/frontend/carrier/CarrierProfile';
import CarrierDetails from './components/frontend/carrier/general-details/CarrierDetails';
import CarrierDetailsContainer from './components/frontend/carrier/general-details/CarrierDetailsContainer';
import EditCarrierDetails from './components/frontend/carrier/general-details/EditCarrierDetails';
import AddCarrierDetails from './components/frontend/carrier/general-details/AddCarrierDetails';
import Accessory from './components/frontend/carrier/accessory/Accessory'
import AccessoryContainer from './components/frontend/carrier/accessory/AccessoryContainer'
import EditAccessory from './components/frontend/carrier/accessory/EditAccessory';
import AddAccessory from './components/frontend/carrier/accessory/AddAccessory';
import CarrierRates from './components/frontend/carrier/rate/CarrierRates';
import RateContainer from './components/frontend/carrier/rate/RateContainer';
import AddRate from './components/frontend/carrier/rate/AddRate';
import EditRate from './components/frontend/carrier/rate/EditRate';
import History from './components/frontend/carrier/history/History';
import Jobs from './components/frontend/carrier/history/Jobs';
import JobDetails from './components/frontend/carrier/history/JobDetails';
import CarrierAccountContainer from './components/frontend/carrier/account-details/CarrierAccountContainer';
import CarrierAccount from './components/frontend/carrier/account-details/CarrierAccount';
import EditCarrierAccount from './components/frontend/carrier/account-details/EditCarrierAccount';
import CarrierCard from './components/frontend/carrier/card-details/CarrierCard';

import Order from './components/frontend/order/Order';
import Pickup from './components/frontend/order/Pickup'
import PickupServices from './components/frontend/order/PickupServices'
import PickupDate from './components/frontend/order/PickupDate'
import Delivery from './components/frontend/order/Delivery'
import DeliveryServices from './components/frontend/order/DeliveryServices'
import Items from './components/frontend/order/Items'
import Carriers from './components/frontend/order/Carriers'
import AdditionalDetails from './components/frontend/order/AdditionalDetails'
import PaymentDetails from './components/frontend/order/PaymentDetails'
import Confirmation from './components/frontend/order/Confirmation'
import Completion from './components/frontend/order/Completion'
import ShipmentDetails from './components/frontend/order/ShipmentDetails'

import ShipperProfile from './components/frontend/shipper/ShipperProfile'
import ShipperDetailsContainer from './components/frontend/shipper/general-details/ShipperDetailsContainer'
import ShipperDetails from './components/frontend/shipper/general-details/ShipperDetails'
import AddShipperDetails from './components/frontend/shipper/general-details/AddShipperDetails'
import EditShipperDetails from './components/frontend/shipper/general-details/EditShipperDetails'
import ShipperAccountContainer from './components/frontend/shipper/account-details/ShipperAccountContainer'
import ShipperAccount from './components/frontend/shipper/account-details/ShipperAccount'
import EditShipperAccount from './components/frontend/shipper/account-details/EditShipperAccount'
import ShipperOrderContainer from './components/frontend/shipper/orders/ShipperOrderContainer'
import ShipperOrders from './components/frontend/shipper/orders/ShipperOrders'
import ShipperOrderDetails from './components/frontend/shipper/orders/ShipperOrderDetails'
import ShipperCard from './components/frontend/shipper/card-details/ShipperCard'

//backend
import Admin from './components/backend/Admin'
import Dashboard from './components/backend/Dashboard'
import Comapany from './components/backend/company/Company'
import Countries from './components/backend/lookups/countries/Countries'
import States from './components/backend/lookups/states/States'
import Cities from './components/backend/lookups/cities/Cities'
import Zips from './components/backend/lookups/zips/Zips'
import Addresses from './components/backend/lookups/addresses/Addresses'
import Accessories from './components/backend/lookups/accessories/Accessories'
import RateRanges from './components/backend/lookups/rate-ranges/RateRanges'

import CarrierList from './components/backend/carrier/CarrierList'
import CustomerAddress from './components/backend/address/CustomerAddress' 
import CarrierAccessories from './components/backend/carrier/accessories/CarrierAccessories'
import Rates from './components/backend/carrier/rates/Rates'
import Orders from './components/backend/shippers/orders/Orders'
import OrderDetails from './components/backend/shippers/orders/OrderDetails'
import Shippers from './components/backend/shippers/Shippers'
import Users from './components/backend/users/Users'

import About from './components/backend/company/about/About'
import Contact from './components/backend/company/contact/Contact'
import Services from './components/backend/company/services/Services'

import store from './store'

import Test from './components/Test';

function webGuard(to, from, next) {
    if (!store.getters['auth/authenticated']) {
        next('/login')
    } else {
        next()
    }
}
function orderGuard(to, from, next){
    if(from.name === 'pickup-services'){
        next();
    }else{
        if (localStorage.getItem("order")) {
            localStorage.removeItem("order");
        }
        if (localStorage.getItem("prg-value")) {
            localStorage.removeItem("prg-value");
        }
        if (localStorage.getItem('dflug')) {
            localStorage.removeItem('dflug');
        }
        if (localStorage.getItem('adflug')) {
            localStorage.removeItem('adflug');
        }
        if (localStorage.getItem('aflug')) {
            localStorage.removeItem('aflug');
        }
        if (localStorage.getItem('sflug')) {
            localStorage.removeItem('sflug');
        }
        if (localStorage.getItem('cRoute')) {
            localStorage.removeItem('cRoute');
        }
        next();
    }
}

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        { path: '/test', component: Test },
        {
            name: 'root',
            path: '/',
            component: Home,
            children: [
                { path: '', redirect: 'home' },
                { name: 'home', path: 'home', component: HomeContent },
                { name: 'about', path: 'about', component: AboutUs },
                { name: 'contact', path: 'contact', component: ContactUs },
                { name: 'help', path: 'help', component: Help },
                { name: 'signin', path: '/login', component: Login },
                { name: 'signup', path: '/register', component: Register },
                { name: 'welcome', path: '/welcome', component: Welcome },
                { name: 'checkout', path: '/checkout', component: Card },
                { name: 'shipment-details', path: '/shipment-details/:id', component: ShipmentDetails },
                { name: 'privacy', path: '/privacy-policies', component: Privacy},
                { name: 'terms', path: '/terms-and-conditions', component: Terms},
                {name: 'our-carriers',path: '/carriers', component: OurCarriers},
                {name: 'our-shippers',path: '/shippers', component: OurShippers},
                {
                    name: 'order',
                    path: 'order',
                    component: Order,
                    children: [
                        { path: '', redirect: 'pickup' },
                        { name: 'pickup', path: 'pickup', component: Pickup,beforeEnter: orderGuard},
                        { name: 'pickup-services', path: 'pickup-services', component: PickupServices },
                        { name: 'pickup-date', path: 'pickup-date', component: PickupDate },
                        { name: 'delivery', path: 'delivery', component: Delivery },
                        { name: 'delivery-service', path: 'delivery-services', component: DeliveryServices },
                        { name: 'items', path: 'items', component: Items },
                        { name: 'carriers', path: 'carriers', component: Carriers },
                        { name: 'additional-details', path: 'additional-details', component: AdditionalDetails },
                        { name: 'payment-details', path: 'payment-details', component: PaymentDetails },
                        { name: 'confirmation', path: 'confirmation', component: Confirmation },
                        { name: 'completion', path: 'completion', component: Completion },
                        { name: 'shipment-details', path: 'shipment-details/:id', component: ShipmentDetails },
                    ]
                },
                {
                    name: 'carrier',
                    path: 'carrier',
                    component: CarrierProfile,
                    children: [
                        { path: '', redirect: 'profile' },
                        {
                            name: 'profile', path: 'profile', component: CarrierDetailsContainer,
                            children: [
                                { path: '', redirect: 'details' },
                                { name: 'carrier-details', path: 'details', component: CarrierDetails },
                                { name: 'add-carrier', path: 'add', component: AddCarrierDetails },
                                { name: 'edit-carrier', path: 'edit', component: EditCarrierDetails }
                            ]
                        },
                        {
                            name: 'rates', path: 'rates', component: RateContainer,
                            children: [
                                { path: '', redirect: 'list' },
                                { name: 'rate-list', path: 'list', component: CarrierRates },
                                { name: 'add-rate', path: 'add', component: AddRate },
                                { name: 'edit-rate', path: 'edit/:id', component: EditRate }
                            ]
                        },
                        {
                            name: 'accessories', path: 'accessories', component: AccessoryContainer,
                            children: [
                                { path: '', redirect: 'list' },
                                { name: 'accessory-list', path: 'list', component: Accessory },
                                { name: 'add-accessory', path: 'add', component: AddAccessory },
                                { name: 'edit-accessory', path: 'edit/:id', component: EditAccessory }
                            ]
                        },
                        {
                            name: 'history', path: 'history', component: History,
                            children: [
                                { path: '', redirect: 'jobs' },
                                { name: 'jobs', path: 'jobs', component: Jobs },
                                { name: 'job-details', path: 'details/:id', component: JobDetails }
                            ]
                        },
                        {
                            name: 'account', path: 'account', component: CarrierAccountContainer,
                            children: [
                                { path: '', redirect: 'details' },
                                { name: 'carrier-account', path: 'details', component: CarrierAccount },
                                { name: 'edit-account', path: 'edit', component: EditCarrierAccount },
                            ]
                        },
                        { name: 'card', path: 'card', component: CarrierCard },
                    ],
                    beforeEnter: webGuard
                },
                {
                    name: 'shipper',
                    path: 'shipper',
                    component: ShipperProfile,
                    children: [
                        { path: '', redirect: 'profile' },
                        {
                            name: 'profile', path: 'profile', component: ShipperDetailsContainer,
                            children: [
                                { path: '', redirect: 'details' },
                                { name: 'details', path: 'details', component: ShipperDetails },
                                { name: 'add-details', path: 'add', component: AddShipperDetails },
                                { name: 'edit-details', path: 'edit', component: EditShipperDetails }
                            ]
                        },
                        {
                            name: 'account', path: 'account', component: ShipperAccountContainer,
                            children: [
                                { path: '', redirect: 'details' },
                                { name: 'account-details', path: 'details', component: ShipperAccount },
                                { name: 'edit-account', path: 'edit/:id', component: EditShipperAccount },
                            ]
                        },
                        {
                            name: 'orders', path: 'orders', component: ShipperOrderContainer,
                            children: [
                                { path: '', redirect: 'list' },
                                { name: 'order-list', path: 'list', component: ShipperOrders },
                                { name: 'order-details', path: 'details/:id', component: ShipperOrderDetails },
                            ]
                        },
                        { name: 'card', path: 'card', component: ShipperCard },

                    ],
                    beforeEnter: webGuard
                },
               

                {
                    name: 'admin',
                    path: 'admin',
                    component: Admin,
                    children: [
                        { path: '', redirect: 'dashboard' },
                        { name: 'dashboard', path: 'dashboard', component: Dashboard },
                        { name: 'company', path: 'company', component: Comapany },
                        { name: 'countries', path: 'countries', component: Countries, },
                        { name: 'states', path: 'states', component: States },
                        { name: 'cities', path: 'cities', component: Cities },
                        { name: 'zips', path: 'zips', component: Zips },
                        { name: 'addresses', path: 'addresses', component: Addresses },
                        { name: 'accessories', path: 'accessories', component: Accessories },
                        { name: 'range', path: 'rate-ranges', component: RateRanges },

                        { name: 'carriers', path: 'carriers', component: CarrierList },
                        { name: 'rates', path: 'rates', component: Rates },
                        { name: 'customer-addresses', path: 'customer/addresses', component: CustomerAddress },
                        { name: 'carrier-accessories', path: 'carrier/accessories', component: CarrierAccessories },
                        { name: 'shippers', path: 'shippers', component: Shippers },
                        { name: 'orders', path: 'orders', component: Orders },
                        { name: 'order', path: 'order/:id', component: OrderDetails },
                        { name: 'users', path: 'users', component: Users },

                        { name: 'about', path: 'about', component: About },
                        { name: 'contact', path: 'contact', component: Contact },
                        { name: 'services', path: 'services', component: Services },
                    ],
                    beforeEnter: webGuard
                }
            ],
        },
          { path: '*', redirect: '/' }
    ],
})