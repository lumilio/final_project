<template>
  <div>
    <div id="map" ref="mapRef"></div>
  </div>
</template>

<script>
export default {
  name: "Map",
  data() {
    return {
      map: null,
      coordinates: [],
      apikey: "Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK",
    };
  },

  props: ["apartment"],

  methods: {
    createMap() {
      const tt = window.tt;
      this.map = tt.map({
        key: this.apikey,
        container: "map",
        center: [this.apartment.longitude, this.apartment.latitude], // Madrid
        zoom: 10,
        theme: {
          style: "buildings",
          layer: "basic",
          source: "vector",
        },
      });
      this.map.addControl(new tt.FullscreenControl());
      this.map.addControl(new tt.NavigationControl());
    },

    addMarker(map) {
      const tt = window.tt;
      var location = [this.apartment.longitude, this.apartment.latitude];
      var popupOffset = 25;

      var marker = new tt.Marker().setLngLat(location).addTo(map);
      var popup = new tt.Popup({ offset: popupOffset }).setHTML(
        "Your address!"
      );
      marker.setPopup(popup).togglePopup();
    },
  },

  mounted() {
    this.createMap();
    this.addMarker(this.map);

    console.log("component mounted");
    console.log(this.apartment);
  },
};
</script>

<style>
#map {
  height: 500px;
  width: 500px;
}
</style>