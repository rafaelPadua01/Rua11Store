<template>
    
        
        <GmapMap
        :center="center"
        :zoom="13"
        style="width: 100%; height: 500px"
        ref="mapRef"
        >
           
       
        <GmapMarker
            :key="index"
            :zoom="10"
            v-for="(m,index) in markers"
            :position="m.position"
            @click="center=m.position"
        >
            
        </GmapMarker>   

    
   </GmapMap>

   
   

   
</template>


<script>
   

    
    export default{
       name: 'GoogleMap',

       data(){
           return {
               map: undefined,
               center: { lat:  -15.6308877, lng: -47.8391091},
               markers: [],
               places: [],
               currentPlace: null,
              
           };
       },
      
        mounted() {
            this.geolocate();
            this.$refs.mapRef.$mapPromise.then((map) => {
                this.map = map;
                this.init();
            });
        },
        methods: {
            init()
            {
                new google.maps.Marker({
                    position: {
                        lat: -15.6308877,
                        lng: -47.8391091,
                    },
                    map: this.map,
                });
            },
            setPlace(place)
            {
                this.currentPlace = place;
            },
            addMarker()
            {
                if(this.currentPlace)
                {
                    const marker = {
                        lat: this.currentPlace.geometry.location.lat(),
                        lng: this.currentPlace.geometry.location.lng()
                    };

                    this.markers.push({position: marker});
                    this.places.push(this.currentPlace);
                    this.center = marker;
                    this.currentPlace = null;
                }
            },
            geolocate: function()
            {
                navigator.geolocation.getCurrentPosition(position => {
                    this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                });

                            
            }
        },

    }

</script>

