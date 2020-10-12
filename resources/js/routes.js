window.Vue = require('vue');

import VueRouter from 'vue-router';
import Home from './components/frontend/Home';

import Help from './components/frontend/Help';
import Order from './components/frontend/order/Order';
import HomeContent from './components/frontend/HomeContent';
import Login from './components/frontend/auth/Login';
import Card from './components/frontend/card/Card';
import Register from './components/frontend/auth/Register';
import CarrierProfile from './components/frontend/carrier/CarrierProfile';
import AboutUs from './components/frontend/AboutUs'
import OurServices from './components/frontend/OurServices'

import Welcome from './components/frontend/auth/Welcome';
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

import Pickup from './components/frontend/order/Pickup'
import PickupServices from './components/frontend/order/PickupServices'
import PickupDate from './components/frontend/order/PickupDate'
import Delivery from './components/frontend/order/Delivery'
import DeliveryServices from './components/frontend/order/DeliveryServices'
import Items from './components/frontend/order/Items'
import ItemDetails from './components/frontend/order/ItemDetails'
import Carriers from './components/frontend/order/Carriers'

import Shipment from './components/frontend/shipment/Shipment'
import AdditionalDetails from './components/frontend/shipment/AdditionalDetails'
import PickupDetails from './components/frontend/shipment/PickupDetails'
import PaymentDetails from './components/frontend/shipment/PaymentDetails'
import DeliveryDetails from './components/frontend/shipment/DeliveryDetails'
import Confirmation from './components/frontend/shipment/Confirmation'
import Completion from './components/frontend/shipment/Completion'
import ShipmentDetails from './components/frontend/shipment/ShipmentDetails'

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
import Country from './components/backend/lookups/country/Country'
import State from './components/backend/lookups/state/State'
import City from './components/backend/lookups/city/City'
import Zips from './components/backend/lookups/zip/Zips'
import Addresses from './components/backend/lookups/addresses/Addresses'
import Accessories from './components/backend/lookups/accessories/Accessories'
import RateRanges from './components/backend/lookups/rate-ranges/RateRanges'

import CarrierList from './components/backend/carrier/CarrierList'
import CarrierAddress from './components/backend/address/CarrierAddress' 
import CarrierAccessories from './components/backend/carrier/accessories/CarrierAccessories'
import Rates from './components/backend/carrier/rates/Rates'
import Orders from './components/backend/shippers/Orders'
import OrderDetails from './components/backend/shippers/OrderDetails'
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
function adminGuard(to, from, next) {
    if (!store.getters['auth/authenticated']) {
        next('/login')
    } else {
        next('/admin')
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
                {
                    name: 'order',
                    path: 'order',
                    component: Order,
                    children: [
                        { path: '', redirect: 'pickup' },
                        { name: 'pickup', path: 'pickup', component: Pickup },
                        { name: 'pickup-services', path: 'pickup-services', component: PickupServices },
                        { name: 'pickup-date', path: 'pickup-date', component: PickupDate },
                        { name: 'delivery', path: 'delivery', component: Delivery },
                        { name: 'delivery-service', path: 'delivery-services', component: DeliveryServices },
                        { name: 'items', path: 'items', component: Items },
                        { name: 'item-details', path: 'item-details', component: ItemDetails },
                        { name: 'carriers', path: 'carriers', component: Carriers }
                    ]
                },
                {
                    name: 'shipment',
                    path: 'shipment',
                    component: Shipment,
                    children: [
                        { path: '', redirect: 'additional-details' },
                        { name: 'additional-details', path: 'additional-details', component: AdditionalDetails },
                        { name: 'pickup-details', path: 'pickup-details', component: PickupDetails },
                        { name: 'delivery-details', path: 'delivery-details', component: DeliveryDetails },
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
                { name: 'about', path: 'about', component: AboutUs },
                { name: 'services', path: 'services', component: OurServices },
                { name: 'help', path: 'help', component: Help },
                { name: 'signin', path: '/login', component: Login },
                { name: 'signup', path: '/register', component: Register },
                { name: 'welcome', path: '/welcome', component: Welcome },
                { name: 'checkout', path: '/checkout', component: Card },
                { name: 'shipment-details', path: '/shipment-details/:id', component: ShipmentDetails },

                {
                    name: 'admin',
                    path: 'admin',
                    component: Admin,
                    children: [
                        { path: '', redirect: 'dashboard' },
                        { name: 'dashboard', path: 'dashboard', component: Dashboard },
                        { name: 'company', path: 'company', component: Comapany },
                        { name: 'countries', path: 'countries', component: Country, },
                        { name: 'states', path: 'states', component: State },
                        { name: 'cities', path: 'cities', component: City },
                        { name: 'zips', path: 'zips', component: Zips },
                        { name: 'addresses', path: 'addresses', component: Addresses },
                        { name: 'accessories', path: 'accessories', component: Accessories },
                        { name: 'range', path: 'rate-ranges', component: RateRanges },

                        { name: 'carriers', path: 'carriers', component: CarrierList },
                        { name: 'rates', path: 'rates', component: Rates },
                        { name: 'addresses', path: 'addresses', component: CarrierAddress },
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
        /*   { path: '*', redirect: '/' } */
    ],
})