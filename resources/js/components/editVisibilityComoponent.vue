<template>
    <div>
        <p>Privato</p>
        <div class="toggle-wrapper">
            <div class="toggle checkcross">
                <label class="toggle-item" for="checkcross">
                    <input id="checkcross" type="checkbox" name="visibility" :value='visible' :checked="is_visible ? '' : 'checked'" @change='onChange'/>  
                    <div class="check"></div>
                </label>
            </div>
            <div style='max-width:70px' class="mx-2 mb-3 d-none">
                <input type="number" class="form-control" name="visibility" id="visibility" :value="visible">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            visible: this.is_visible,
            };
        },
        props: ["is_visible"],
        methods:{
            onChange (){
                if(this.visible){
                    this.visible = 0
                }else{
                    this.visible = 1
                }
            }
        },
        mounted() {}
    }
</script>



