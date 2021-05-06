<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="preconnect" href="https://fonts.gstatic.com"> 
     <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
     <link rel="preconnect" href="https://fonts.gstatic.com"> 
     <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
     <!-- vue 2 -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x"></script>
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios@0.21.1/dist/axios.min.js"></script>

     <style>

          * {
               border: 0;
               margin: 0;
               padding: 0;
               box-sizing: border-box;
               font-family: "Comfortaa", cursive;
               text-decoration: none;
               list-style-type: none;
          }

          #vueContainer {
               background-color: black;
          }

          .select {
               display: flex;
               justify-content: center;
               height: 100px;
               align-items: center;
          }

         #vueContainer ul {
          
              display: flex;
              flex-wrap: wrap;
              justify-content: space-around;
              padding: 10%;          
         }

         #vueContainer ul li {
              flex-basis: calc(100% / 3 - 20px);  
              margin: 15px 0;
              text-align: center;
              border-radius: 30px;
         } 

         #vueContainer ul li div:first-child {
              border-radius: 30px;
              animation: rgb 1.2s linear infinite;
         }

         @keyframes rgb {

               0% {
                    background-color: red;
               }

               10% {
                    background-color: yellow;
               }

               20% {
                    background-color: green;
               }

               30% {
                    background-color: blue;
               }

               40% {
                    background-color: violet;
               }

               50% {
                    background-color: pink;
               }

               60% {
                    background-color: violet;
               }

               70% {
                    background-color: blue;
               }

               80% {
                    background-color: green;
               }

               90% {
                    background-color: yellow;
               }

               100% {
                    background-color: brown;
               }

          } 

         #vueContainer ul li img {
              width: 100%;
              height: 492px;
              padding: 10px 10px 5px;
              border-radius: 30px;
         }

         #vueContainer ul li div:last-child {
              padding-top: 15px;
         }

         #vueContainer ul li h1,
         #vueContainer ul li h2,
         #vueContainer ul li h3,
         #vueContainer ul li h4 {
              padding: 10px 20px;
              color: #007fff;
         }


          

     </style>


                              <!-- REPO: php-ajax-dischi
                    GOAL: Attraverso l'utilizzo di Axios: al caricamento
                    della pagina axios chiederà attraverso una
                    chiamata API i dischi a php e li stamperà
                    attraverso vue.
                    OPZIONALE
                    - Attraverso un'altra chiamata API, ﬁltrare gli
                    album per genere -->

     <script>

          function generateMusicTracks() {
               new Vue({
                    el: "#vueContainer",

                    data: {

                         'apiMusicTracks': [],
                         'genres' : [],
                         'genreModel' : ''
     
                    },

                    mounted() {

                         axios.get('data.php')
                         .then(content => {
                              this.apiMusicTracks = content.data;
                              for(i = 0; i < content.data.length; i++) {
                                   if(!this.genres.includes(content.data[i].genre)) {
                                        this.genres.push(content.data[i].genre);
                                   }
                              }
                              
                         })
                         .catch(e => {
                              console.log('error');
                         })

                    },

                    methods: {

                         filtrate: function() {
                              let filtratedApiMusicTracks = this.apiMusicTracks.filter(element => element.genre.includes(this.genreModel));
                              return filtratedApiMusicTracks;
                         }

                    }

               });
          }

          document.addEventListener("DOMContentLoaded",generateMusicTracks);

    </script>


     <title>PHP Snack 2</title>
</head>

<body>

     <div id="vueContainer">

          <div class="select">
               <select v-model="genreModel" name="" id="">
                    <option value="">all</option>
                    <option  v-for="genre in genres" :value="genre">{{ genre }}</option>
               </select>
          </div>
          
          <ul>

               <li v-for="track in filtrate()">
                    <div>
                         <img :src="track.poster" alt="alternatetext">
                    </div>
                    <div>
                         <h1>{{ track.title }}</h1>
                         <h2>{{ track.author }}</h2>
                         <h3>{{ track.genre }}</h3>
                         <h4>{{ track.year }}</h4>
                    </div>
               </li>
               
          </ul>

     </div>
</body>
</html>