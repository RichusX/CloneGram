<template>

        <button class="btn" :class="btnClass" @click="followUser" v-text="buttonText">Follow</button>

</template>

<script>
    export default {
        props: ['userId', 'follows', 'asLink'],

        mounted() {
            console.log('Component mounted.');
        },

        data: function () {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser(){
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        this.status = !this.status;
                        // console.log(response.data);
                    });
            }
        },

        computed: {
            buttonText (){
                return this.status ? 'Unfollow' : 'Follow';
            },
            btnClass(){
                if (!this.asLink){
                    return this.status ? 'btn-outline-secondary' : 'btn-primary';
                } else {
                    return 'btn-link';
                }

            }
        }
    }
</script>
