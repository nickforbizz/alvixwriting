<template>
    <div style="margin-bottom: 25px;">
        <!--<li class="list-group-item" > <slot></slot> </li>-->
        <li class="list-group-item" :class="listChatClass">
            <slot></slot>
            <span id="time"> {{ time }}</span>
        </li>
        <small class="badge pull-right" :class="badgeClass">{{ user.username }}</small>

    </div>


</template>

<script>
    export default {
        props:[
            'color',
            'user',
            'time'
        ],

        computed:{
            listChatClass(){

                return "list-group-item-" + this.color;

            },
            badgeClass(){

                return "badge-" + this.color;

            }

        },


        mounted() {
            console.log('chatComponent mounted.');

        },





    }
</script>


<style>
    #time{
        font-size: 9px;
        margin-top: 15px;
        position: absolute;
    }
</style>