<template>
    <!-- container della ricerca avanzata -->
    <div
        id="searchbar"
        class="col-md-6 mb-4 mx-4 search_bar d-flex justify-content-center align-items-center"
    >
        <!-- link provvisorio per andare alla ricerca vanzata  -->
        <a class="btn-primary" href="/research"
            >Cerca tra in nostri appartamenti!</a
        >
    </div>
</template>

<script>
import { Bus } from "../app";
export default {
    data() {
        return {
            apikey: "Oe8qW7UX2GW9LFGSM2ePZNH5D3IpOBqK",
            coordinates: {
                lat: null,
                lon: null,
            },
            userInput: "",
        };
    },

    methods: {
        /* funzione per crare la searchbox */
        createSearchbox() {
            var options = {
                searchOptions: {
                    key: this.apikey,
                    language: "it-IT",
                    limit: 5,
                },
                autocompleteOptions: {
                    key: this.apikey,
                    language: "it-IT",
                },
            };
            /* definisci variabile per la searchbox */
            var ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
            /* definisci variabile ed assegna la funzione della searchbox */
            var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            /* prendi il contenitore nella dom ed aggiungi la searchbox ricevuta */
            document.getElementById("searchbar").append(searchBoxHTML);
            /* crea una variabile e dai valore l'input nella searchbox */
            var inputSrc = document.querySelector(".tt-search-box-input");

            /* assegna un valore all'input della searchbar */
            inputSrc.value = localStorage.userInput;

            /* prendi le coordinate in risposta*/
            ttSearchBox.on("tomtom.searchbox.resultselected", (data) => {
                console.log(data.data.result);
                this.$set(
                    this.coordinates,
                    "lat",
                    data.data.result.position.lat
                );
                this.$set(
                    this.coordinates,
                    "lon",
                    data.data.result.position.lng
                );
                Bus.$emit("sendCoordinates", this.coordinates);
                const parsed = JSON.stringify(this.coordinates);
                this.userInput = data.data.result.address.freeformAddress;
                localStorage.setItem("coordinates", parsed);
                localStorage.setItem("userInput", this.userInput);
                console.log(this.userInput);
            });
        },
    },
    mounted() {
        this.createSearchbox();
        localStorage.userInput = "";
    },
};
</script>

<style></style>
