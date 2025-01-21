<template>
<div class="login-box">
    <h1 class="title-box">Login</h1>

    <form action="/login" method="POST">
        <input type="hidden" name="_token" :value="csrf">
        <label for="identity_number">Identity Number</label>
        <input type="name" id="identity_number" name="identity_number" class="input-box" />
        <label for="password">
            Password
            <span class="right link">Forgot your password?</span>
        </label>
        <input type="password" id="password" name="password" class="input-box" />
        <button type="submit" class="button-submit">Login</button>
    </form>
</div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data() {
        return {
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        }
    }
}
</script>
