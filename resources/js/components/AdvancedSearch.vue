<template>
  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="">
          <h1 class="my-2">TESTIAMO IL COMPONENTE</h1>
          <searchbar-component @saveCoordinates="save"></searchbar-component>

          <button
            class="btn btn-primary w-100 my-4"
            type="button"
            @click="searchFunction()"
          >
            Search
          </button>
        </div>
      </div>

      <div class="col-md-4">
        <div style="max-width: 70px" class="mx-2 mb-3">
          <label for="n_rooms" class="form-label"> n Camere min</label>
          <input
            type="number"
            min="0"
            max="200"
            class="form-control"
            id="n_rooms"
            aria-describedby="n_roomsHelper"
            placeholder="0"
            v-model="n_rooms"
            required
          />
        </div>

        <div style="max-width: 70px" class="mx-2 mb-3">
          <label for="square_meters" class="form-label">n Bagni min</label>
          <input
            type="number"
            min="0"
            max="200"
            class="form-control"
            id="n_bathroom"
            aria-describedby="n_bathroomHelper"
            placeholder="0"
            v-model="n_bathroom"
            required
          />
        </div>

        <div class="mb-3">
          <label for="services" class="form-label">Servizi*</label>
          <select
            class="form-control"
            id="services"
            v-model="selected_services"
            multiple
            required
          >
            <option
              v-for="service in services"
              :key="service.id"
              :value="service.id"
            >
              {{ service.name }}
            </option>
          </select>
          <small id="serviceHelper" class="form-text text-muted"
            >Seleziona uno o più servizi aggiuntivi</small
          >
        </div>
      </div>
    </div>

    <div class="row">
      <a
        href="#"
        class="card justify-content-between card_promo m-3"
        v-for="apartment in results"
        :key="apartment.id"
      >
        <img
          class="card-img-top thumb"
          :src="'storage/' + apartment.image"
          alt="Card image cap"
        />
        <p class="promo">Promotion</p>
        <h2 class="card-text m-3 card_title">{{ apartment.title }}</h2>
        <div class="box">
          <p class="card-text m-3">{{ apartment.description }}</p>
        </div>

        <div
          class="
            button_details
            p-2
            w-50
            justify-content-center
            align-items-center
            text-center text-white
            m-auto
            mt-4
            mb-4
          "
        >
          <span>View details</span>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      results: [],
      userInput: "",
      n_bathroom: "",
      n_rooms: "",
      selected_services: [],
      coordinates: {
        lat: "",
        lon: "",
      },
    };
  },
  props: { services: Array },
  methods: {
    searchFunction() {
      console.log(this.userInput);
      axios
        .get(
          `/api/apartments?address=${this.userInput}&n_rooms=${this.n_rooms}&n_bathroom=${this.n_bathroom}&services=${this.selected_services}&latitude=${this.coordinates.lat}&longitude=${this.coordinates.lon}`
        )
        .then((response) => {
          this.results = response.data.data;
          console.log(this.results);
        })
        .catch((error) => {
          console.log(error, "Nessun risultato");
        });
    },

    save(coordinates) {
      this.coordinates = coordinates;
    },
  },
};
/*appunti prima di iniziare
                                                                                          
                Per soddisfare il fatto che non si deve avere un refresh della pagina della ricerca bisogna fare chiamate delle ajax.
                Il metodo più utilizzato in questi casi è fare in modo che ogni cambiamento di input vada a modificare i campi utili alla ricerca nell’url es (/ricerca?tipologia=cinese).
                Dopo ogni cambiamento viene fatta una chiamata ajax con i parametri presenti nella URL.
                  */
</script>