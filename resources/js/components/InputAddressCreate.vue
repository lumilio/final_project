<template>
  <div>
    <div class="mb-3">
      <div class="d-flex">
        <label for="address" class="form-label">Indirizzo</label>
        <i
          v-bind:class="
            adressSelection == false
              ? 'd-none'
              : 'fa-solid fa-circle-check ms-2 text-success'
          "
          class="d-flex align-items-center mb-2"
        ></i>
      </div>
      <input
        v-model="inputAddress"
        @keyup="getLatitudeLongitude(inputAddress)"
        type="text"
        class="form-control"
        name="address"
        id="address"
        aria-describedby="addressHelper"
        placeholder="Inserisci l'indirizzo"
      />
      <small id="addressHelper" class="form-text text-muted">
        Scrivi l'indirizzo dell'appartamento, max 255 caratteri
      </small>
    </div>

    <!--------------------------- opzioni vincolate scelta adress -------------------------->
    <div :class="results.length >= 1 ? 'border' : ''">
      <div class="hover_blue" v-for="result in results" v-bind:key="result.id">
        <span v-on:click="selectAdress(result)">{{
          result.address.freeformAddress
        }}</span>
      </div>
    </div>

    <!------------------------------------------------------------------------------------->

    <!--------------------------- form autocompletato d-none coordinate-------------------------->
    <div class="d-none mb-3">
      <label for="latitude" class="form-label">Latitudine</label>
      <input
        id="latitude"
        type="text"
        name="latitude"
        class="form-control"
        placeholder=""
        aria-describedby="latitudeId"
        :value="inputLat"
      />
      <small id="latitudeId" class="text-muted">latitude</small>
    </div>

    <div class="d-none mb-3">
      <label for="longitude" class="form-label">Longitudine</label>
      <input
        id="longitude"
        type="text"
        name="longitude"
        class="form-control"
        placeholder=""
        aria-describedby="longitudeId"
        :value="inputLon"
      />
      <small id="longitudeId" class="text-muted">longitudine</small>
    </div>
    <!------------------------------------------------------------------------------------->
  </div>
</template>







<script>
export default {
  data() {
    return {
      results: [],
      adressSelection: false,
      inputAddress: null,
      inputLat: null,
      inputLon: null,
    };
  },
  methods: {
    getLatitudeLongitude(address) {
      axios
        .get(
          `https://api.tomtom.com/search/2/geocode/${address}.json?key=Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK&limit=5&countrySet=IT&radius={2000}`
        )
        .then((response) => {
          this.adressSelection = false;
          this.inputLat = response.data.results[0].position.lat;
          this.inputLon = response.data.results[0].position.lon;
          this.results = response.data.results;
        });
    },
    selectAdress(index) {
      this.results = [];
      this.adressSelection = true;
      this.inputAddress = index.address.freeformAddress;
      this.inputLat = index.position.lat;
      this.inputLon = index.position.lon;
    },
  },
  mounted() {},
};
</script>