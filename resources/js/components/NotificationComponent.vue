<template>
    <div>
       <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <em class="fa fa-envelope"></em>
                <span class="label label-danger">{{ notificationsNumber }}</span>
            </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li :class="'alert' + alertClass" v-show="show"  v-for="(notification, id) in notifications" :key="id">
                        {{ notification.subs }}
                        <!-- <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                            <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                        </a>
                        <div class="message-body">
                            <small class="pull-right">3 mins ago</small>
                                <a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
                            <br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
                        </div> -->
                    </li>
                    <li class="divider"></li>

                    <li>
                        <div class="all-button"><a href="#">
                            <em class="fa fa-inbox"></em> <strong>All Messages</strong>
                        </a></div>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</template>

<script>
    export default {
        props: [
            'type', 'message'
        ],

        data: function() {
            return {
                show: false,
                notifications: [],
                notificationsNumber: '',
                alertClass: '',
                hideTimeOut: false

            }
        },

        mounted() {
            console.log('Component mounted.')

            console.log("Listening")
            Echo.channel('updates-subscription')
                .listen('SubscribeEvent', (e) => {

                    this.notifications.push({subs: `${e.email} has just subscribed to this site.`});
                    this.show = true;
                    this.notificationsNumber = this.notifications.length;
                }); 



                //  if (Laravel.userId) {
    
                //         window.Echo.private(`App.User.${Laravel.userId}`)
                //             .notification((notification) => {
                //                 // addNotifications([notification], '#notifications');
                //                 console.log(notification);
                //             });
                //     } else {
                //         console.log("no notification without userid")
                //     }
        
        
        }




    }
</script>
