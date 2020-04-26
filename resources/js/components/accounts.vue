<template>
    <div class="row justify-content-center">
        <div class="col-12" v-if="accounts.length == 0 && loading">
            <div class="progress" v-if="accounts.length == 0 && loading">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div v-for="(account, index) in accounts" v-bind:key="index" class="col-12 col-md-3">
            <div class="card">
                <div class="card-header">{{ account.name }}</div>
                <div class="card-body d-flex justify-content-between">
                    <span>{{ account.code.match(/.{1,3}/g).join(' ') }}</span>
                    <clock :radius="10"></clock>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            loading: false,
            accounts: []
        }),
        mounted() {
            this.getaccounts().then(() => {
                setInterval(this.getaccounts, 30000)
            })
        },
        methods: {
            getaccounts: function() {
                this.loading = true
                return axios.get('/codes').then(response => {
                    this.loading = false
                    this.accounts = []
                    this.$nextTick(() => {
                        this.accounts = response.data
                    })
                })
            }
        }
    }
</script>
