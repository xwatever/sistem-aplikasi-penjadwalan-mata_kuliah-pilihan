<template>
<transition name="fade">
    <div class="modal" v-if="show">
        <div class="modal_backdrop" @click="$emit('event', false)" />

        <div class="modal_dialog">
            <div class="modal_header">
                <slot name="header" />
                <button type="button" class="modal_close" @click="$emit('event', false)">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal_body">
                <slot name="body" />
            </div>

            <div class="modal_footer">
                <slot name="footer" />
            </div>
        </div>
    </div>
</transition>
</template>

<script>
export default {
    name: "Modal",
    props: ['show']
};
</script>


<style lang="scss" scoped>
.modal {
    overflow-x: hidden;
    overflow-y: auto;
    position: fixed;
    top: 3.3em;
    right: 0;
    bottom: 0;
    left: calc(270px + 1.6em);
    z-index: 9;
    @media screen and (max-width: 992px) {
        top: 2em;
        left: 0;
    }
    &_backdrop {
        background-color: rgba(0, 0, 0, 0.3);
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
    }
    &_dialog {
        background-color: #ffffff;
        position: relative;
        width: 855px;
        margin: 50px auto;
        display: flex;
        flex-direction: column;
        border-radius: 5px;
        z-index: 2;
        @media screen and (max-width: 992px) {
            width: 94%;
        }
    }
    &_close {
        width: 2.4em;
        height: 2.4em;
    }
    &_header {
        padding: 2em;
        color: #5b5d5c;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }
    &_body {
        padding: 0 2em;
        overflow: auto;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
    &_footer {
        padding: 2em;
    }
}
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.7s;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
