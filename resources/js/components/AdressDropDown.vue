<template>
    
        <div class="col-md-4 ">
            <select
                class="form-row"
                name="country_id"
                v-model="country"
                @change="getStates()"
            >
                <option value=""> choose country</option>
                <option
                    v-for="data in countries"
                    :value="data.id"
                    :key="data.id"
                >
                    {{ data.name }}
                </option>
            </select>
        </div>
        <div class="col-md-4">
            <select
                class="form-row"
                name="state_id"
                v-model="state"
                @change="getCities()"
            >
                <option value="">choose state</option>
                <option
                    v-for="data in states"
                    :value="data.id"
                    :key="data.id"
                >
                    {{ data.name }}
                </option>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" name="city_id">
                <option value="">choose city</option>
                <option
                    v-for="data in cities"
                    :value="data.id"
                    :key="data.id"
                >
                    {{ data.name }}
                </option>
            </select>
        </div>
    
</template>

<script>
export default {
    data() {
        return {
            country: 0,
            countries: [],
            state: 0,
            states: [],
            cities: []
        };
    },
    mounted() {
        this.getCountries();
    },
    methods: {
        getCountries() {
            axios
                .get("/api/country")
                .then(response => {
                    this.countries = response.data;
                })
                
        },
        getStates() {
            axios
                .get("/api/state", {
                    params: { country_id: this.country }
                })
                .then(response => {
                    this.states = response.data;
                })
               
        },
        getCities() {
            axios
                .get("/api/city", {
                    params: { state_id: this.state }
                })
                .then(response => {
                    this.cities = response.data;
                })
                
        }
    }
};
</script>
