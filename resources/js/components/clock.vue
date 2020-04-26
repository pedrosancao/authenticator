<template>
    <svg :width="diameter" :height="diameter">
        <path :d="`M ${radius} ${radius} L ${radius} 0 A ${radius} ${radius} 0 ${largeFlag} ${sweepFlag} ${x} ${y} L ${radius} ${radius}`"
            stroke-width="0"
            fill="lightgray"/>
    </svg>
</template>

<script>
    export default {
        props: {
            radius: Number
        },
        data: () => ({
            timeLimit: 30,
            progress: 100
        }),
        mounted() {
            let fps = 10;
            let interval = setInterval(() => {
                this.progress = this.progress - 1 / this.timeLimit * 100 / fps
                if (this.progress < 0) {
                    this.progress = 0
                    clearInterval(interval)
                }
            }, 1000 / fps)
        },
        computed: {
            diameter: function() {
                return this.radius * 2
            },
            largeFlag: function() {
                return this.progress < 50 ? 0 : 1
            },
            sweepFlag: function() {
                return 0
            },
            x: function() {
                return this.radius - this.radius * Math.sin(this.radians)
            },
            y: function() {
                return this.radius - this.radius * Math.cos(this.radians)
            },
            radians: function() {
                return this.progress / 50 * Math.PI
            }
        }
    }
</script>
