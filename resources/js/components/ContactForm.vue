<template>
    <div class="contact-delar">
        <div class="contact-heading">
            <ul>
                <li><h4>Contact Dealer</h4></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-6 f-input">
                <input class="delar" type="text" placeholder="First Name" v-model="firstName">
            </div>
            <div class="col-lg-6">
                <input class="delar" type="text" placeholder="Last Name" v-model="lastName">
            </div>
            <div class="col-lg-6 f-input">
                <input class="delar" type="text" placeholder="Email" v-model="email">
            </div>
            <div class="col-lg-6">
                <input class="delar" type="text" placeholder="Phone" v-model="phone">
            </div>
            <div class="col-lg-12 contact-check">
                <select v-model="availability">
                    <option value="">Check availability</option>
                </select>
            </div>
            <div class="col-lg-12">
                <textarea rows="4" cols="50" class="delar-msg" v-model="message"></textarea >
                <button type="button" class="contact-f-btn" @click="sendMessage">
                    Send Message
                </button>

            </div>
        </div>
        <p>*By clicking "Send Message" I agree to CarDesta providing my contact information and conversation transcript, including all details provided therein, to the dealer and to receiving calls and text messages about vehicles from the dealer selling this car at the number provided (including via autodial or prerecorded calls) or via my other contact information provided above.</p>
    </div>
</template>

<style>
.copy-right {
	text-align: center;
	color: #212121;
	background: #000;
	padding: 15px 0;
	font-size: 14px;
	border-top: 1px solid #2a2a2a;
}
.copy-right a{
	color:#7e4c4f;
	text-decoration:none;
}
.copy-right p {
	margin: 0;
}
.footer-box a img {

	max-width: 100%;

}

</style>

<script>
export default {
    props: {
		product: {
			type: Object
		}
    },
    data() {
		return {
            firstName: '',
            lastName: '',
            email: '',
            phone: '',
            availability: '',
            message: ''
        }
    },
    mounted() {
        this.message = `I’d like to know if the ${this.product.type} ${this.product.year} ${this.product.make} ${this.product.body} you have listed on CarDesta for $${this.numberToCurrency(this.product.sellingprice)} is still available`
    },

    methods: {
        numberToCurrency(number = 0) {
            return number.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        },

        sendMessage() {
            let contactMessage = {
                firstName: this.firstName,
                lastName: this.lastName,
                email: this.email,
                phone: this.phone,
                availability: this.availability,
                message: this.message
            }

            this.axios.post('api/v2/send-message', contactMessage).then(response => {
                if (response.data.status) {
                    this.$notify({
                        group: 'contact',
                        text: 'Email sent successfully!',
                        type: 'success'
                    });
                }
            })
        }
    }

};
</script>
