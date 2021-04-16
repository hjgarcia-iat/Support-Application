<template>
    <div>
        <h1
            class="text-5xl text-blue-brand font-medium border-b-2 border-black mb-4 pb-4"
        >
            Multi-Year Digital Savings
        </h1>
        <div class="grid">
            <div>&nbsp;</div>
            <div>
                <p class="font-bold bg-blue-brand text-white py-1 text-center">
                    Best Savings
                </p>
            </div>
            <div>&nbsp;</div>

            <div class="text-center p-4 border-2 border-gray-300 mb-6 md:mb-0">
                <h2 class="text-4xl text-blue-brand font-medium">
                    {{ product_interest }}
                </h2>

                <p class="text-xl mb-3 text-gray-600">
                    Activate Learning Digital Platform
                </p>
                <p class="text-3xl font-bold">1-Year</p>
                <p class="text-xl">Subscription</p>
                <p class="text-2xl">Current Subscription</p>
            </div>

            <div class="text-center  border-2 border-blue-brand p-4">
                <h2 class="text-4xl text-blue-brand font-medium">
                    {{ product_interest }}
                </h2>

                <p class="text-xl mb-3 text-gray-600">
                    Activate Learning Digital Platform
                </p>
                <p class="text-3xl font-bold">6-Year</p>
                <p class="text-xl">Subscription</p>
                <h3 class="text-2xl font-bold">You would save</h3>

                <p class="text-3xl text-orange-500">
                    {{ ap_six_year_cost | currency }}
                </p>
                <p class="text-xl">&ndash; or &ndash;</p>
                <p class="text-3xl text-orange-500">
                    {{ ap_six_year_savings | percent }}
                </p>
                <p>
                    Compared to renewing a 1-yr subscription each of the 6 years
                </p>
            </div>
            <div>&nbsp;</div>
        </div>

        <div class="mt-6 flex items-center">
            <a
                href="#"
                class="text-blue-500 hover:text-blue-600 hover:underline focus:outline-none focus:underline mr-2"
                @click.prevent="step_back"
                >Previous</a
            >

            <a
                href=""
                class="bg-blue-brand hover:bg-blue-brand-medium text-white font-bold py-2 px-4 focus:outline-none focus:bg-blue-brand-medium focus:ring-2 focus:ring-blue-brand-light focus:ring-opacity-50 flex items-center"
                @click.prevent="next_step"
                >Learn More</a
            >
        </div>
    </div>
</template>

<script>
    import Vue2Filters from "vue2-filters";
    import Vue from "vue";

    Vue.use(Vue2Filters);

    export default {
        data() {
            return {
                ap_six_year_cost: 0,
                ap_six_year_savings: 0,
                ac_six_year_cost: 0,
                ac_six_year_savings: 0,
                ec_six_year_cost: 0,
                ec_six_year_savings: 0,
            };
        },
        mounted() {
            //get the calcs
            this.$store.dispatch("getApCalculations");
            this.$store.dispatch("getAcCalculations");
            this.$store.dispatch("getEcCalculations");

            this.ap_six_year_cost = this.$store.state.six_year_ap_costs;
            this.ap_six_year_savings = this.$store.state.six_year_ap_savings;
            this.ac_six_year_cost = this.$store.state.six_year_ac_costs;
            this.ac_six_year_savings = this.$store.state.six_year_ac_savings;
            this.ec_six_year_cost = this.$store.state.six_year_ec_costs;
            this.ec_six_year_savings = this.$store.state.six_year_ec_savings;
        },
        computed: {
            product_interest() {
                console.log(this.$store.state.product_interest)
                return this.$store.state.product_interest;
            },
            step: {
                get() {
                    return this.$store.state.step;
                },
                set(value) {
                    this.$store.commit("updateStep", value);
                },
            },
        },

        methods: {
            step_back() {
                if (this.product_interest === "Active Chemistry") {
                    this.step = 3;
                }

                if (this.product_interest === "Active Physics") {
                    this.step = 4;
                }

                if (this.product_interest === "EarthComm") {
                    this.step = 5;
                }
            },
            next_step() {
                this.step = 8;
            },
        },
    };
</script>

<style scoped>
    .grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 0 1em;
    }
</style>
