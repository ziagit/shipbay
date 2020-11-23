<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/help.svg)' }"
    >
      <Header
        v-on:togal-menu="$emit('togal-menu')"
        :scrollValue="scrollValue"
      />
      <div class="content">
        <div class="md-display-1">We're happy to help</div>
        <div class="md-subheading">Select from bellow options to begin</div>
      </div>
    </div>

    <div class="section1">
      <md-tabs>
        <md-tab id="tab-home" md-label="Carrier" md-icon="directions_boat">
          <div class="left">
            <div class="md-display-1">Carrier</div>
            <div class="md-body-1">
              Ask us anything! When you need assistance, our knowledgeable
              experts are ready. Here are some common situations along with
              guidance we’re pleased to share with you.
            </div>
            <br />
            <md-steppers md-vertical :md-active-step.sync="active">
              <md-step
                id="first"
                md-label="Equipment and plated trailer requirements"
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  Currently, you must have at least one of the equipment types
                  from this list:
                  <ul>
                    <li>Tautliner</li>
                    <li>Mega trailer</li>
                    <li>Road train</li>
                    <li>Jumbo</li>
                    <li>Tilt</li>
                    <li>Joloda</li>
                    <li>Box</li>
                    <li>Frigo/Frigolona</li>
                  </ul>
                  If you still having question call
                  <router-link to="">077 505 9616</router-link>
                </div>
              </md-step>
              <md-step
                id="second"
                md-label="Plated trailer requirements"
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  For loads that require plated trailers please reference the
                  requirements in this support article.
                  <ul>
                    <li>
                      Plated trailers are required to have swing doors and not
                      have wood paneling on interior walls, see diagram below.
                    </li>
                    <li>Interior dimensions must be at least 2.45m wide.</li>
                    <li>Must be a food-grade trailer without damage.</li>
                  </ul>
                  If a carrier is rejected due to their trailer, the carrier
                  will not be reimbursed. <br />
                  If you still having question call
                  <router-link to="">077 505 9616</router-link>
                </div>
              </md-step>
              <md-step
                id="third"
                md-label="Signing up to be a carrier"
                md-description="Click to read more"
              >
                <div class="md-title">
                  Who is eligible and how do I sign up?
                </div>
                <div class="md-body-1">
                  Carriers can download the ShippingTAP app and web portal free
                  of charge. The app and web portal can only be used to book
                  loads by drivers who are authorized to book their own loads on
                  behalf of their carrier. As a carrier, you can sign up, submit
                  your information, and once you’re approved you can add your
                  drivers. It’s that simple!
                </div>
                <div class="break"></div>
                <div class="md-title">
                  How do I get started with ShippingTAP?
                </div>
                <div class="md-body-1">
                  You’ll first need to sign up and tell us a bit about your
                  business. To sign up you’ll need to agree to our contract,
                  submit your insurance and license, and give us your banking
                  information so we can pay you! Right now we’re only working
                  with Tautliners and their variants and Frigos/Frigolonas.
                </div>
                <div class="break"></div>
                <div class="md-title">How does the ShippingTAP app work?</div>
                <div class="md-body-1">
                  The ShippingTAP app is free and available in the App Store and
                  Google Play Store. The ShippingTAP app lists loads that you
                  can book right from your phone. Once you book one of the
                  loads, the load is confirmed for your carrier, so please only
                  book loads that you and your carrier are willing to take.
                </div>
                <div class="break"></div>
                <div class="md-title">Document requirements</div>
                <div class="md-body-1">
                  <ul>
                    <li>
                      All carriers must provide a Cargo Liability Coverage
                      evidencing cargo liability, and must complete our Carrier
                      Service Level Agreement.
                    </li>
                    <li>
                      All carriers must also provide a Transport Cargo License
                      which can be either a Community License or a National
                      License, depending on the areas of operations.
                    </li>
                  </ul>
                </div>
                <div class="md-title">Vehicle requirements</div>
                <div class="md-body-1">
                  For now, you must have either a Tautliner (Mega, Box, etc. are
                  included) or a Frigo.
                </div>
                <div class="break"></div>
                <div class="md-title">Insurance requirements</div>
                <div class="md-body-1">
                  Our carrier contract contains Our carrier contract contains
                  insurance requirements including:
                  <ul>
                    <li>
                      At least €100.000 in cargo liability coverage per event.
                    </li>
                    <li>
                      At least €100.000 in auto liability coverage per event
                      (only for romanian and italian carriers)
                    </li>
                  </ul>
                </div>
                <div class="md-title">Optional requirements</div>
                <div class="md-body-1">
                  <ul>
                    <li>
                      For national loads in Germany, the requirement is at least
                      €600.000 in cargo liability coverage per event.
                    </li>
                    <li>
                      For Cabotage loads in Germany, the requirement is at least
                      €600.000 in cargo liability coverage per event.
                    </li>
                  </ul>
                </div>
                <div class="break"></div>
                <div class="md-title">
                  To create account, what information is required?
                </div>
                <div class="md-body-1">
                  <ul>
                    <li>Cargo Liability Coverage</li>
                    <li>Transport Cargo License</li>
                    <li>Bank Account Information</li>
                  </ul>
                </div>
                <div class="md-title">Setting up payment</div>
                <div class="md-body-1">
                  <ul>
                    <li>
                      We offer weekly payments which will be deposited in the
                      bank account that you’ve provided on the Carrier Service
                      Level Agreement.
                    </li>
                    <li>
                      We pay carriers within 7 days of submitting the Proof of
                      delivery and Invoice.
                    </li>
                  </ul>
                </div>
                <div class="md-title">Downloading the app</div>
                <div class="md-body-1">
                  The ShippingTAP app is free and available in the
                  <router-link to="https://apple.com">App Store</router-link>
                  and
                  <router-link to="https//play.google.com"
                    >Google Play</router-link
                  >
                  Store.
                </div>
                <br />
                If you still having question call
                <router-link to="">077 505 9616</router-link>
              </md-step>
              <md-step
                id="fifth"
                md-label="Using fleet mode"
                md-description="Click to read more"
              >
                <div class="md-title">What is fleet mode?</div>
                <div class="md-body-1">
                  Fleet mode empowers dispatchers to manage their fleet without
                  leaving the ShippingTAP app. When dispatchers open the app,
                  they see a full list of their drivers and their details—like
                  their location and schedule—so they can assign, book, and
                  manage their loads from start to finish.
                  <div class="break"></div>
                </div>
                <div class="md-title">How can I get access to fleet mode?</div>
                <div class="md-body-1">
                  Download the ShippingTAP app from the App or Play Store, sign
                  up and select “dispatcher.” Once we activate your ShippingTAP
                  account, you will automatically enjoy the fleet mode
                  functionality within the app and fleet web portal. This will
                  give you the ability to assign loads to your drivers and set
                  their schedule.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I know which drivers in my fleet have the ShippingTAP
                  app?
                </div>
                <div class="md-body-1">
                  Tap Drivers in your app menu to see a full list of your
                  drivers. Tap My Loads in the app menu to see all loads booked
                  by all your drivers.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I manage dispatchers and/or drivers in my fleet?
                </div>
                <div class="md-body-1">
                  Fleet managers and dispatchers can add or remove members and
                  manage driver booking permissions through the fleet web portal
                  <div class="break"></div>
                  To add a member:
                  <ul>
                    <li>
                      Sign in using the same email and password on your Uber
                      Freight app.
                    </li>
                    <li>Tap Add a member and enter their information.</li>
                    <li>
                      The new member will receive an email asking them to verify
                      their account.
                    </li>
                  </ul>
                </div>

                <div class="md-title">
                  After booking a load, who receives a rate con?
                </div>
                <div class="md-body-1">
                  Dispatchers and carriers both receive a rate con for loads
                  booked via fleet mode. Drivers who have permission to see load
                  rates will also receive a rate con.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  Can dispatchers see the location of their drivers in the Uber
                  Freight app?
                </div>
                <div class="md-body-1">
                  Yes, where available, we show each driver’s current location
                  and calculate the deadhead from that location to each pickup.
                  This helps dispatchers choose the best driver for each load.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I send a dispatch to a driver?
                </div>
                <div class="md-body-1">
                  Once you’ve selected a load and tapped the “Book” button, you
                  will be prompted to assign a driver from a list of “Available”
                  drivers. Drivers will then be notified of the dispatch and
                  have 30 minutes to reject the load.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I view driver schedules?</div>
                <div class="md-body-1">
                  Click Drivers in the menu bar to see driver schedules.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  When I book a load and assign it to a driver, does the driver
                  automatically have the load?
                </div>
                <div class="md-body-1">
                  Yes, when a dispatcher assigns a load to a driver in their
                  fleet, the driver has 30 minutes to decline the load.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What happens if the driver does not respond in 30 minutes?
                </div>
                <div class="md-body-1">
                  If your driver does not respond within the 30-minute window,
                  the load will be booked.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What if the driver declines the load?
                </div>
                <div class="md-body-1">
                  If your driver declines the load, the load will no longer be
                  reserved for your carrier. The app will send the dispatcher a
                  notification that the load was declined.
                </div>
                <div class="break"></div>
                <div class="md-title">
                  Can drivers see the full price of the load?
                </div>
                <div class="md-body-1">
                  Yes, if dispatchers set each driver’s permission to see load
                  prices in the Drivers tab.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  Can drivers book loads in their apps?
                </div>
                <div class="md-body-1">
                  Yes, if dispatchers set each driver’s permission to be able to
                  book loads via the app.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  Is the dispatcher notified when their driver books a load via
                  fleet mode?
                </div>
                <div class="md-body-1">
                  Yes, the app will send the dispatcher a notification.
                </div>
                <div class="break"></div>
                <div class="md-title">What is the “Post Truck” feature?</div>
                <div class="md-body-1">
                  For fleet mode dispatchers posting trucks for drivers, you can
                  post a truck by tapping a driver’s name in the Drivers tab.
                </div>
                <div class="break"></div>
                To cancel a truck post that was booked in fleet mode for a
                driver:
                <ul>
                  <li>Go to the Drivers tab.</li>
                  <li>Tap the specific driver.</li>
                  <li>Select Delete Post.</li>
                </ul>

                <div class="md-title">
                  How do I respond to a dispatch request?
                </div>
                <div class="md-body-1">
                  Once a dispatcher assigns a load, you’ll receive a
                  notification prompting you to confirm the load.
                </div>
                <div class="break"></div>
                <div class="md-title">How much time do I have to respond?</div>
                <div class="md-body-1">
                  You’ll have 30 minutes to reject a dispatch. If you don’t
                  reject the dispatch, it will be booked automatically.
                </div>
                <div class="break"></div>
                <div class="md-title">
                  Am I able to see the full price of the load?
                </div>
                <div class="md-body-1">
                  Dispatchers can set each driver’s permission to see load
                  prices in the app.
                </div>
                <div class="break"></div>
                <div class="md-title">Can I still book loads in my app?</div>
                <div class="md-body-1">
                  Dispatchers can set each driver’s permission to be able to
                  book loads via the app.
                </div>
                <div class="break"></div>
                <div class="md-title">
                  Is the dispatcher notified when their driver books a load via
                  dispatcher mode?
                </div>
                <div class="md-body-1">
                  Yes, the app will send the dispatcher a notification.
                </div>
                <div class="break"></div>
                If you still having question call
                <router-link to="">077 505 9616</router-link>
              </md-step>
              <md-step
                id="sixth"
                md-label="Using the ShippingTAP app"
                md-description="Click to read more"
              >
                <div class="md-title">How does the Uber Freight app work?</div>
                <div class="md-body-1">
                  The Uber Freight app is free and available in the App Store
                  and Google Play Store. The Uber Freight app lists loads that
                  you can book right from your phone. Once you book a load, the
                  load is confirmed for you, so please only book loads that you
                  and your carrier are willing to take.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I sign in?</div>
                <div class="md-body-1">
                  On your Android or iPhone, sign in with the email and password
                  you provided when you created your Uber Freight account.
                </div>
                <div class="break"></div>

                <div class="md-title">What if I forgot my password?</div>
                <div class="md-body-1">
                  You can reset your password by following this link or clicking
                  the “I forgot my password” link at the bottom of the login
                  page. You’ll need to enter the email address associated with
                  your Uber Freight account. The password reset link will be
                  sent to your email address. Once you have created your new
                  password, open your Uber Freight app where you can sign in
                  with your new password. If you still have problems signing in,
                  please email us at freight-eu@uber.com.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I search for loads?</div>
                <div class="md-body-1">
                  The Uber Freight app has many features designed to help you
                  filter and search for loads. You can search by trailer type,
                  location, pickup date, and length of haul. You can also sort
                  loads by deadhead, rate per kilometer, price, and weight based
                  on your preferences.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I book a load?</div>
                <div class="md-body-1">
                  Tap on the load to view its details. Simply tap “Book load” at
                  the bottom of the screen and the load is yours. The primary
                  contact on your carrier account and dispatcher or driver who
                  booked the load will receive a rate confirmation via email.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  Am I allowed to book back-to-back loads?
                </div>
                <div class="md-body-1">
                  Yes, generally the app will allow you to book another. For
                  back-to-back loads, load availability will depend on several
                  factors, including the previous load’s delivery time, time
                  spent at the facility, and kilometers between the previous
                  load’s delivery location and the next load’s pickup location.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  When and how do I receive the rate confirmation?
                </div>
                <div class="md-body-1">
                  You or your dispatcher should receive a rate confirmation in
                  your email inbox shortly after tapping the “Book load” button.
                  Your rate confirmation email will also include the load number
                  you’ll need to provide if you contact our support team.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I cancel a load if I can no longer make the pickup?
                </div>
                <div class="md-body-1">
                  If you must cancel a load, please do so as soon as possible.
                  Tap the headset icon at the top right corner of the screen,
                  select the load, and tap “Request to remove myself from this
                  load.” You can also call the Uber Freight support team by
                  tapping “Call Uber Freight support.”
                </div>
                <div class="break"></div>

                <div class="md-title">What is the “Post Truck” feature?</div>
                <div class="md-body-1">
                  Posting a truck helps make sure your truck is always utilized
                  by matching you to available loads that meet your specific
                  needs. Tap “My Loads” on the navigation bar and then tap “Post
                  Truck.” Select the day your truck will be available, then
                  provide the place and time your truck will be ready for loads.
                  Once you confirm that you want to post your truck, you’ll
                  receive a push notification each time a load matches your
                  post. <br />
                  To cancel a truck post that hasn’t received a match, tap “My
                  Loads” on the navigation bar and then tap “Remove truck post.”
                  To cancel a truck post that has received matches, tap “view
                  matches,” scroll down, and tap “Remove truck post.” Once you
                  cancel a post, you will no longer receive matches or alerts
                  for that posting.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How does the “Post Truck” feature work in fleet mode?
                </div>
                <div class="md-body-1">
                  For dispatchers posting trucks for drivers, tap a driver’s
                  name in the “Drivers” tab, select a day in the driver’s
                  schedule that is empty, and tap “Post Truck.” <br />
                  To cancel a truck post that was booked in fleet mode for a
                  driver, go to the “Drivers” tab and tap on the specific
                  driver, then “Delete Post.” If you need help, you can contact
                  customer support by tapping the headset icon in the upper
                  right corner.
                </div>

                <div class="break"></div>

                <div class="md-title">What are reloads?</div>
                <div class="md-body-1">
                  At the bottom of each load details screen, we’ll suggest
                  reloads if we have options available. Reloads keep your trucks
                  moving by minimizing empty kilometers. When you go to book a
                  load through the app, Uber Freight will preview a list of
                  reloads or backhauls (loads picking up near the delivery
                  location) that you can book next. At the bottom of each load
                  details screen, we’ll suggest reloads if we have options
                  available. Tap on a reload to see all relevant load
                  information and to book the reload.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I share a load?</div>
                <div class="md-body-1">
                  Tap on the load that you want to share. Scroll to the bottom
                  of the load details and tap “Share this Load.” If the
                  recipient has been activated on the Uber Freight app, they
                  will receive a link to the load. If not, they will receive an
                  invitation to sign up with Uber Freight.
                </div>
                <div class="break"></div>

                <div class="md-title">Where do I find the loads I booked?</div>
                <div class="md-body-1">
                  You can see all your loads in the “My Loads” tab in the menu.
                  To see the loads you’re currently on and have booked for the
                  future, tap “Booked” at the top of the screen. To see your
                  completed loads, tap “Past.”
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What do I do if I am running late for my appointment?
                </div>
                <div class="md-body-1">
                  We know sometimes issues happen that are out of your control.
                  In those cases, reach out to our customer support team by
                  tapping the headset icon at the top right corner of the
                  screen.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What does Uber Freight pay for accessorials for loads booked
                  on the app?
                </div>
                <div class="md-body-1">
                  We keep our app load accessorial rates posted publicly on our
                  website. For more information on accessorial rates, view the
                  Carrier Payment and Accessorials Guide.
                </div>
                <div class="break"></div>

                <div class="md-title">How does in-app support work?</div>
                <div class="md-body-1">
                  You can get support help with assignment changes, tracking
                  updates, detention requests, payment status, and more, all
                  within the app. You can also speak with a representative by
                  tapping the headset icon at the top right corner of the
                  screen, then “Call Uber Freight support.”
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I submit a proof of delivery and other documents?
                </div>
                <div class="md-body-1">
                  When your trailer is empty, tap “Complete delivery” and the
                  app will prompt you to use your phone’s camera to take a photo
                  of the signed proof of delivery (POD). Take the photo. Be sure
                  to capture a clear and legible image of your POD to prevent
                  delays in payment; if the image is unclear, please retake the
                  photo. Then, add pages as necessary. A complete, legible,
                  signed, and otherwise acceptable copy of the Proof of Delivery
                  (the “POD”) is required for payment. Please submit the POD
                  within 24 hours after delivery.
                </div>
                <div class="break"></div>
                If you still having question call
                <router-link to="">077 505 9616</router-link>
              </md-step>
              <md-step
                id="seventh"
                md-label="Using the Uber Freight web portal"
                md-description="Click to read more"
              >
                <div class="md-title">What does a carrier need to sign in?</div>
                <div class="md-body-1">
                  Carriers sign in through the Uber Freight
                  <router-link to="/login">web portal</router-link> with their
                  email and password that they previously created for Uber
                  Freight and the app.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I search for loads in the web portal?
                </div>
                <div class="md-body-1">
                  In the Search tab, you can search by pickup location, pickup
                  date, pickup radius, delivery location, delivery radius, and
                  trailer type. The pickup location is the only required field.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I save loads in the web portal?
                </div>
                <div class="md-body-1">
                  In the Saved Lanes tab, you can search by pickup location,
                  pickup radius, pick up availability, delivery location,
                  delivery radius, and trailer type. The pickup location and
                  radius are the only required fields. You can also save
                  searches from the Search tab by clicking “Save this lane”
                  under the Search button. Saved lanes appear on the left side
                  of the Saved Lanes tab.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I see the status of a load?</div>
                <div class="md-body-1">
                  In the My Loads tab, you can see the status of each load on
                  the load details page. For dispatchers with the app in fleet
                  mode, push notifications will also be sent via the mobile app
                  with updates on your drivers’ activity.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  Can documents be uploaded via the web portal?
                </div>
                <div class="md-body-1">
                  No. Documents, such as PODs, need to be uploaded via the Uber
                  Freight app. Please make sure drivers have the app downloaded
                  and set up in order to do so.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  After a load is booked, how do I assign a driver?
                </div>
                <div class="md-body-1">
                  You can assign a driver after a load is booked. You have the
                  option to assign a driver after booking and before pick up, or
                  at the time of booking. When a load is booked with an assigned
                  driver, these loads will show up on the app and web portal in
                  as active in “My Loads” and show as assigned.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What happens if I don’t assign a driver?
                </div>
                <div class="md-body-1">
                  If a load is booked without an assigned driver, these loads
                  will not appear as booked in “My Loads” in the app and will be
                  shown as unassigned. Dispatchers will be notified via email up
                  to three times—24 hours before pickup, 14 hours before pickup,
                  and 4 hours before pickup—to assign a driver. To assign a
                  driver later, go to the “My Loads” tab, click booked loads,
                  then click “Assign Driver” next to the load.
                </div>
                <div class="break"></div>

                <div class="md-title">Do my drivers have to use the app?</div>
                <div class="md-body-1">
                  In order to see status updates for active loads on the web
                  portal and app, your drivers will need to use the app during
                  the duration of the load. To qualify for accessorial rates of
                  loads booked on the Uber Freight app or web portal, the app
                  must be running continuously throughout the load (with GPS
                  location data being provided), all accessorial requests and
                  receipts must be submitted within 24 hours of delivery and
                  supported by a signed BOL with “in” and “out” times, and the
                  POD must be uploaded in the Uber Freight app.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How long does a driver have to respond to assigned loads?
                </div>
                <div class="md-body-1">
                  If a driver is assigned a load, the driver has 30 minutes to
                  reject the load in the app before it is automatically
                  accepted.
                </div>
                <div class="break"></div>

                <div class="md-title">How can I bounce a load?</div>
                <div class="md-body-1">
                  If a driver is not assigned on the load, the dispatcher must
                  call Uber Freight support to bounce from a load. If a driver
                  is assigned on the load, they can bounce off the load via
                  in-app support on the app by tapping the phone icon in the top
                  right corner.
                </div>
                <div class="break"></div>

                <div class="md-title">How do I add drivers from my fleet?</div>
                <div class="md-body-1">
                  In the Fleet Management tab, click “Add Member” and enter the
                  driver’s information. We will email the driver and ask them to
                  verify the account. After the driver’s account is verified via
                  email confirmation, they will have access to Uber Freight
                  loads. They will have access to loads on the Uber Freight
                  platform.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I remove drivers from my fleet?
                </div>
                <div class="md-body-1">
                  In the Fleet Management tab, click the 3 dots to the right of
                  the driver’s name, then click “Remove driver.”
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I change booking or rate visibility permissions for my
                  drivers?
                </div>
                <div class="md-body-1">
                  In the Fleet Management tab, click the 3 dots to the right of
                  the driver’s name, then click “Edit details.” You can then
                  toggle their permissions. Booking permission is only allowed
                  for drivers who also have permission to see rates.
                </div>
                <div class="break"></div>
                If you still having question call
                <router-link to="">077 505 9616</router-link>
              </md-step>
              <md-step
                id="eighth"
                md-label="Carrier payment and accessorials guide"
                md-description="Click to read more"
              >
                <div class="md-title">How does Uber Freight pay?</div>
                <div class="md-body-1">
                  Uber Freight pays carriers with direct deposit. You can set
                  your preference before booking your first load with Uber
                  Freight.
                </div>
                <div class="break"></div>

                <div class="md-title">When is payment made?</div>
                <div class="md-body-1">
                  We pay carriers within 7 days after successfully submitting an
                  acceptable proof of delivery and load invoice at
                  freight-invoice-eu@uber.com.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How do I view the payment status on a load in-app?
                </div>
                <div class="md-body-1">
                  The “See payment” button will appear in the load details page
                  as soon as you begin a load. Tap the button to view payment
                  details for that load, and if there are any documents needed
                  before payment can be sent. Drivers without permission to view
                  rates will only see document statuses.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What happens after my required documents are submitted?
                </div>
                <div class="md-body-1">
                  Once your documents are received, our team will review them
                  and either approve or deny each document. If a document is
                  rejected (too blurry, missing information, etc.), you may be
                  asked to provide additional information.
                  <div class="break"></div>
                  Once all required documents are approved, we will send the
                  payment the following Monday. Depending on the bank used, it
                  may take 1-4 days to appear on your account.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What does Uber Freight pay for detention?
                </div>
                <div class="md-body-1">
                  Below are our accessorial rates for loads in Europe (EUR). All
                  accessorial currencies paid out will match the currency of the
                  linehaul agreement.

                  <div class="break"></div>
                  <b>Accessorial - Carrier Payment (1)</b>
                  <ul>
                    <li>
                      Detention for Technology booked Loads (2) - €35 per hour
                      (3)
                    </li>
                    <li>Detention for Broker booked Loads - €30 per hour</li>
                    <li>
                      Layover for Technology booked Loads - €280 per 24 hours
                    </li>
                    <li>Layover for Broker booked Loads - €240 per 24 hours</li>
                  </ul>
                  (1) Rates will be determined by the currency of the linehaul
                  on the rate confirmation. Eligibility is subject to
                  verification. The accessorial rates may be changed for future
                  loads at Uber Freight’s discretion. Carriers will be notified
                  in the event of changes.
                  <div class="break"></div>
                  (2) For Technology rates to apply, you must meet the following
                  conditions:
                </div>
                <div class="break"></div>

                <div class="md-title">Technology booked load</div>
                <div class="md-body-1">
                  Book the load on the Uber Freight App or Uber Freight Web
                  Portal
                </div>
                <div class="break"></div>

                <div class="md-title">Tracking information provided</div>
                <div class="md-body-1">
                  <ul>
                    <li>
                      Assign a driver to the load at least 2 hours prior to
                      pickup or provide driver full name and license plate info
                      at least 2 hours prior to pickup to tracking-eu@uber.com
                    </li>
                    <li>
                      The Uber Freight App, must be running continuously
                      throughout the load with GPS location data being provided
                      starting 2 hours prior to pickup until load is delivered
                      or you must share live tracking updates via your
                      ELD/​telematics provider with our partner supply chain
                      visibility platforms starting 2 hours prior to pickup
                      until load is delivered. If one or more of the above
                      conditions are not met, broker rates apply.
                    </li>
                  </ul>
                  (3) The hours eligible for detention payment start at 2 hours
                  after the scheduled appointment time and end at 10 hours after
                  the scheduled appointment time (for a maximum of 8 hours of
                  paid detention).
                </div>
                <div class="break"></div>

                <div class="md-title">
                  What are the requirements for detention compensation?
                </div>
                <div class="md-body-1">
                  1. Arrive on time to the scheduled appointment. <br />
                  2. Ensure the equipment is compliant with all requirements for
                  the load. <br />
                  3. Share location data or notify Uber Freight at least 30
                  minutes prior to entering detention. <br />
                  4. Submit in-app requests within 24 hours of delivery and
                  include a signed Proof of delivery with in and out times
                  documented for all completed stops. <br />
                  5. No detention payment applies if the delay is due to the
                  carriers negligence to meet the transport order instruction.
                  <br />
                </div>
                <div class="break"></div>

                <div class="md-title">How to request detention?</div>
                <div class="md-body-1">
                  1. Check in when you get onsite and leave location settings to
                  “always on” while Uber Freight app is open or share live
                  tracking updates via your ELD/telematics provider with our
                  partner supply chain visibility platforms. If you are unable
                  to share location data, you must notify Uber Freight by phone
                  (+31 20 241 8688) or via email at tracking-eu@uber.com at
                  least 30 minutes prior to entering detention or the request
                  may be denied at our discretion. <br />
                  2. After the load is delivered and within 24 hours, request
                  detention through the Uber Freight app or at
                  freight-support.uber.com along with the signed Proof of
                  delivery showing in and out times and a verified signature of
                  stamp from the facility. <br />
                  3. Once your documents are received, our team will review them
                  and either approve or deny each document. If a document is
                  rejected (too blurry, missing information, etc.), you may be
                  asked to provide additional information. <br />
                  4. We will send an updated rate confirmation to the email
                  address that submitted the detention payment request and after
                  you can submit the invoice to freight-invoice-eu@uber.com.
                  <br />
                </div>
                <div class="break"></div>
                If you still having question call
                <router-link to="">077 505 9616</router-link>
              </md-step>
              <md-step
                id="nineth"
                md-label="How to update my expired documents"
                md-description="Click to read more"
              >
                <div class="md-title">
                  What happens when my documents expire?
                </div>
                <div class="md-body-1">
                  If the documents expire, they will be deactivated in our
                  system. This means that until we receive the renewed
                  documents, your Uber Freight account will remain inactive.
                </div>
                <div class="break"></div>

                <div class="md-title">
                  How can I submit my renewed documents?
                </div>
                <div class="md-body-1">
                  Uber Freight keeps track of the expiry dates of your Cargo
                  liability Coverage and Transport Cargo License. We’ll send you
                  an email notification 4 weeks prior to the expiration date of
                  the document in question.

                  <div class="break"></div>
                  In order to submit your renewed documents, you should send an
                  email to freight-onboarding-eu@uber.com with the renewed Cargo
                  liability Coverage or Transport Cargo License attached.
                </div>
                <div class="break"></div>
                If you still having question call
                <router-link to="">077 505 9616</router-link>
              </md-step>
              <md-step
                id="nineth"
                md-label="How to contact Uber Freight"
                md-description="Click to read more"
              >
                <div class="md-title">Carrier Support</div>

                <div class="md-body-1">
                  <b>Email</b>
                  <ul>
                    <li>For general inquiries: freight-eu@uber.com</li>
                    <li>
                      For carrier onboarding: freight-onboarding-eu@uber.com
                    </li>
                    <li>For tracking updates: tracking-eu@uber.com</li>
                    <li>
                      For invoices and proof of delivery:
                      freight-invoice-eu@uber.com
                    </li>
                  </ul>
                  <b>Phone</b>
                  <ul>
                    <li>International: +31 20 241 8688</li>
                    The Netherlands
                    <li>
                      Toll free (only for calls within NL): +31 800 420 0027
                    </li>
                    Poland
                    <li>Local: +48 800 088 019</li>
                    Germany
                    <li>Local: +49 800 000 9481</li>
                    France
                    <li>Local: +33 805 080 359</li>
                    Spain
                    <li>Local: +34 900 423 988</li>
                  </ul>
                </div>
                <div class="break"></div>

              </md-step>
              <md-step
                id="nineth"
                md-label=""
                md-description="Click to read more"
              >
                <div class="md-title"></div>
                <div class="md-body-1"></div>
                <div class="break"></div>
              </md-step>
              <md-step
                id="nineth"
                md-label=""
                md-description="Click to read more"
              >
                <div class="md-title"></div>
                <div class="md-body-1"></div>
                <div class="break"></div>
              </md-step>
            </md-steppers>
          </div>
          <div class="right">
            <div class="contact">
              <div class="md-title">Contact us</div>
              <div class="md-body-1">
                If you want to know more about us, drop us an email.
              </div>
              <div>
                <router-link to="/contact">Contact us</router-link>
                <md-icon>keyboard_arrow_right</md-icon>
              </div>
            </div>
            <div class="download-app">
              <div class="md-title">Download our Application</div>
              <div class="md-body-1">
                By downloading our application the task will be much easier.
              </div>
              <div>
                <md-button class="custom-button" to="https://play.google.com"
                  >Download</md-button
                >
              </div>
            </div>
          </div>
        </md-tab>
        <md-tab id="tab-pages" md-label="Shipper" md-icon="local_mall">
          <div class="left">
            <div class="md-display-1">Shipper</div>
            <div class="md-body-1">
              Ask us anything! When you need assistance, our knowledgeable
              experts are ready. We want your freight shipping to be easy. Here
              are some common situations along with guidance we’re pleased to
              share with you.
            </div>
            <br />
            <md-steppers md-vertical :md-active-step.sync="active">
              <md-step
                id="first"
                md-label="I want to set up an account."
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  Call us at 800.323.5441 or
                  <router-link to="/register"
                    >set up your account online</router-link
                  >.
                </div>
              </md-step>
              <md-step
                id="second"
                md-label="What if I need help after regular business hours?"
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  When you create a ShippingTAP account, you will have access to
                  all your information, whenever you need it. You can quote,
                  book, track, pay invoices, access your address book, view
                  prior shipments and more within your account page.
                </div>
              </md-step>
              <md-step
                id="third"
                md-label="I’m a carrier wanting to become a ShippingTAP contract carrier."
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  You can learn more about our carriers
                  <router-link to="/carriers">here</router-link> or call us at
                  877.667.0035 to learn more about becoming a ShippingTAP
                  contract carrier.
                </div>
              </md-step>
              <md-step
                id="fifth"
                md-label="My shipment was late and I paid for guaranteed service."
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  Contact ShippingTAP customer service, 800.323.5441, to file a
                  claim with the contract carrier.
                </div>
              </md-step>
              <md-step
                id="sixth"
                md-label="Can customer service reps book freight on the phone?"
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  Customer service reps can quote and track your freight, but
                  can only book LTL shipments over the phone. Contact your
                  account manager or log in to your account for other tools and
                  services.
                </div>
              </md-step>
              <md-step
                id="seventh"
                md-label="I need to know how to pack my items, do you have any advice?"
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  We have lots of tips and suggestions about packing, crating
                  and pallets to help you with the safety and security of your
                  shipment. You may also call us any time with questions at
                  800.323.5441.
                </div>
              </md-step>
              <md-step
                id="eighth"
                md-label="I want to change or cancel my pick up date."
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  Sign into your ShippingTAP account to cancel or rebook. You
                  can also call to change or cancel the pickup date.
                </div>
              </md-step>
              <md-step
                id="nineth"
                md-label="Calling Customer service, we can often solve issues faster if you provide:"
                md-description="Click to read more"
              >
                <div class="md-body-1">
                  <ul>
                    <li>Bill of Lading number</li>
                    <li>Account phone number</li>
                    <li>Account email address</li>
                    <li>Zip code pairings on your shipment</li>
                    <li>Pick up date and location</li>
                  </ul>
                </div>
              </md-step>
            </md-steppers>
          </div>
          <div class="right">
            <div class="qoute">
              <div class="md-title">Get a Free Shipping Qoute</div>
              <form action="">
                <md-field>
                  <label>City/Zip code</label>
                  <md-input type="text" v-model="form.city" required></md-input>
                </md-field>

                <div class="action">
                  <md-button class="custom-button" to="/order">Start</md-button>
                </div>
              </form>
            </div>

            <div class="contact">
              <div class="md-title">Contact us</div>
              <div class="md-body-1">
                If you want to know more about us, drop us an email.
              </div>
              <div>
                <router-link to="/contact">Contact us</router-link>
                <md-icon>keyboard_arrow_right</md-icon>
              </div>
            </div>
            <div class="download-app">
              <div class="md-title">Download our Application</div>
              <div class="md-body-1">
                By downloading our application the task will be much easier.
              </div>
              <div>
                <md-button class="custom-button" to="https://play.google.com"
                  >Download</md-button
                >
              </div>
            </div>
          </div>
        </md-tab>
      </md-tabs>
    </div>

    <Footer />
  </div>
</template>

<script>
import axio from "axios";
import Footer from "../../shared/Footer";
import Header from "../../shared/Header";
export default {
  name: "ContactUs",
  data: () => ({
    form: {
      name: null,
      email: null,
      message: null,
    },
  }),
  methods: {},
  components: {
    Footer,
    Header,
  },
};
</script>

<style lang="scss" scoped>
.container {
  background: #fff;

  .section0 {
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center center;
    align-items: center;
    border-bottom: #ddd 1px solid;
    .content {
      min-height: 278px;
      padding: 85px 200px 40px 106px;
      .md-display-1 {
        line-height: 60px;
        font-size: 53px;
        font-weight: 600;
        color: #000;
        max-width: 355px;
      }

      .md-subheading {
        color: #000;
      }

      .md-button {
        margin-top: 30px;
      }
    }
  }

  .section1 {
    max-width: 1200px;
    margin: auto;
    padding: 30px;

    .md-tabs {
      width: 100% !important;
      margin: auto;

      .md-tab {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        padding: 0;
        .left {
          flex: 60%;
          padding: 60px;

          .md-display-1 {
            font-weight: 500;
            line-height: 70px;
            color: #000;
          }

          .md-body-1 {
            font-size: 16px;
            line-height: 24px;
          }
        }

        .right {
          flex: 30%;
          padding: 80px 60px;

          .md-headline {
            font-size: 22px;
          }

          .md-icon {
            color: #66a9fb;
          }

          .qoute {
            .md-field {
              margin: 4px 0 8px;
            }

            .action {
              text-align: right;

              .md-button {
                margin: 0;
              }
            }
          }

          .qoute,
          .faq,
          .download-app,
          .privacy,
          .terms,
          .contact {
            margin-bottom: 30px;
          }

          .download-app {
            .md-button {
              margin-top: 20px;
            }
          }
        }
      }
    }
  }
}

@media only screen and (max-width: 600px) {
  .section0 {
    padding: 50px 10px 100px 10px !important;
  }

  .md-card {
    padding: 0 !important;

    .md-card-header {
      padding: 50px 0 0 0 !important;
      max-width: 78% !important;
    }

    .section1 {
      padding: 0 !important;

      .wrapper {
        flex-direction: column;

        .md-button {
          margin: 30px 0 0 0;
        }
      }
    }
  }
}
</style>
