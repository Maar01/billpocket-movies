<template>
    <div class="container-fluid">
        <div class="row mb-3 mx-3" v-for="movies in groupedMovies">
            <div class="card col-sm mx-2 border" style="" v-for="(movie, index) in movies">
                <img class="card-img-top" :src="`${imageBaseUrl}/${movie.poster_path}`" alt="poster image">
                <div class="card-body">
                    <h4 class="card-title">{{movie.title}}</h4>
                    <p class="card-text ">{{movie.overview}}</p>
                    <a href="#" class="btn btn-primary">View details</a>
                    <a href="#" class="btn btn-warning">add to favourites</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                favs: '',
                imageBaseUrl: window.imageBaseUrl,
                movies
            }
        },
        computed:{
            groupedMovies() {
                return _chunk(this.favs, 3);
            }
        },
        methods: {
          getFavs() {
              axios.get('auth/favs').then( (response) => {
                  this.favs = response.data;
                  //probably we can save some requests if there are no new favs.
                  window.favs = favs;
              });
          }
        },
        name: "myfavs"
    }
</script>
