<script>
    import { POINT_MARKER_ICON_CONFIG } from '@/Constants/mapSettings'

    export default{
        props: {
            google: {
                type:Object,
                required: true 
            },
            map: {
                type: Object,
                required: true
        
            },
            marker: {
                type: Object,
                required: true
            }
       },
       mounted()
       {
           new this.google.map.Marker({
               position: this.marker.position,
               marker: this.marker,
               map: this.map,
               
           })
       }
    }
</script>


