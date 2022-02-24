<template>
    <div class="container font_style">
        <div class="row justify-content-center">
            <!-- Filter Rooms and Kilometers -->
            <div class="row justify-content-center">
                <div
                    class="d-flex flex-wrap justify-content-center align-items-center"
                >
                    <div class="col-6 col-sm-3 mx-2 mb-3 fields">
                        <label for="n_rooms" class="form-label">
                            N° camere Min</label
                        >
                        <input
                            type="number"
                            min="0"
                            max="200"
                            class="form-control"
                            name="n_rooms"
                            id="n_rooms"
                            aria-describedby="n_roomsHelper"
                            placeholder="0"
                            v-model="n_rooms"
                        />
                    </div>
                    <div class="col-6 col-sm-3 mx-2 mb-3 fields">
                        <label for="n_bed" class="form-label"
                            >N° letti Min</label
                        >
                        <input
                            type="number"
                            min="0"
                            max="5000"
                            class="form-control"
                            name="n_bed"
                            id="n_bed"
                            aria-describedby="n_bedHelper"
                            placeholder="0"
                            v-model="n_bed"
                        />
                    </div>
                    <div class="col-6 col-sm-3 mx-2 mb-3 fields">
                        <label for="distance" class="form-label"
                            >Raggio distanza Km</label
                        >
                        <input
                            type="number"
                            min="20"
                            max="5000"
                            class="form-control"
                            name="distance"
                            id="distance"
                            aria-describedby="distanceHelper"
                            placeholder="0"
                            v-model="distance"
                        />
                    </div>
                </div>

                <!--Services filter -->
                <div
                    class="d-flex service_checkbox flex-wrap justify-content-center align-items-center"
                >
                    <div
                        class="py-2"
                        v-for="service in services"
                        v-bind:key="service.id"
                    >
                        <div class="form-check mx-2">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                :name="service.name"
                                :id="service.id"
                                :value="service.id"
                                v-model="v_services"
                            />
                            <label class="form-check-label service_name" for="">
                                {{ service.name }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button Advanced Search -->
            <div class="col-6">
                <div class="d-flex justify-content-center align-items-center">
                    <button
                        class="btn btn_search text-white my-3"
                        @click="searchFunction()"
                    >
                        Ricerca avanzata
                    </button>
                </div>
            </div>
        </div>
        <!-- Results Advanced search -->
        <div class="row mt-4">
            <div
                class="col-md-6 d-flex justify-content-center align-items-center"
            >
                <a
                    :href="'/guest/apartments/' + apartment.slug"
                    class="card justify-content-between card_adv m-3"
                    v-for="apartment in apartments"
                    :key="apartment.id"
                >
                    <img
                        class="card-img-top thumb"
                        :src="'storage/' + apartment.image"
                        alt="Card image cap"
                    />
                    <p class="promo">Promotion</p>
                    <h2 class="card-text m-3 card_title">
                        {{ apartment.title }}
                    </h2>
                    <div class="box">
                        <p class="card-text m-3">{{ apartment.description }}</p>
                    </div>
                    <div
                        class="button_details p-2 w-50 justify-content-center align-items-center text-center text-white m-auto mt-4 mb-4"
                    >
                        <span>View details</span>
                    </div>
                </a>
            </div>

            <!-- Mappa -->
            <div class="col-md-6">
                <div
                    class="d-flex justify-content-center align-items-center my-4 map bg-dark"
                >
                    <p class="text-white text-center fs-4">Mappa</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Bus } from "../app";
export default {
    data() {
        return {
            apartments: [],
            userInput: "",
            n_bed: "",
            n_rooms: "",
            v_services: [],
            distance: null,
            coordinates: {},
        };
    },
    props: {
        services: Array,
        show_route: String,
    },
    methods: {
        searchFunction() {
            console.log(this.userInput);
            axios
                .get(
                    `/api/apartments?n_rooms=${this.n_rooms}&n_bed=${this.n_bed}&services=${this.v_services}&latitude=${this.coordinates.lat}&longitude=${this.coordinates.lon}&distance=${this.distance}`
                )
                .then((response) => {
                    this.apartments = response.data.data;
                    console.log(this.apartments);
                    console.log(this.n_rooms);
                    console.log(this.n_rooms);
                })
                .catch((error) => {
                    console.log(error, "non funziona");
                });
        },
        serviceFunction() {
            console.log(this.coordinates);
        },
    },
    created() {
        Bus.$on("sendCoordinates", (data) => {
            this.coordinates = data;
        });
        console.log(this.coordinates);
        if (localStorage.coordinates) {
            this.coordinates = JSON.parse(localStorage.getItem("coordinates"));
            console.log(this.coordinates);
        }
    },
    mounted() {
        this.searchFunction();
    },
};
/*appunti prima di iniziare

Per soddisfare il fatto che non si deve avere un refresh della pagina della ricerca bisogna fare chiamate delle ajax.
Il metodo più utilizzato in questi casi è fare in modo che ogni cambiamento di input vada a modificare i campi utili alla ricerca nell’url es (/ricerca?tipologia=cinese).
Dopo ogni cambiamento viene fatta una chiamata ajax con i parametri presenti nella URL.









  */
</script>
