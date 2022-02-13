<template>
  <div>
    <div class="mb-3">
      <label for="address" class="form-label">Indirizzo</label>
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

      <small id="addressHelper" class="form-text text-muted"
        >Scrivi l'indirizzo dell'appartamento, max 255 caratteri</small
      >
    </div>

    <div class="mb-3">
      <label for="latitude" class="form-label">Latitudine</label>
      <input
        id="latitude"
        type="text"
        name="latitude"
        class="form-control"
        placeholder=""
        aria-describedby="latitudeId"
        :value="latitude"
      />
      <small id="latitudeId" class="text-muted">latitude</small>
    </div>

    <div class="mb-3">
      <label for="longitude" class="form-label">Longitudine</label>
      <input
        id="longitude"
        type="text"
        name="longitude"
        class="form-control"
        placeholder=""
        aria-describedby="longitudeId"
        :value="longitude"
      />
      <small id="longitudeId" class="text-muted">longitudine</small>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inputAddress: null,
      latitude: null,
      longitude: null,
    };
  },
  methods: {
    getLatitudeLongitude(address) {
      axios
        .get(
          `https://api.tomtom.com/search/2/geocode/${address}.json?key=Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK&limit=5&countrySet=IT&radius={2000}`
        )
        .then((response) => {
          console.log(response);
          console.log(response.data.results[0].position);
          this.latitude = response.data.results[0].position.lat;
          this.longitude = response.data.results[0].position.lon;
        });
    },
  },

  mounted() {
    console.log("Component mounted.");
  },
};
</script>
