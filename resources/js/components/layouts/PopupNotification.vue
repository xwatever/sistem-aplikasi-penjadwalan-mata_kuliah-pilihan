<template>
<transition name="fade">
    <div class="popup" v-if="show">
        <div class="popup_dialog" :class="{'success': (type == 'success'), 'failed': (type == 'failed')}">
            <div class="popup_header">
                <slot name="header" />
                <button type="button" class="popup_close" :class="{'success': (type == 'success'), 'failed': (type == 'failed')}" @click="$emit('popupclose', false)">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="popup_body">
                <slot name="body" />
            </div>

        </div>
    </div>
</transition>
</template>

<script>
export default {
    name: "popup",
    props: ['show', 'type'],
    mounted: function() {
      window.setInterval(() => {
          this.$emit('popupclose', false)
      }, 12000)
    }
};
</script>


<style lang="scss" scoped>
.popup {
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
    right: 0;
    bottom: 0;
    z-index: 999;
    &_dialog {
        background-color: #ffffff;
        position: relative;
        min-width: 200px;
        margin: 1em;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        z-index: 2;
    }
    &_close {
        width: 2em;
        height: 2em;
        font-size: 10px;
        border-width: medium;
        border-radius: 5px;
    }
    &_header {
        padding: 1em 1em 0 1em;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
    &_body {
        padding: 1em;
        overflow: auto;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
}
.fade-enter-active,
.fade-leave-active {
    transition: opacity .7s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.success {
    background-color: #039a1b;
    color: #ffffff;
}

.failed {
    background-color: #cc1b1b;
    color: #ffffff;
}
</style>
