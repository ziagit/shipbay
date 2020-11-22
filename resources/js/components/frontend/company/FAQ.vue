<template>
  <div class="container">
    <div
      class="section0"
      v-bind:style="{ 'background-image': 'url(/images/uploads/about.jpg)' }"
    >
      <Header v-on:togal-menu="$emit('togal-menu')" :scrollValue="scrollValue"/>
      <div class="content">
        <div class="md-display-1">FAQ</div>
        <div class="md-subheading">Most Frequently Asked Questions</div>
      </div>
    </div>

    <div class="section1">
      <div class="wrapper">
        <div class="left">
          <div class="md-display-1">Most Common Questions Asked</div>
          <md-steppers md-vertical :md-active-step.sync="active">
            <md-step
              id="first"
              md-label="How does ShippingTAP choose carriers?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                ShippingTAP works with the most reputable contract carriers
                across the nation, each of which is required to go through
                numerous steps in order to meet the U.S. Department of
                Transportation’s strict Compliance, Safety and Accountability
                (CSA) requirements. Interested in becoming a carrier?
              </div>
            </md-step>
            <md-step
              id="second"
              md-label="When was ShippingTAP founded?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                ShippingTAP was founded in 1998, providing customers with an
                easy way to compare rates from hundreds of carriers across the
                country. Today, ShippingTAP has more than one thousand employees
                that help move more than one million shipments across North
                America each year. Learn More.
              </div>
            </md-step>
            <md-step
              id="third"
              md-label="What services does ShippingTAP provide?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                ShippingTAP offers a number of freight services including full
                truckload, less than truckload, expedited and intermodal
                shipping. Additionally, we have custom solutions including
                freight management and project freight. Learn more about our
                full suite of shipping services.
              </div>
            </md-step>
            <md-step
              id="fourth"
              md-label="Is ShippingTAP a broker or carrier?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                ShippingTAP is the nation’s largest online freight service
                provider and a licensed transportation property broker. We work
                with a network of carriers to negotiate rates for shippers.
              </div>
            </md-step>
            <md-step
              id="fifth"
              md-label="Where does ShippingTAP ship?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                ShippingTAP ships throughout North America, including Mexico and
                Canada.
              </div>
            </md-step>
            <md-step
              id="sixth"
              md-label="Is ShippingTAP a part of C.H. Robinson?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Yes. ShippingTAP was acquired by C.H. Robinson, one of the
                world’s largest third party logistics providers in 2015. Learn
                More.
              </div>
            </md-step>
            <md-step
              id="seventh"
              md-label="How can I avoid adjustments?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Adjustments can be costly, but can mostly be avoided with
                accurate information. Common adjustments occur around oversized
                items (more than 12 feet in length), lift-gates, limited
                delivery access, residential fees, reclassifications and changes
                to the bill of lading. Learn more.
              </div>
            </md-step>
            <md-step
              id="eighth"
              md-label="What is a bill of lading?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                The bill of lading (BOL) acts as an invoicing receipt in the
                shipping industry, and with many motor carriers, the BOL is the
                contract of carriage between that motor carrier and the shipper.
                It includes important information related to the shipment such
                as addresses, packaging type, freight class, description of the
                goods and any special instructions. Learn more.
              </div>
            </md-step>
            <md-step
              id="nineth"
              md-label="How do I determine freight class?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                There are 18 freight classes. They are determined by weight,
                dimensions, density, storage capability, ease of handling, value
                and liability from instances like theft, damage, breakability
                and spoilage. To help you determine freight class, we’ve
                developed a freight density calculator. Learn more.
              </div>
            </md-step>
            <md-step
              id="tenth"
              md-label="What’s the difference between less than truckload and full truckload?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Less than truckload (LTL) shipping allows multiple shippers to
                share space on the same truck while full truckload shipments
                typically travel on only one truck with one destination. Learn
                more.
              </div>
            </md-step>
            <md-step
              id="eleventh"
              md-label="What is an NMFC number?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                The National Motor Freight Traffic Association (NMFTA) allocates
                a specific number to each product that could be shipped. That is
                the National Motor Freight Classification (NMFC) that pairs to
                the freight class best suited for the product. It’s important to
                include the NMFC number on the bill of lading to reduce chances
                of reclassification. Learn more.
              </div>
            </md-step>
            <md-step
              id="towelfth"
              md-label="How should I package my items?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                When shipping goods, it’s always important to minimize movement.
                Pack crates or boxes as full as possible, with heavier items on
                the bottom. If the crate is not filled, use packing material to
                plug the empty spaces. Learn more.
              </div>
            </md-step>
            <md-step
              id="thirteenth"
              md-label="How are freight shipments tracked?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Freight service providers offer tracking services online to
                access a shipment’s status 24/7 from your computer or mobile
                device. You can track a shipment with a BOL number, but you can
                often access the shipment’s location with the pro number, PO
                number, shipment reference number and shipment number as well.
                Learn more.
              </div>
            </md-step>
            <md-step
              id="fourteenth"
              md-label="What shipping option is best for me?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Full truckload (TL) is generally best suited for those looking
                to move more than 15,000 pounds, or enough to justify the entire
                use of a semi-trailer. If you’re looking to ship more than 150
                pounds of freight, but less than 15,000, less than truckload
                (LTL) might be the best choice. Getting items quickly from one
                point to another may call for expedited shipping services.
                Intermodal shipping uses multiple modes of transportation and is
                great for long distances between metro areas. Learn more.
              </div>
            </md-step>
            <md-step
              id="fifteenth"
              md-label="What is temperature controlled freight shipping?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                If you have goods that are sensitive to climate conditions
                (produce, flowers, chocolate, etc.), you will want to consider
                temperature controlled shipping. Freight service providers will
                assist you throughout the process. Learn more.
              </div>
            </md-step>
            <md-step
              id="sixteenth"
              md-label="How do I track my shipment?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Tracking your shipment is easy. Using our tracking tool, enter
                your BOL number and we’ll give you the latest update on your
                freight.
              </div>
            </md-step>
            <md-step
              id="seventeenth"
              md-label="Do I need LTL or full truckload?"
              md-description="Click to read more"
            >
              <div class="md-body-1">
                Great question and something our team of experts can help you
                determine. LTL is typically ideal for freight shipments larger
                than parcel or small package, but short of the space required of
                a full truckload shipments. However, other factors like distance
                and value may play into the decision. Learn more.
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
                <md-button class="custom-button" to="/order"
                  >Start</md-button
                >
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
      </div>
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
  props: ['scrollValue'],
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

    .content {
      padding: 85px 200px 130px 106px;

      .md-display-1 {
        line-height: 60px;
        font-size: 53px;
        font-weight: 600;
        color: #fff;
      }

      .md-subheading {
        color: #fff;
        max-width: 70%;
      }
    }
  }

  .section1 {
    max-width: 1200px;
    margin: auto;
    padding: 30px;

    .wrapper {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;

      .left {
        flex: 60%;
        padding: 60px;
        .md-display-1 {
          font-weight: 500;
          line-height: 70px;
          color: #000;
        }
      }

      .right {
        flex: 30%;
        padding: 80px 60px;

        .md-headline {
          font-size: 22px;
        }

        .md-icon {
          color: #66A9FB;
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
        .download-app,
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
