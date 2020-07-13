<template>
    <div class="row justify-content-center">
        <div class="col-12 mb-2" v-if="accounts.length == 0 && loading">
            <div class="progress" v-if="accounts.length == 0 && loading">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-secondary w-100" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div v-for="(account, index) in accounts" :key="index" class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card" :title="account.name" @click="copyCode(index)" :ref="'container-' + index">
                <div class="card-header text-truncate">{{ account.name }}</div>
                <div class="card-body d-flex justify-content-between">
                    <span class="pr-1">{{ account.code.match(/.{1,3}/g).join(' ') }}</span>
                    <input class="position-absolute" type="text" :value="account.code" :ref="'input-' + index">
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
            this.getAccounts().then(() => {
                setInterval(this.getAccounts, 30000)
            })
        },
        methods: {
            getAccounts() {
                this.loading = true
                return axios.get('/codes').then(response => {
                    this.loading = false
                    this.accounts = []
                    this.$nextTick(() => {
                        this.accounts = response.data
                    })
                })
            },
            copyCode(index) {
                let container = this.$refs['container-' + index][0]
                let input = this.$refs['input-' + index][0]
                let $code = $('span', container)
                input.select()
                document.execCommand('copy')
                input.blur()
                $code.tooltip({
                    offset: offset => {
                        offset.reference.right += 20
                        return offset
                    },
                    placement: 'right',
                    title    : 'Copied',
                    trigger  : 'manual'
                }).tooltip('show')
                setTimeout(() => {
                    $code.tooltip('dispose')
                }, 1500)
            }
        }
    }
</script>

<style scoped>
input {
    opacity: 0;
    z-index: -1;
}
</style>
