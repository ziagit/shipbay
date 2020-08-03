window.Vue = require('vue');

import VueRouter from 'vue-router';
import Home from './components/frontend/Home';
import Order from './components/frontend/order/Order';
import HomeContent from './components/frontend/HomeContent';
import Login from './components/frontend/auth/Login';
import Register from './components/frontend/auth/Register';
import CarrierProfile from './components/frontend/carrier/CarrierProfile';

import Welcome from './components/frontend/carrier/Welcome';
import GeneralInfo from './components/frontend/carrier/general-info/GeneralInfo';
import InfoContainer from './components/frontend/carrier/general-info/InfoContainer';
import EditGeneralInfo from './components/frontend/carrier/general-info/EditGeneralInfo';
import AddGeneralInfo from './components/frontend/carrier/general-info/AddGeneralInfo';
import Accessory from './components/frontend/carrier/accessory/Accessory'
import AccessoryContainer from './components/frontend/carrier/accessory/AccessoryContainer'
import EditAccessory from './components/frontend/carrier/accessory/EditAccessory';
import AddAccessory from './components/frontend/carrier/accessory/AddAccessory';
import Rate from './components/frontend/carrier/rate/Rate';
import RateContainer from './components/frontend/carrier/rate/RateContainer';
import AddRate from './components/frontend/carrier/rate/AddRate';
import EditRate from './components/frontend/carrier/rate/EditRate';
import History from './components/frontend/carrier/history/History';
import Jobs from './components/frontend/carrier/history/Jobs';
import JobDetails from './components/frontend/carrier/history/JobDetails';

import Origin from './components/frontend/order/Origin'
import PickService from './components/frontend/order/PickService'
import PickDate from './components/frontend/order/PickDate'
import Destination from './components/frontend/order/Destination'
import DeliveryService from './components/frontend/order/DeliveryService'
import Item from './components/frontend/order/Item'
import Result from './components/frontend/order/Result'
import SelectCarrier from './components/frontend/order/SelectCarrier'

import Shipper from './components/frontend/shipper/Shipper'
import AdditionalDetails from './components/frontend/shipper/AdditionalDetails'
import PickupDetails from './components/frontend/shipper/PickupDetails'
import PaymentDetails from './components/frontend/shipper/PaymentDetails'
import DeliveryDetails from './components/frontend/shipper/DeliveryDetails'
import Confirmation from './components/frontend/shipper/Confirmation'
import Completion from './components/frontend/shipper/Completion'

import Admin from './components/backend/Admin'
import Dashboard from './components/backend/Dashboard'
import Country from './components/backend/country/Country'
import State from './components/backend/state/State'
import City from './components/backend/city/City'
import CarrierList from './components/backend/carrier/CarrierList'

import store from './store'

function myGuard(to, from, next) {
    if (!store.getters['auth/authenticated']) {
        next('/login')
    } else {
        next()
    }
}

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
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
                        { path: '', redirect: 'origin' },
                        { name: 'origin', path: 'origin', component: Origin },
                        { name: 'pickup-services', path: 'pickup-services', component: PickService },
                        { name: 'pickup-date', path: 'pickup-date', component: PickDate },
                        { name: 'destination', path: 'destination', component: Destination },
                        { name: 'delivery-service', path: 'delivery-services', component: DeliveryService },
                        { name: 'items', path: 'items', component: Item },
                        { name: 'result', path: 'result', component: Result },
                        { name: 'select-carrier', path: 'select-carrier', component: SelectCarrier }
                    ]
                },
                {
                    name: 'shipper',
                    path: 'shipper',
                    component: Shipper,
                    children: [
                        { path: '', redirect: 'additional-details' },
                        { name: 'additional-details', path: 'additional-details', component: AdditionalDetails },
                        { name: 'pickup-details', path: 'pickup-details', component: PickupDetails },
                        { name: 'delivery-details', path: 'delivery-details', component: DeliveryDetails },
                        { name: 'payment-details', path: 'payment-details', component: PaymentDetails },
                        { name: 'confirmation', path: 'confirmation', component: Confirmation },
                        { name: 'completion', path: 'completion', component: Completion }
                    ]
                },
                {
                    name: 'carrier',
                    path: 'carrier',
                    component: CarrierProfile,
                    children: [
                        { path: '', redirect: 'general-info' },
                        {
                            name: 'general-info',path: 'general-info', component: InfoContainer,
                            children: [
                                { path: '', redirect: 'carrier-details' },
                                { name: 'carrier-details', path: 'carrier-details', component: GeneralInfo },
                                { name: 'add-carrier', path: 'add-carrier', component: AddGeneralInfo },
                                { name: 'edit-carrier', path: 'edit-carrier/:id', component: EditGeneralInfo }
                            ]
                        },
                        {
                            name: 'rates',path: 'rates',component: RateContainer,
                            children: [
                                { path: '', redirect: 'rate-list' },
                                { name: 'rate-list', path: 'rate-list', component: Rate },
                                { name: 'add-rate', path: 'add-rate', component: AddRate },
                                { name: 'edit-rate', path: 'edit-rate/:id', component: EditRate }
                            ]
                        },
                        {
                            name: 'accessories',path: 'accessories',component: AccessoryContainer,
                            children: [
                                { path: '', redirect: 'accessory-list' },
                                { name: 'accessory-list', path: 'accessory-list', component: Accessory },
                                { name: 'add-accessory', path: 'add-accessory', component: AddAccessory },
                                { name: 'edit-accessory', path: 'edit-accessory/:id', component: EditAccessory }
                            ]
                        },
                        {
                            name: 'history',path: 'history',component: History,
                            children: [
                                { path: '', redirect: 'jobs' },
                                { name: 'jobs', path: 'jobs', component: Jobs },
                                { name: 'job-details', path: 'job-details/:id', component: JobDetails }
                            ]
                        }
                    ],
                    beforeEnter: myGuard
                },
                {
                    name: 'signin',
                    path: '/login',
                    component: Login
                },
                {
                    path: '/register',
                    component: Register
                },
                {
                    path: '/welcome',
                    component: Welcome
                },
            ],
        },
        {
            path: '/admin',
            component: Admin,
            children: [
                {
                    path: '',
                    redirect: '/dashboard'
                },
                {
                    path: '/dashboard',
                    component: Dashboard
                },
                {
                    path: '/countries',
                    component: Country,
                },
                {
                    path: '/states',
                    component: State
                },
                {
                    path: '/cities',
                    component: City
                },
                {
                    path: '/carriers',
                    component: CarrierList
                }
            ],
            beforeEnter: myGuard
        }
    ],
})